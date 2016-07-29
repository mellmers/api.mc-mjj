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

        $result = [];

        $gameAccountTypes = $this->connection->fetchAll($sql);
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
        return 'gameaccountType';
    }

    /**
     * @param GameAccountType $gameAccountType
     * @return GameAccountType
     */
    public function create($gameAccountType)
    {
        $result = null;

        if (empty($gameAccountType->getName())) {
            $this->app->abort(400, 'A gameaccounttype need a name');
        } else {
            $gameAccountType->setId(Application::generateGUIDv4());
            $data = $gameAccountType->jsonSerialize();
            foreach ($data as $key => $value) {
                if (empty($value)) {
                    unset($data[$key]);
                }
            }

            $this->connection->insert("`{$this->getTableName()}`", $data);

            $result = $this->getById($gameAccountType->getId());
        }
        return $result;
    }

    /**
     * @param $id
     * @return GameAccountType
     */
    public function getById($id)
    {
        $sql = <<<EOS
SELECT gat.*
FROM `{$this->getTableName()}` gat
WHERE gat.id = :id
EOS;

        $result = null;

        $gameAccountTypes = $this->connection->fetchAll($sql, ['id' => $id]);
        if (count($gameAccountTypes) === 0) {
            $this->app->abort(400, "GameAccountType with id $id does not exist!");
        } else {
            $result = GameAccountType::createFromArray($gameAccountTypes[0]);
        }
        return $result;
    }
}