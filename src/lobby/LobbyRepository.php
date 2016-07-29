<?php

namespace projectx\api\lobby;

use DateTime;
use Doctrine\DBAL\Connection;
use projectx\api\Application;
use projectx\api\bet\BetRepository;
use projectx\api\entity\Lobby;
use projectx\api\game\GameRepository;
use projectx\api\user\UserRepository;

/**
 * Class LobbyRepository
 * @package projectx\api\lobby
 */
class LobbyRepository
{
    /** @var  Application */
    private $app;

    /** @var  Connection */
    private $connection;

    /**
     * LobbyRepository constructor.
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

        $lobbies = $this->connection->fetchAll($sql);
        foreach ($lobbies as $key) {
            $lobby = Lobby::createFromArray($key);
            $lobby = $this->loadOwner($lobby);
            $lobby = $this->loadGame($lobby);
            $result[] = $lobby;
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
     * @param Lobby $lobby
     * @return Lobby
     */
    private function loadOwner($lobby)
    {
        $userRepo = new UserRepository($this->app, $this->connection);
        $owner = $userRepo->getById($lobby->getOwnerId());
        $lobby->setOwner($owner);
        return $lobby;
    }

    /**
     * @param Lobby $lobby
     * @return Lobby
     */
    private function loadGame($lobby)
    {
        $gameRepo = new GameRepository($this->app, $this->connection);
        $game = $gameRepo->getById($lobby->getGameId());
        $lobby->setGame($game);
        return $lobby;
    }

    /**
     * @param $userId
     * @return Lobby
     */
    public function getByOwnerId($userId)
    {
        $sql = <<<EOS
SELECT l.*
FROM `{$this->getTableName()}` l
WHERE l.ownerId = :ownerId
EOS;

        $result = null;

        $lobbies = $this->connection->fetchAll($sql, ['ownerId' => $userId]);
        if (count($lobbies) === 0) {
            $this->app->abort(400, "Lobbies with ownerId $userId does not exist.");
        } else {
            foreach ($lobbies as $lobby) {
                $lobby = Lobby::createFromArray($lobby);
                $lobby = $this->loadOwner($lobby);
                $lobby = $this->loadGame($lobby);
                $result = $lobby;
            }
        }
        return $result;
    }

    /**
     * @param $gameId
     *
     * @return Lobby
     */
    public function getByGameId($gameId)
    {
        $sql = <<<EOS
SELECT l.*
FROM `{$this->getTableName()}` l
WHERE l.gameId = :gameId
EOS;

        $result = null;

        $lobbies = $this->connection->fetchAll($sql, ['gameId' => $gameId]);
        if (count($lobbies) === 0) {
            $this->app->abort(400, "Lobbies with gameId $gameId does not exist.");
        } else {
            foreach ($lobbies as $lobby) {
                $lobby = Lobby::createFromArray($lobby);
                $lobby = $this->loadOwner($lobby);
                $lobby = $this->loadGame($lobby);
                $result = $lobby;
            }
        }
        return $result;
    }

    /**
     * @param Lobby $lobby
     * @return Lobby
     */
    public function create($lobby)
    {
        $result = null;

        if (empty($lobby->getOwnerId())) {
            $this->app->abort(400, 'A lobby needs a ownerId');
        } else if(empty($lobby->getGameId())) {
            $this->app->abort(400, 'A lobby needs a ownerId');
        } else {
            $lobby->setId(Application::generateGUIDv4());
            $date = new DateTime();
            $lobby->setCreatedAt($date->getTimestamp());
            $data = $lobby->jsonSerialize();
            unset($data['ownerPath'], $data['owner'], $data['gamePath'], $data['game'], $data['starttime'], $data['endtime']);
            foreach ($data as $key => $value) {
                if (empty($value)) {
                    unset($data[$key]);
                }
            }

            $this->connection->insert("`{$this->getTableName()}`", $data);

            $result = $this->getById($lobby->getId());
        }
        return $result;
    }


    /**
     * @param Lobby $lobby
     * @return Lobby
     */
    public function update(Lobby $lobby)
    {
        $data = $lobby->jsonSerialize();
        unset($data['ownerPath'], $data['owner'], $data['gamePath'], $data['game'], $data['starttime'], $data['endtime']);
        foreach ($data as $key => $value) {
            if (empty($value)) {
                unset($data[$key]);
            }
        }

        $this->connection->update("`{$this->getTableName()}`", $data, ["id" => $lobby->getId()]);

        return $this->getById($lobby->getId());
    }

    /**
     * @param $lobbyId
     * @return Lobby
     */
    public function getById($lobbyId)
    {
        $sql = <<<EOS
SELECT l.*
FROM `{$this->getTableName()}` l
WHERE l.id = :id
EOS;

        $result = null;

        $lobbies = $this->connection->fetchAll($sql, ['id' => $lobbyId]);
        if (count($lobbies) === 0) {
            $this->app->abort(400, "Lobby with id $lobbyId does not exist.");
        } else {
            $lobby = Lobby::createFromArray($lobbies[0]);
            $lobby = $this->loadOwner($lobby);
            $lobby = $this->loadGame($lobby);
            $result = $lobby;
        }
        return $result;
    }

    /**
     * @param $lobbyId
     * @return Lobby
     */
    public function getByIdWithAllUsers($lobbyId)
    {
        $lobby = $this->getById($lobbyId);
        $lobby = $this->loadUsers($lobby);
        return $lobby;
    }

    /**
     * @param Lobby $lobby
     * @return Lobby
     */
    private function loadUsers($lobby)
    {
        $betRepo = new BetRepository($this->app, $this->connection);
        $betsOfLobby = $betRepo->getByLobbyId($lobby->getId());
        $usersOfLobby = [];
        foreach ($betsOfLobby as $bet) {
            $userId = $bet->getUserId();
            $userRepo = new UserRepository($this->app, $this->connection);
            $usersOfLobby[] = $userRepo->getById($userId);
        }
        $lobby->setUsers($usersOfLobby);
        return $lobby;
    }

    /**
     * @param $lobbyId
     *
     * @return Lobby
     */
    public function deleteLobby($lobbyId)
    {
        $lobby = $this->getById($lobbyId);
        $sql = <<<EOS
DELETE
FROM `{$this->getTableName()}`
WHERE id = :id
EOS;
        try {
            $this->connection->executeQuery($sql, ['id' => $lobbyId]);
        } catch (\Doctrine\DBAL\DBALException $e) {
            $this->app->abort(400, "Lobby with id $lobbyId does not exist.");
        }
        return $lobby;
    }
}