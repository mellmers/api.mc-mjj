<?php

namespace projectx\api\gameAccountType;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

/**
 * Class GameAccountTypeRoutesProvider
 * @package projectx\api\gameAccountType
 */
class GameAccountTypeRoutesProvider implements ControllerProviderInterface
{

    /** {@inheritdoc} */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        /**
         * @SWG\Parameter(name="gameAccountType", type="integer", format="int32", in="path")
         * @SWG\Tag(name="gameAccountType", description="All about gameAccountTypes")
         */

        /**
         * @SWG\Get(
         *     path="/gameAccountType/",
         *     tags={"gameAccountType"},
         *     @SWG\Response(response="200", description="An example resource")
         * )
         */
        // see https://github.com/silexphp/Silex/issues/149
        $controllers->get('/', 'service.gameAccountType:getList');
        /**
         * @SWG\Get(
         *     path="/gameAccountType/{name}",
         *     tags={"gameAccountType"},
         *     @SWG\Parameter(ref="#/parameters/name"),
         *     @SWG\Response(
         *         response="200",
         *         description="An example resource",
         *          @SWG\Schema(ref="#/definitions/gameAccountType")
         *     )
         * )
         */
        $controllers->get('/{name}', 'service.gameAccountType:getByName');

        /**
         * @SWG\Post(
         *     tags={"gameAccountType"},
         *     path="/gameAccountType/",
         *     @SWG\Parameter(name="gameAccountType", in="body", @SWG\Schema(ref="#/definitions/gameAccountType")),
         *     @SWG\Response(response="201", description="An example resource")
         * )
         *
         */
        $controllers->post('/', 'service.gameAccountType:create');

        return $controllers;
    }
}