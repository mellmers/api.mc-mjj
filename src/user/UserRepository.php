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
     * @return array
     */
    public function create(User $user)
    {
        $result = [];

        if(empty($user->getUsername())) {
            $this->app->abort(400, 'A User needs a username');
        } else if(empty($user->getEmail())) {
            $this->app->abort(400, 'A User needs a email');
        } else if(empty($user->getPassword())) {
            $this->app->abort(400, 'A User needs a password');
        } else {
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

            $result = $this->getById($user->getId());
        }
        return $result;
    }


    /**
     * @param User $user
     *
     * @return User
     */
    public function update(User $user)
    {
        $data = $user->jsonSerialize();
        foreach ($data as $key => $value) {
            if (empty($value)) {
                unset($data[$key]);
            }
        }

        $this->connection->update("`{$this->getTableName()}`", $data, ["id" => $user->getId()]);
        $result = $this->getById($user->getId());

        return $result;
    }

    /**
     * @param $userId
     *
     * @return array
     */
    public function getById($userId)
    {
        $sql = <<<EOS
SELECT o.*
FROM `{$this->getTableName()}` o
WHERE o.id = :id
EOS;

        $result = [];

        $users = $this->connection->fetchAll($sql, ['id' => $userId]);
        if (count($users) === 0) {
            $this->app->abort(400, "User with id $userId does not exist.");
        } else {
            $result[] = User::createFromArray($users[0]);
        }
        return $result;
    }
}