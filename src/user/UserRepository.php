<?php

namespace projectx\api\user;

use DateTime;
use Doctrine\DBAL\Connection;
use projectx\api\Application;
use projectx\api\entity\User;

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
ORDER BY createdAt
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
     * @param User $user
     *
     * @return User
     */
    public function create(User $user)
    {
        $user->setId(Application::generateGUIDv4());
        $date = new DateTime();
        $user->setCreatedAt($date->getTimestamp());
        $data = $user->jsonSerialize();
        unset($data['coins'], $data['trusted']);
        foreach($data as $key => $value) {
            if(empty($value)) {
                unset($data[$key]);
            }
        }

        $this->connection->insert("`{$this->getTableName()}`", $data);

        return $this->getById($user->getId());
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
}