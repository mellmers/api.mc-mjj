<?php

namespace projectx\api\gameAccount;

use Doctrine\DBAL\Connection;
use projectx\api\Application;
use projectx\api\entity\GameAccount;
use projectx\api\gameAccountType\GameAccountTypeRepository;
use projectx\api\user\UserRepository;

/**
 * Class GameAccountRepository
 * @package projectx\api\gameAccount
 */
class GameAccountRepository
{
    /** @var  Application */
    private $app;

    /** @var  Connection */
    private $connection;

    /**
     * GameAccountRepository constructor.
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

        $gameAccounts = $this->connection->fetchAll($sql);

        $result = [];

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

    /**
     * @param array $gameAccount
     * @return array
     */
    private function loadUser(array $gameAccount)
    {
        $userRepo = new UserRepository($this->app, $this->connection);
        $userResult = $userRepo->getById($gameAccount['userId']);
        $gameAccount['user'] = $userResult;
        return $gameAccount;
    }

    /**
     * @param array $gameAccount
     * @return array
     */
    private function loadGameAccountType(array $gameAccount)
    {
        $gATRepo = new GameAccountTypeRepository($this->app, $this->connection);
        $gATResult = $gATRepo->getById($gameAccount['gameaccountTypeId']);
        $gameAccount['gameaccountType'] = $gATResult;
        return $gameAccount;
    }

    /**
     * @param $userId
     * @return array
     */
    public function getByUserId($userId)
    {
        $sql = <<<EOS
SELECT ga.*
FROM `{$this->getTableName()}` ga
WHERE ga.user_id = :userId
EOS;

        $result = [];

        $gameAccounts = $this->connection->fetchAll($sql, ['userId' => $userId]);
        if (count($gameAccounts) === 0) {
            $this->app->abort(400, "User with id $userId has no GameAccounts.");
        } else {
            foreach ($gameAccounts as $gameAccount) {
                $gameAccount = $this->loadUser($gameAccount);
                $gameAccount = $this->loadGameAccountType($gameAccount);
                $result[] = GameAccount::createFromArray($gameAccount);
            }
        }
        return $result;
    }

    /**
     * @param $gameAccountTypeId
     * @return array
     */
    public function getByTypeId($gameAccountTypeId)
    {
        $sql = <<<EOS
SELECT ga.*
FROM `{$this->getTableName()}` ga
WHERE ga.gameaccount_type_id = :gameAccountTypeId
EOS;

        $result = [];

        $gameAccounts = $this->connection->fetchAll($sql, ['gameAccountTypeId' => $gameAccountTypeId]);
        if (count($gameAccounts) === 0) {
            $this->app->abort(400, "GameAccounts type id $gameAccountTypeId has no GameAccounts.");
        } else {
            foreach ($gameAccounts as $gameAccount) {
                $gameAccount = $this->loadUser($gameAccount);
                $gameAccount = $this->loadGameAccountType($gameAccount);
                $result[] = GameAccount::createFromArray($gameAccount);
            }
        }
        return $result;
    }

    /**
     * @param GameAccount $gameAccount
     * @return array
     */
    public function create(GameAccount $gameAccount)
    {
        $result = [];

        $userId = $gameAccount->getUserId();
        $typeId = $gameAccount->getGameAccountTypeId();
        if (empty($userId) && empty($typeId)) {
            $this->app->abort(400, 'A gameaccount needs a userId and a gameAccountTypeId');
        } else {
            $data = $gameAccount->jsonSerialize();
            unset($data['userPath'], $data['user'], $data['gameaccountTypePath'], $data['gameaccountType']);
            foreach ($data as $key => $value) {
                if (empty($value)) {
                    unset($data[$key]);
                }
            }

            $this->connection->insert("`{$this->getTableName()}`", $data);

            $result = $this->getByIdAndType($userId, $typeId);
        }
        return $result;
    }


    /**
     * @param GameAccount $gameAccount
     * @return GameAccount
     */
    public function update(GameAccount $gameAccount)
    {
        $result = [];
        $data = $gameAccount->jsonSerialize();
        unset($data['userPath'], $data['user'], $data['gameaccountTypePath'], $data['gameaccountType']);
        foreach ($data as $key => $value) {
            if (empty($value)) {
                unset($data[$key]);
            }
        }

        $this->connection->update("`{$this->getTableName()}`", $data, ["userId" => $gameAccount->getUserId(), "gameAccountTypeId" => $gameAccount->getGameAccountTypeId()]);

        $result = $this->getByIdAndType($gameAccount->getUserId(), $gameAccount->getGameAccountTypeId());
        return $result;
    }

    /**
     * @param $userId
     * @param $gameaccountTypeId
     * @return array
     */
    public function getByIdAndType($userId, $gameaccountTypeId)
    {
        $sql = <<<EOS
SELECT ga.*
FROM `{$this->getTableName()}` ga
WHERE ga.userId = :userId AND ga.gameaccountTypeId = :gameaccountTypeId
EOS;

        $result = [];

        $gameAccounts = $this->connection->fetchAll($sql, ['userId' => $userId, 'gameaccountTypeId' => $gameaccountTypeId]);
        if (count($gameAccounts) === 0) {
            $this->app->abort(400, "GameAccount with id $userId and type $gameaccountTypeId does not exist.");
        } else {
            $gameAccounts[0] = $this->loadUser($gameAccounts[0]);
            $gameAccounts[0] = $this->loadGameAccountType($gameAccounts[0]);
            $result[] = GameAccount::createFromArray($gameAccounts[0]);
        }
        return $result;
    }

    /**
     * @param $userId
     * @param $gameaccountTypeId
     *
     * @return GameAccount
     */
    public function deleteGameAccountType($userId, $gameaccountTypeId)
    {
        $gameAccount = $this->getByIdAndType($userId, $gameaccountTypeId);
        $sql = <<<EOS
DELETE
FROM `{$this->getTableName()}`
WHERE userId = :userId AND gameaccountTypeId = :gameaccountTypeId
EOS;
        try {
            $this->connection->executeQuery($sql, ['userId' => $userId, 'gameaccountTypeId' => $gameaccountTypeId]);
        } catch (\Doctrine\DBAL\DBALException $e) {
            $this->app->abort(400, "GameAccount with id $gameaccountTypeId does not exist.");
        }
        return $gameAccount;
    }

}