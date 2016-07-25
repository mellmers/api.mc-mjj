<?php

namespace projectx\api\lobby;

use Doctrine\DBAL\Connection;
use projectx\api\Application;
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
    /** @var  UserRepository */
    private $userRepo;
    /** @var  GameRepository */
    private $gameRepo;

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
        $this->userRepo = new UserRepository($app, $connection);
        $this->gameRepo = new GameRepository($app, $connection);
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
        $userResult = $this->userRepo->getById($lobby['owner_id']);
        $lobby['owner'] = $userResult;
        return $lobby;
    }

    /**
     * @param array $lobby
     * @return array
     */
    private function loadGame(array $lobby)
    {
        $gameResult = $this->gameRepo->getById($lobby['game_id']);
        $lobby['game'] = $gameResult;
        return $lobby;
    }

    /**
     * @param $id
     * @return Lobby
     */
    public function getById($id)
    {
        $sql = <<<EOS
SELECT l.*
FROM `{$this->getTableName()}` l
WHERE l.id = :id
EOS;

        $lobbies = $this->connection->fetchAll($sql, ['id' => $id]);
        if (count($lobbies) === 0) {
            $this->app->abort(400, "Lobby with id $id does not exist.");
        }
        $lobbies[0] = $this->loadUser($lobbies[0]);
        $lobbies[0] = $this->loadGame($lobbies[0]);
        return Lobby::createFromArray($lobbies[0]);
    }

    /**
     * @param $ownerId
     *
     * @return array|Lobby
     */
    public function getByOwnerId($ownerId)
    {
        $sql = <<<EOS
SELECT l.*
FROM `{$this->getTableName()}` l
WHERE l.owner_id = :owner_id
EOS;

        $lobbies = $this->connection->fetchAll($sql, ['owner_id' => $ownerId]);
        if (count($lobbies) === 0) {
            $this->app->abort(400, "Lobbies with ownerId $ownerId does not exist.");
        }
        $result = [];
        foreach ($lobbies as $lobby) {
            $lobby = $this->loadUser($lobby);
            $lobby = $this->loadGame($lobby);
            $result[] = Lobby::createFromArray($lobby);
        }
        return $result;
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
WHERE l.game_id = :game_id
EOS;

        $lobbies = $this->connection->fetchAll($sql, ['game_id' => $gameId]);
        if (count($lobbies) === 0) {
            $this->app->abort(400, "Lobbies with gameId $gameId does not exist.");
        }
        $result = [];
        foreach ($lobbies as $lobby) {
            $lobby = $this->loadUser($lobby);
            $lobby = $this->loadGame($lobby);
            $result[] = Lobby::createFromArray($lobby);
        }
        return $result;
    }

    /**
     * @param Lobby $lobby
     */
    public function create(Lobby $lobby)
    {
        $lobby->setId(Application::generateGUIDv4());
        $data = $lobby->jsonSerialize();
        $this->connection->insert("`{$this->getTableName()}`", $data);
    }
}