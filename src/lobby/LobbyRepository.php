<?php

namespace projectx\api\lobby;

use Doctrine\DBAL\Connection;
use projectx\api\entity\Lobby;

/**
 * Class LobbyRepository
 * @package projectx\api\lobby
 */
class LobbyRepository
{
    /** @var  Connection */
    private $connection;

    /**
     * LobbyRepository constructor.
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

        $lobbys = $this->connection->fetchAll($sql);

        $result = [];
//        print_r($lobbys);

        foreach ($lobbys as $lobby) {
            $result['data'][] = Lobby::createFromArray($lobby);
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return 'lobby';
    }

    /**
     * @param $id
     * @return Lobby
     * @throws DatabaseException
     */
    public function getById($id)
    {
        $sql = <<<EOS
SELECT l.*
FROM `{$this->getTableName()}` l
WHERE l.id = :id
EOS;

        $lobbys = $this->connection->fetchAll($sql, ['id' => $id]);
        if (count($lobbys) === 0) {
            throw new DatabaseException(
                sprintf('Lobby with id "%d" does not exists!', $id)
            );
        }
        $result = [];
        $result['data'][] = Lobby::createFromArray($lobbys[0]);
        return $result;
    }

    /**
     * @param Lobby $lobby
     */
    public function create(Lobby $lobby)
    {
        $data = $lobby->jsonSerialize();
        $this->connection->insert("`{$this->getTableName()}`", $data);
        $lobby->setId($this->connection->lastInsertId());
    }
}