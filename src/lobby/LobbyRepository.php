<?php

namespace projectx\api\lobby;

use Doctrine\DBAL\Connection;
use projectx\api\bet\BetRepository;
use projectx\api\entity\Lobby;
use projectx\api\game\GameRepository;
use projectx\api\user\UserRepository;
use Silex\Application;

/**
 * Class LobbyRepository
 * @package projectx\api\lobby
 */
class LobbyRepository
{
    /** @var  Application\ */
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

        $lobbies = $this->connection->fetchAll($sql);

        $result = [];
        foreach ($lobbies as $lobby) {
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

    /**
     * @param array $lobby
     * @return array
     */
    private function loadUser(array $lobby)
    {
        $userRepo = new UserRepository($this->app, $this->connection);
        $userResult = $userRepo->getById($lobby['ownerId']);
        $lobby['owner'] = $userResult;
        return $lobby;
    }

    /**
     * @param array $lobby
     * @return array
     */
    private function loadGame(array $lobby)
    {
        $gameRepo = new GameRepository($this->app, $this->connection);
        $gameResult = $gameRepo->getById($lobby['gameId']);
        $lobby['game'] = $gameResult;
        return $lobby;
    }

    /**
     * @param $userId
     * @return array|Lobby
     */
    public function getByOwnerId($userId)
    {
        $sql = <<<EOS
SELECT l.*
FROM `{$this->getTableName()}` l
WHERE l.ownerId = :ownerId
EOS;

        $lobbies = $this->connection->fetchAll($sql, ['ownerId' => $userId]);
        if (count($lobbies) === 0) {
            $this->app->abort(400, "Lobbies with ownerId $userId does not exist.");
        } else {
            $result = [];
            foreach ($lobbies as $lobby) {
                $lobby = $this->loadUser($lobby);
                $lobby = $this->loadGame($lobby);
                $result[] = Lobby::createFromArray($lobby);
            }
            return $result;
        }
    }

    /**
     * @param $gameId
     *
     * @return array|Lobby
     */
    public function getByGameId($gameId)
    {
        $sql = <<<EOS
SELECT l.*
FROM `{$this->getTableName()}` l
WHERE l.gameId = :gameId
EOS;

        $lobbies = $this->connection->fetchAll($sql, ['gameId' => $gameId]);
        if (count($lobbies) === 0) {
            $this->app->abort(400, "Lobbies with gameId $gameId does not exist.");
        } else {
            $result = [];
            foreach ($lobbies as $lobby) {
                $lobby = $this->loadUser($lobby);
                $lobby = $this->loadGame($lobby);
                $result[] = Lobby::createFromArray($lobby);
            }
            return $result;
        }
    }

    /**
     * @param Lobby $lobby
     */
    public function create(Lobby $lobby)
    {//TODO Check if id gen is ok
        $ownerId = $lobby->getOwnerId();
        $gameId = $lobby->getGameId();
        $starttime = $lobby->getStarttime();
        if (isset($ownerId) && isset($gameId) && isset($starttime)) {
            $lobby->setId(md5($ownerId . $gameId . $starttime));
        } else {
            $this->app->abort(400, 'A user needs a valid email address.');
        }

        $data = $lobby->jsonSerialize();
        unset($data['owner_path'], $data['owner'], $data['game_path'], $data['game']);
        foreach ($data as $key => $value) {
            if (empty($value)) {
                unset($data[$key]);
            }
        }

        $this->connection->insert("`{$this->getTableName()}`", $data);

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

        $lobbies = $this->connection->fetchAll($sql, ['id' => $lobbyId]);
        if (count($lobbies) === 0) {
            $this->app->abort(400, "Lobby with id $lobbyId does not exist.");
        } else {
            $lobbies[0] = $this->loadUser($lobbies[0]);
            $lobbies[0] = $this->loadGame($lobbies[0]);
            return Lobby::createFromArray($lobbies[0]);
        }
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
    private function loadUsers(Lobby $lobby)
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