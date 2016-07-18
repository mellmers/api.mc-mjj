<?php

namespace projectx\api\gameAccountType;

use Doctrine\DBAL\Connection;
use projectx\api\entity\GameAccountType;

/**
 * Class GameAccountTypeRepository
 * @package projectx\api\gameAccountType
 */
class GameAccountTypeRepository
{
    /** @var  Connection */
    private $connection;

    /**
     * GameAccountTypeRepository constructor.
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

        $gameAccountTypes = $this->connection->fetchAll($sql);

        $result = [];
//        print_r($gameAccountTypes);

        foreach ($gameAccountTypes as $gameAccountType) {
            $result[] = GameAccountType::createFromArray($gameAccountType);
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return 'gameaccount_type';
    }

    /**
     * @param $id
     * @return GameAccountType
     * @throws DatabaseException
     */
    public function getById($id)
    {
        $sql = <<<EOS
SELECT gat.*
FROM `{$this->getTableName()}` gat
WHERE gat.id = :id
EOS;

        $gameAccountTypes = $this->connection->fetchAll($sql, ['id' => $id]);
        if (count($gameAccountTypes) === 0) {
            throw new DatabaseException(
                sprintf('GameAccountType with id "%d" does not exists!', $id)
            );
        }
        $result = [];
        $result[] = GameAccountType::createFromArray($gameAccountTypes[0]);
        return $result;
    }

    /**
     * @param GameAccountType $gameAccountType
     */
    public function create(GameAccountType $gameAccountType)
    {
        $data = $gameAccountType->jsonSerialize();
        $this->connection->insert("`{$this->getTableName()}`", $data);
        $gameAccountType->setName($this->connection->lastInsertId());
    }
}