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
            $result['data'][] = GameAccountType::createFromArray($gameAccountType);
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
     * @param $name
     * @return GameAccountType
     * @throws DatabaseException
     */
    public function getByName($name)
    {
        $sql = <<<EOS
SELECT gat.*
FROM `{$this->getTableName()}` gat
WHERE gat.name = :name
EOS;

        $gameAccountTypes = $this->connection->fetchAll($sql, ['name' => $name]);
        if (count($gameAccountTypes) === 0) {
            throw new DatabaseException(
                sprintf('GameAccountType with name "%d" not exists!', $name)
            );
        }
        $result = [];
        $result['data'][] = GameAccountType::createFromArray($gameAccountTypes[0]);
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