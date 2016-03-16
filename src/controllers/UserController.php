<?php

    namespace Controllers;

    use DB_CONNECT;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Silex\Application;
    use Silex\ControllerProviderInterface;

    /**
    * The routes used for user.
    *
    * @package Controllers
    */
    class UserController implements ControllerProviderInterface
    {

        /**
        * Connect function is used by Silex to mount the controller to the application.
        * Please list all routes inside here.
        * @param Application $app Silex Application Object.
        * @return Response Silex Response Object.
        */

        public function connect(Application $app)
        {
            /**
            * @var \Silex\ControllerCollection $factory
            */
            $factory = $app['controllers_factory'];

            $factory->get(
                '/{id}',
                'Controllers\UserController::getUserById'
            );
            $factory->post(
                '/',
                'Controllers\UserController::createUser'
            );

            return $factory;
        }

        /**
         * Create a user.
         *
         * @param Application $app
         * @param Request $request
         * @return object
         * @internal param string $_type
         * @internal param string $firstname
         * @internal param string $lastname
         * @internal param string $email
         * @internal param string $password
         *
         */
        public function createUser(Application $app, Request $request)
        {
            $_type = $request->get('_type');
            $firstname = $request->get('firstname');
            $lastname = $request->get('lastname');
            $email = $request->get('email');
            $password = $request->get('password'); ;
            // array for JSON response
            $response = array();
            // create new db object
            $db = new DB_CONNECT();
            // get a user from users table with a prepared statement
            $result = $db->getCon()->prepare("INSERT INTO users(_type, firstname, lastname, email, password) VALUES(:_type, :firstname, :lastname, :email, :password)");
            $result->execute(array(':_type' => $_type, ':firstname' => $firstname, ':lastname' => $lastname, ':email' => $email, ':password' => $password));

            // check for empty result
            if ($result->rowCount() > 0) {

                $user = array();

                foreach($result as $row) {
                    $user["id"] = $row["id"];
                    $user["_type"] = $row["_type"];
                    $user["firstname"] = $row["firstname"];
                    $user["lastname"] = $row["lastname"];
                    $user["email"] = $row["email"];
                }

                $response["success"] = 1;
                $response["user"] = array();

                array_push($response["user"], $user);
            } else {
                // no user found
                $response["success"] = 0;
                $response["message"] = "User can not be created";
            }

            $db->close();

            return $app->json($response);
        }

        /**
        * Get a user by id.
        *
        * @param Application $app
        * @param int $id
        *
        * @return object
        */
         public function getUserById(Application $app, $id)
        {
            // array for JSON response
            $response = array();
            // create new db object
            $db = new DB_CONNECT();
            // get a user from users table with a prepared statement
            $result = $db->getCon()->prepare("SELECT * FROM users WHERE id = ?");
            $result->execute(array($id));

            // check for empty result
            if ($result->rowCount() > 0) {

                $user = array();

                foreach($result as $row) {
                    $user["id"] = $row["id"];
                    $user["_type"] = $row["_type"];
                    $user["firstname"] = $row["firstname"];
                    $user["lastname"] = $row["lastname"];
                    $user["email"] = $row["email"];
                }

                $response["success"] = 1;
                $response["user"] = array();

                array_push($response["user"], $user);
            } else {
                // no user found
                $response["success"] = 0;
                $response["message"] = "No user found";
            }

            $db->close();

            return $app->json($response);
        }
}
