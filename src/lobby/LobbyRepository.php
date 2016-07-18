<?php

namespace projectx\api\lobby;

use Doctrine\DBAL\Connection;
use projectx\api\entity\Lobby;
use projectx\api\game\GameRepository;
use projectx\api\user\UserRepository;

/**
 * Class LobbyRepository
 * @package projectx\api\lobby
 */
class LobbyRepository
{
    /** @var  Connection */
    private $connection;
    /** @var  UserRepository */
    private $userRepo;
    /** @var  GameRepository */
    private $gameRepo;
    /**
     * LobbyRepository constructor.
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->userRepo = new UserRepository($this->connection);
        $this->gameRepo = new GameRepository($this->connection);
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
            $lobby = $this->loadUser($lobby);
            $lobby = $this->loadGame($lobby);
            $result[] = Lobby::createFromArray($lobby);
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

    private function loadUser(array $lobby)
    {
        $userResult = $this->userRepo->getById($lobby['owner_id']);
        $lobby['owner'] = $userResult;
        return $lobby;
    }

    private function loadGame(array $lobby)
    {
        $gameResult = $this->gameRepo->getById($lobby['game_id']);
        $lobby['game'] = $gameResult;
        return $lobby;
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
        $lobbys[0] = $this->loadUser($lobbys[0]);
        $lobbys[0] = $this->loadGame($lobbys[0]);
        $result = Lobby::createFromArray($lobbys[0]);
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