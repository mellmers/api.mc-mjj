<?php

namespace projectx\api\user;

use Doctrine\DBAL\Connection;
use projectx\api\entity\User;
use Silex\Application;

/**
 * Class UserRepository
 * @package projectx\api\user
 */
class UserRepository
{
    /** @var  Application */
    private $app;

    /** @var  Connection */
    private $connection;

    /**
     * UserRepository constructor.
     *
     * @param Application $app
     * @param Connection $connection
     */
    public function __construct(Application $app, Connection $connection)
    {
        $this->app = $app;
        $this->connection = $connection;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $sql = <<<EOS
SELECT * 
FROM `{$this->getTableName()}`
EOS;

        $users = $this->connection->fetchAll($sql);

        $result = [];
//        print_r($users);

        foreach ($users as $user) {
            $result[] = User::createFromArray($user);
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return 'user';
    }

    /**
     * @param $id
     *
     * @return User
     */
    public function getById($id)
    {
        $sql = <<<EOS
SELECT o.*
FROM `{$this->getTableName()}` o
WHERE o.id = :id
EOS;

        $users = $this->connection->fetchAll($sql, ['id' => $id]);
        if (count($users) === 0) {
            $this->app->abort(400, "User with id $id does not exist.");
        }

        return User::createFromArray($users[0]);
    }

    /**
     * @param User $user
     */
    public function create(User $user)
    {
        $data = $user->jsonSerialize();
        unset($data['id']);

        $this->connection->insert("`{$this->getTableName()}`", $data);
        $user->setId($this->connection->lastInsertId());
    }
}