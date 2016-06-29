<?php

namespace projectx\api\bet;

use Doctrine\DBAL\Connection;
use projectx\api\entity\Bet;

/**
 * Class BetRepository
 * @package projectx\api\bet
 */
class BetRepository
{
    /** @var  Connection */
    private $connection;

    /**
     * BetRepository constructor.
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

        $bets = $this->connection->fetchAll($sql);

        $result = [];
//        print_r($bets);

        foreach ($bets as $bet) {
            $result['data'][] = Bet::createFromArray($bet);
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
     * @param $userId
     * @param $lobbyId
     * @return Bet
     * @throws DatabaseException
     */
    public function getByIds($userId, $lobbyId)
    {
        $sql = <<<EOS
SELECT b.*
FROM `{$this->getTableName()}` b
WHERE b.user_id = :userId AND lobby_id = :lobbyId
EOS;

        $bets = $this->connection->fetchAll($sql, ['userId' => $userId, 'lobbyId' => $lobbyId]);
        if (count($bets) === 0) {
            throw new DatabaseException(
                sprintf('Bet with id "%d" does not exists!', $userId)
            );
        }
        $result = [];
        $result['data'][] = Bet::createFromArray($bets[0]);
        return $result;
    }

    /**
     * @param Bet $bet
     */
    public function create(Bet $bet)
    {
        $data = $bet->jsonSerialize();
        $this->connection->insert("`{$this->getTableName()}`", $data);
        $bet->setId($this->connection->lastInsertId());
    }
}