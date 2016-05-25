<?php

namespace projectx\api\user;

use Doctrine\DBAL\Connection;
use projectx\api\entity\User;

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

    public function getTableName()
    {
        return 'user';
    }

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
    
    public function create(User $user)
    {
        $data = $user->jsonSerialize();
        unset($data['id']);
        
        $this->connection->insert("`{$this->getTableName()}`", $data);
        $user->setId($this->connection->lastInsertId());
    }
}