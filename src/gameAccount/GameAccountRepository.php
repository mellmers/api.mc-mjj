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

        $result = [];

        $gameAccounts = $this->connection->fetchAll($sql);
        foreach ($gameAccounts as $key) {
            $gameAccount = GameAccount::createFromArray($key);
            $gameAccount = $this->loadUser($gameAccount);
            $gameAccount = $this->loadGameAccountType($gameAccount);
            $result[] = $gameAccount;
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
     * @param GameAccount $gameAccount
     * @return GameAccount
     */
    private function loadUser($gameAccount)
    {
        $userRepo = new UserRepository($this->app, $this->connection);
        $user = $userRepo->getById($gameAccount->getUserId());
        $gameAccount->setUser($user);
        return $gameAccount;
    }

    /**
     * @param GameAccount $gameAccount
     * @return GameAccount
     */
    private function loadGameAccountType($gameAccount)
    {
        $gATRepo = new GameAccountTypeRepository($this->app, $this->connection);
        $gameAccountType = $gATRepo->getById($gameAccount->getGameAccountTypeId());
        $gameAccount->setGameAccountType($gameAccountType);
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
WHERE ga.userId = :userId
EOS;

        $result = [];

        $gameAccounts = $this->connection->fetchAll($sql, ['userId' => $userId]);
        if (count($gameAccounts) === 0) {
            $this->app->abort(400, "User with id $userId has no GameAccounts.");
        } else {
            foreach ($gameAccounts as $key) {
                $gameAccount = GameAccount::createFromArray($key);
                $gameAccount = $this->loadUser($gameAccount);
                $gameAccount = $this->loadGameAccountType($gameAccount);
                $result[] = $gameAccount;
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
WHERE ga.gameaccountTypeId = :gameAccountTypeId
EOS;

        $result = [];

        $gameAccounts = $this->connection->fetchAll($sql, ['gameAccountTypeId' => $gameAccountTypeId]);
        if (count($gameAccounts) === 0) {
            $this->app->abort(400, "GameAccounts type id $gameAccountTypeId has no GameAccounts.");
        } else {
            foreach ($gameAccounts as $key) {
                $gameAccount = GameAccount::createFromArray($key);
                $gameAccount = $this->loadUser($gameAccount);
                $gameAccount = $this->loadGameAccountType($gameAccount);
                $result[] = $gameAccount;
            }
        }
        return $result;
    }

    /**
     * @param GameAccount $gameAccount
     * @return GameAccount
     */
    public function create($gameAccount)
    {
        $result = null;

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
     * @param $userId
     * @param $gameaccountTypeId
     * @return GameAccount
     */
    public function getByIdAndType($userId, $gameaccountTypeId)
    {
        $sql = <<<EOS
SELECT ga.*
FROM `{$this->getTableName()}` ga
WHERE ga.userId = :userId AND ga.gameaccountTypeId = :gameaccountTypeId
EOS;

        $result = null;

        $gameAccounts = $this->connection->fetchAll($sql, ['userId' => $userId, 'gameaccountTypeId' => $gameaccountTypeId]);
        if (count($gameAccounts) === 0) {
            $this->app->abort(400, "GameAccount with id $userId and type $gameaccountTypeId does not exist.");
        } else {
            $gameAccount = GameAccount::createFromArray($gameAccounts[0]);
            $gameAccount = $this->loadUser($gameAccount);
            $gameAccount = $this->loadGameAccountType($gameAccount);
            $result = $gameAccount;
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