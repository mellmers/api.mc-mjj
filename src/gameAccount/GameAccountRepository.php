<?php

namespace projectx\api\gameAccount;

use Doctrine\DBAL\Connection;
use projectx\api\entity\GameAccount;
use projectx\api\gameAccountType\GameAccountTypeRepository;
use projectx\api\user\UserRepository;

/**
 * Class GameAccountRepository
 * @package projectx\api\gameAccount
 */
class GameAccountRepository
{
    /** @var  Connection */
    private $connection;
    /** @var  UserRepository */
    private $userRepo;
    /** @var  GameAccountTypeRepository */
    private $gATRepo;

    /**
     * GameAccountRepository constructor.
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->userRepo = new UserRepository($this->connection);
        $this->gATRepo = new GameAccountTypeRepository($this->connection);
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

        $gameAccounts = $this->connection->fetchAll($sql);

        $result = [];
//        print_r($gameAccounts);

        foreach ($gameAccounts as $gameAccount) {
            $gameAccount = $this->loadUser($gameAccount);
            $gameAccount = $this->loadGameAccountType($gameAccount);
            $result[] = GameAccount::createFromArray($gameAccount);
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return 'gameaccount';
    }

    private function loadUser(array $gameAccount)
    {
        $userResult = $this->userRepo->getById($gameAccount['user_id']);
        $gameAccount['user'] = $userResult;
        return $gameAccount;
    }

    private function loadGameAccountType(array $gameAccount)
    {
        $gATResult = $this->gATRepo->getById($gameAccount['gameaccount_type_id']);
        $gameAccount['gameaccount_type'] = $gATResult;
        return $gameAccount;
    }

    /**
     * @param $name
     * @return GameAccount
     * @throws DatabaseException
     */
    public function getByIdAndType($id, $type_id)
    {
        $sql = <<<EOS
SELECT ga.*
FROM `{$this->getTableName()}` ga
WHERE ga.user_id = :name AND ga.gameaccount_type_id = :type_id
EOS;

        $gameAccounts = $this->connection->fetchAll($sql, ['name' => $id, 'type_id' => $type_id]);
        if (count($gameAccounts) === 0) {
            throw new DatabaseException(
                sprintf('GameAccount with id "%d" not exists!', $id)
            );
        }
        $result = [];
        $gameAccounts[0] = $this->loadUser($gameAccounts[0]);
        $gameAccounts[0] = $this->loadGameAccountType($gameAccounts[0]);
        $result[] = GameAccount::createFromArray($gameAccounts[0]);
        return $result;
    }

    public function getByUserId($userId)
    {
        $sql = <<<EOS
SELECT ga.*
FROM `{$this->getTableName()}` ga
WHERE ga.user_id = :userId
EOS;

        $gameAccounts = $this->connection->fetchAll($sql, ['userId' => $userId]);
        if (count($gameAccounts) === 0) {
            throw new DatabaseException(
                sprintf('GameAccount with id "%d" not exists!', $userId)
            );
        }
        $result = [];
        foreach ($gameAccounts as $gameAccount) {
            $gameAccount = $this->loadUser($gameAccount);
            $gameAccount = $this->loadGameAccountType($gameAccount);
            $result[] = GameAccount::createFromArray($gameAccount);
        }
        return $result;
    }

    /**
     * @param GameAccount $gameAccount
     */
    public function create(GameAccount $gameAccount)
    {
        $data = $gameAccount->jsonSerialize();
        $this->connection->insert("`{$this->getTableName()}`", $data);
        $gameAccount->setUserId($this->connection->lastInsertId());
    }


}