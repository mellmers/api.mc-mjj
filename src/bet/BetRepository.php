<?php

namespace projectx\api\bet;

use Doctrine\DBAL\Connection;
use projectx\api\entity\Bet;
use projectx\api\lobby\LobbyRepository;
use projectx\api\user\UserRepository;
use Silex\Application;

/**
 * Class BetRepository
 * @package projectx\api\bet
 */
class BetRepository
{
    /** @var  Application\*/
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

        $bets = $this->connection->fetchAll($sql);
        $result = [];
        foreach ($bets as $bet) {
            $bet = $this->loadUser($bet);
            $bet = $this->loadLobby($bet);
            $result[] = Bet::createFromArray($bet);
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
     * @param array $bet
     * @return array
     */
    private function loadUser(array $bet)
    {
        $userRepo = new UserRepository($this->app, $this->connection);
        $userResult = $userRepo->getById($bet['userId']);
        $bet['user'] = $userResult;
        return $bet;
    }

    /**
     * @param array $bet
     * @return array
     */
    private function loadLobby(array $bet)
    {
        $lobbyRepo = new LobbyRepository($this->app, $this->connection);
        $lobbyResult = $lobbyRepo->getById($bet['lobbyId']);
        $bet['lobby'] = $lobbyResult;
        return $bet;
    }

    /**
     * @param $lobbyId
     * @return Bet[]
     */
    public function getByLobbyId($lobbyId)
    {
        $sql = <<<EOS
SELECT b.*
FROM `{$this->getTableName()}` b
WHERE  b.lobbyId = :lobbyId
EOS;

        $bets = $this->connection->fetchAll($sql, ['lobbyId' => $lobbyId]);
        if (count($bets) === 0) {
            $this->app->abort(400, "Lobby with id $lobbyId has no bets.");
        }
        $result = [];
        foreach ($bets as $bet) {
            $bet = $this->loadUser($bet);
            $bet = $this->loadLobby($bet);
            $result[] = Bet::createFromArray($bet);
        }
        return $result;
    }

    /**
     * @param $userId
     * @return array
     */
    public function getByUserId($userId)
    {
        $sql = <<<EOS
SELECT b.*
FROM `{$this->getTableName()}` b
WHERE b.userId = :userId
EOS;

        $bets = $this->connection->fetchAll($sql, ['userId' => $userId]);
        if (count($bets) === 0) {
            $this->app->abort(400, "User with id $userId has no bets.");
        }
        $result = [];
        foreach ($bets as $bet) {
            $bet = $this->loadUser($bet);
            $bet = $this->loadLobby($bet);
            $result[] = Bet::createFromArray($bet);
        }
        return $result;
    }

    /**
     * @param Bet $bet
     * @return Bet
     */
    public function create(Bet $bet)
    {        //TODO Check if id gen is ok
        $userId = $bet->getUserId();
        $lobbyId = $bet->getLobbyId();
        if (isset($userId) && isset($lobbyId)) {

        } else {
            $this->app->abort(400, 'A bet needs a lobby id and a user id');
        }

        $data = $bet->jsonSerialize();
        unset($data['user_path'], $data['user'], $data['lobby_path'], $data['lobby']);
        foreach ($data as $key => $value) {
            if (empty($value)) {
                unset($data[$key]);
            }
        }

        $this->connection->insert("`{$this->getTableName()}`", $data);

        return $this->getByIds($bet->getUserId(), $bet->getLobbyId());
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

        $bets = $this->connection->fetchAll($sql, ['userId' => $userId, 'lobbyId' => $lobbyId]);
        if (count($bets) === 0) {
            $this->app->abort(400, "Bet with userId $userId does not exist.");
        }
        $bets[0] = $this->loadUser($bets[0]);
        $bets[0] = $this->loadLobby($bets[0]);
        return Bet::createFromArray($bets[0]);
    }
}