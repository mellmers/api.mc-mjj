<?php

namespace projectx\api\gameAccount;

use Doctrine\DBAL\Connection;
use projectx\api\entity\GameAccount;

/**
 * Class GameAccountRepository
 * @package projectx\api\gameAccount
 */
class GameAccountRepository
{
    /** @var  Connection */
    private $connection;

    /**
     * GameAccountRepository constructor.
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

        $gameAccounts = $this->connection->fetchAll($sql);

        $result = [];
//        print_r($gameAccounts);

        foreach ($gameAccounts as $gameAccount) {
            $result['data'][] = GameAccount::createFromArray($gameAccount);
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
     * @param $name
     * @return GameAccount
     * @throws DatabaseException
     */
    public function getByIdAndType($id, $type)
    {
        $sql = <<<EOS
SELECT ga.*
FROM `{$this->getTableName()}` ga
WHERE ga.user_id = :name AND ga._type = :type
EOS;

        $gameAccounts = $this->connection->fetchAll($sql, ['name' => $id,'type'=>$type]);
        if (count($gameAccounts) === 0) {
            throw new DatabaseException(
                sprintf('GameAccount with id "%d" not exists!', $id)
            );
        }
        $result = [];
        $result['data'][] = GameAccount::createFromArray($gameAccounts[0]);
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