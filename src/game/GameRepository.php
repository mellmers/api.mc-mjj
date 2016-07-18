<?php

namespace projectx\api\game;

use Doctrine\DBAL\Connection;
use projectx\api\entity\Game;

/**
 * Class GameRepository
 * @package projectx\api\game
 */
class GameRepository
{
    /** @var  Connection */
    private $connection;

    /**
     * GameRepository constructor.
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

        $games = $this->connection->fetchAll($sql);

        $result = [];
//        print_r($games);

        foreach ($games as $game) {
            $result[] = Game::createFromArray($game);
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return 'game';
    }

    /**
     * @param $id
     * @return Game
     * @throws DatabaseException
     */
    public function getById($id)
    {
        $sql = <<<EOS
SELECT g.*
FROM `{$this->getTableName()}` g
WHERE g.id = :id
EOS;

        $games = $this->connection->fetchAll($sql, ['id' => $id]);
        if (count($games) === 0) {
            throw new DatabaseException(
                sprintf('Game with id "%d" does not exists!', $id)
            );
        }
        $result = [];
        $result[] = Game::createFromArray($games[0]);
        return $result;
    }

    /**
     * @param Game $game
     */
    public function create(Game $game)
    {
        $data = $game->jsonSerialize();
        $this->connection->insert("`{$this->getTableName()}`", $data);
        $game->setName($this->connection->lastInsertId());
    }
}