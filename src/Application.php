<?php

namespace projectx\api;

use JDesrosiers\Silex\Provider\CorsServiceProvider;
use projectx\api\bet\BetServiceProvider;
use projectx\api\database\DatabaseProvider;
use projectx\api\game\GameServiceProvider;
use projectx\api\gameAccount\GameAccountServiceProvider;
use projectx\api\gameAccountType\GameAccountTypeServiceProvider;
use projectx\api\lobby\LobbyServiceProvider;
use projectx\api\user\UserServiceProvider;
use Silex\Application as Silex;
use Silex\Provider\ServiceControllerServiceProvider;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Application extends Silex {

    public function __construct()
    {
        parent::__construct();

        $app = $this;

        //$app['debug'] = true;

        $app->register(new ServiceControllerServiceProvider());

        $app['base_path'] = __DIR__;

        // error handling calling with $app->abort($code, $message)
        $app->error(function (\Exception $e, $code) use ($app) {
            if($app['debug']) {
                return false;
            }
            $response['error'] = $e->getMessage();
            return new JsonResponse($response, $code);
        });

        // enable cross origin requests!
        $app->register(new CorsServiceProvider());

        // enable database connection
        $app->register(new DatabaseProvider());

        //enable the service provider
        $app->register(new UserServiceProvider());
        $app->register(new GameAccountTypeServiceProvider());
        $app->register(new GameAccountServiceProvider());
        $app->register(new GameServiceProvider());
        $app->register(new LobbyServiceProvider());
        $app->register(new BetServiceProvider());

        // http://silex.sensiolabs.org/doc/cookbook/json_request_body.html
        $this->before(function (Request $request) use ($app) {
            if ($app->requestIsJson($request)) {
                $data = json_decode($request->getContent(), true);
                $request->request->replace(is_array($data) ? $data : []);
            }
        });

        $app->after($app['cors']);
    }

    private function requestIsJson(Request $request)
    {
        return 0 === strpos(
            $request->headers->get('Content-Type'),
            'application/json'
        );
    }

    /**
     * Returns a GUIDv4 string
     *
     * source: http://php.net/manual/de/function.com-create-guid.php#119168
     *
     * Uses the best cryptographically secure method
     * for all supported pltforms with fallback to an older,
     * less secure version.
     *
     * @param bool $trim
     * @return string
     */
    public static function generateGUIDv4 ($trim = true)
    {
        // Windows
        if (function_exists('com_create_guid') === true) {
            if ($trim === true)
                return trim(com_create_guid(), '{}');
            else
                return com_create_guid();
        }

        // OSX/Linux
        if (function_exists('openssl_random_pseudo_bytes') === true) {
            $data = openssl_random_pseudo_bytes(16);
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }

        // Fallback (PHP 4.2+)
        mt_srand((double)microtime() * 10000);
        $charid = strtolower(md5(uniqid(rand(), true)));
        $hyphen = chr(45);                  // "-"
        $lbrace = $trim ? "" : chr(123);    // "{"
        $rbrace = $trim ? "" : chr(125);    // "}"
        $guidv4 = $lbrace.
            substr($charid,  0,  8).$hyphen.
            substr($charid,  8,  4).$hyphen.
            substr($charid, 12,  4).$hyphen.
            substr($charid, 16,  4).$hyphen.
            substr($charid, 20, 12).
            $rbrace;
        return $guidv4;
    }
}
