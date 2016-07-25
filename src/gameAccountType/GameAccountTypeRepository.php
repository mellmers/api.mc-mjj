<?php

namespace projectx\api\gameAccountType;

use Doctrine\DBAL\Connection;
use projectx\api\Application;
use projectx\api\entity\GameAccountType;

/**
 * Class GameAccountTypeRepository
 * @package projectx\api\gameAccountType
 */
class GameAccountTypeRepository
{
    /** @var  Application */
    private $app;

    /** @var  Connection */
    private $connection;

    /**
     * GameAccountTypeRepository constructor.
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

        $gameAccountTypes = $this->connection->fetchAll($sql);

        $result = [];

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
     *
     * @return GameAccountType
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
            $this->app->abort(400, "GameAccountType with id $id does not exist!");
        }
        return GameAccountType::createFromArray($gameAccountTypes[0]);
    }

    /**
     * @param GameAccountType $gameAccountType
     */
    public function create(GameAccountType $gameAccountType)
    {
        $gameAccountType->setId(Application::generateGUIDv4());
        $data = $gameAccountType->jsonSerialize();
        $this->connection->insert("`{$this->getTableName()}`", $data);
        $gameAccountType->setName($this->connection->lastInsertId());
    }
}