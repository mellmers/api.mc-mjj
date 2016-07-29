<?php

namespace projectx\api\bet;

use Doctrine\DBAL\Connection;
use projectx\api\Application;
use projectx\api\entity\Bet;
use projectx\api\lobby\LobbyRepository;
use projectx\api\user\UserRepository;

/**
 * Class BetRepository
 * @package projectx\api\bet
 */
class BetRepository
{
    /** @var  Application */
    private $app;

    /** @var  Connection */
    private $connection;

    /**
     * BetRepository constructor.
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

        $bets = $this->connection->fetchAll($sql);
        foreach ($bets as $key) {
            $bet = Bet::createFromArray($key);
            $bet = $this->loadUser($bet);
            $bet = $this->loadLobby($bet);
            $result[] = $bet;
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return 'bet';
    }

    /**
     * @param Bet $bet
     * @return Bet
     */
    private function loadUser($bet)
    {
        $userRepo = new UserRepository($this->app, $this->connection);
        $user = $userRepo->getById($bet->getUserId());
        $bet->setUser($user);
        return $bet;
    }

    /**
     * @param Bet $bet
     * @return Bet
     */
    private function loadLobby($bet)
    {
        $lobbyRepo = new LobbyRepository($this->app, $this->connection);
        $lobby = $lobbyRepo->getById($bet->getLobbyId());
        $bet->setLobby($lobby);
        return $bet;
    }

    /**
     * @param $lobbyId
     * @return array
     */
    public function getByLobbyId($lobbyId)
    {
        $sql = <<<EOS
SELECT b.*
FROM `{$this->getTableName()}` b
WHERE  b.lobbyId = :lobbyId
EOS;

        $result = [];

        $bets = $this->connection->fetchAll($sql, ['lobbyId' => $lobbyId]);
        if (count($bets) === 0) {
            $this->app->abort(400, "Lobby with id $lobbyId has no bets.");
        }
        else {
            foreach ($bets as $key) {
                $bet = Bet::createFromArray($key);
                $bet = $this->loadUser($bet);
                $bet = $this->loadLobby($bet);
                $result[] = $bet;
            }
        }
        return $result;
    }

    /**
     * @param $userId
     * @return Bet
     */
    public function getByUserId($userId)
    {
        $sql = <<<EOS
SELECT b.*
FROM `{$this->getTableName()}` b
WHERE b.userId = :userId
EOS;

        $result = null;

        $bets = $this->connection->fetchAll($sql, ['userId' => $userId]);
        if (count($bets) === 0) {
            $this->app->abort(400, "User with id $userId has no bets.");
        }
        else {
            foreach ($bets as $key) {
                $bet = Bet::createFromArray($key);
                $bet = $this->loadUser($bet);
                $bet = $this->loadLobby($bet);
                $result = $bet;
            }
        }
        return $result;
    }

    /**
     * @param Bet $bet
     * @return Bet
     */
    public function create(Bet $bet)
    {
        $result = null;

        if(empty($bet->getUserId()) && empty($bet->getLobbyId())) {
            $this->app->abort(400, 'A bet needs a lobbyId and a userId');
        } else {
            $data = $bet->jsonSerialize();
            unset($data['userPath'], $data['user'], $data['lobby_path'], $data['lobby']);
            foreach ($data as $key => $value) {
                if (empty($value)) {
                    unset($data[$key]);
                }
            }

            $this->connection->insert("`{$this->getTableName()}`", $data);

            $result = $this->getByIds($bet->getUserId(), $bet->getLobbyId());
        }
        return $result;
    }

    /**
     * @param $userId
     * @param $lobbyId
     * @return Bet
     */
    public function getByIds($userId, $lobbyId)
    {
        $sql = <<<EOS
SELECT b.*
FROM `{$this->getTableName()}` b
WHERE b.userId = :userId AND b.lobbyId = :lobbyId
EOS;

        $result = null;

        $bets = $this->connection->fetchAll($sql, ['userId' => $userId, 'lobbyId' => $lobbyId]);
        if (count($bets) === 0) {
            $this->app->abort(400, "Bet with userId $userId does not exist.");
        }
        else {
            $bet = Bet::createFromArray($bets[0]);
            $bet = $this->loadUser($bet);
            $bet = $this->loadLobby($bet);
            $result = $bet;
        }
        return $result;
    }
}