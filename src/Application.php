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

       /* $app->register(new SwaggerProvider(),
            [
                SwaggerServiceKey::SWAGGER_SERVICE_PATH => $app['base_path'],
                SwaggerServiceKey::SWAGGER_API_DOC_PATH => '/docs/swagger.json',
            ]);*/

        /*$app->register(new SwaggerUIServiceProvider(),
            [
                'swaggerui.path' => '/docs/swagger',
                'swaggerui.docs' => '/docs/swagger.json',
            ]);*/

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

        // all about users
        $app->register(new UserServiceProvider());
//        $app->register(new SecurityProvider());

        // all about gameAccountType
        $app->register(new GameAccountTypeServiceProvider());

        // all about gameAccount
        $app->register(new GameAccountServiceProvider());

        // all about game
        $app->register(new GameServiceProvider());

        // all about lobby
        $app->register(new LobbyServiceProvider());

        // all about bet
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
}
