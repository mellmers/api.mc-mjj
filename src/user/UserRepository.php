<?php

namespace projectx\api\user;

use Doctrine\DBAL\Connection;
use projectx\api\entity\User;

/**
 * Class UserRepository
 * @package projectx\api\user
 */
class UserRepository
{
    /** @var  Connection */
    private $connection;

    /**
     * UserRepository constructor.
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
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
            $result['data'][] = User::createFromArray($user);
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

    public function getById($id)
    {
        $sql = <<<EOS
SELECT o.*
FROM `{$this->getTableName()}` o
WHERE o.id = :id
EOS;

        $users = $this->connection->fetchAll($sql, ['id' => $id]);
        if (count($users) === 0) {
            throw new DatabaseException(
                sprintf('User with id "%d" not exists!', $id)
            );
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