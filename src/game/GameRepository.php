<?php

namespace projectx\api\game;

use Doctrine\DBAL\Connection;
use projectx\api\Application;
use projectx\api\entity\Game;

/**
 * Class GameRepository
 * @package projectx\api\game
 */
class GameRepository
{
    /** @var  Application */
    private $app;

    /** @var  Connection */
    private $connection;

    /**
     * GameRepository constructor.
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

        $games = $this->connection->fetchAll($sql);
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
     * @param $genre
     * @return Game
     */
    public function getByGenre($genre)
    {
        $sql = <<<EOS
SELECT g.*
FROM `{$this->getTableName()}` g
WHERE g.genre = :genre
EOS;

        $result = null;

        $games = $this->connection->fetchAll($sql, ['genre' => $genre]);
        if (count($games) === 0) {
            $this->app->abort(400, 'No games with the genre: ' . $genre);
        }
        else {
            foreach ($games as $game) {
                $result = Game::createFromArray($game);
            }
        }
        return $result;
    }

    /**
     * @param Game $game
     * @return Game
     */
    public function create(Game $game)
    {
        $result = null;

        if (empty($game->getName())) {
            $this->app->abort(400, 'A game need a name');
        } else if(empty($game->getType())) {
            $this->app->abort(400, 'A game need a type');
        } else if(empty($game->getRules())) {
            $this->app->abort(400, 'A game need rules');
        }  else if(empty($game->getGenre())) {
            $this->app->abort(400, 'A game need a genre');
        } else if (empty($game->getTimelimit())) {
            $this->app->abort(400, 'A game need a timelimit in seconds');
        } else {
            $game->setId(Application::generateGUIDv4());
            $data = $game->jsonSerialize();
            foreach ($data as $key => $value) {
                if (empty($value)) {
                    unset($data[$key]);
                }
            }

            $this->connection->insert("`{$this->getTableName()}`", $data);

            $result = $this->getById($game->getId());
        }
        return $result;
    }

    /**
     * @param $id
     * @return Game
     */
    public function getById($id)
    {
        $sql = <<<EOS
SELECT g.*
FROM `{$this->getTableName()}` g
WHERE g.id = :id
EOS;

        $result = null;

        $games = $this->connection->fetchAll($sql, ['id' => $id]);
        if (count($games) === 0) {
            $this->app->abort(400, "Game with id $id does not exist!");
        }
        else {
            $result = Game::createFromArray($games[0]);
        }
        return $result;
    }

    /**
     * @param Game $game
     * @return Game
     */
    public function update(Game $game)
    {
        $data = $game->jsonSerialize();
        foreach ($data as $key => $value) {
            if (empty($value)) {
                unset($data[$key]);
            }
        }

        $this->connection->update("`{$this->getTableName()}`", $data, ["id" => $game->getId()]);

        return $this->getById($game->getId());
    }

    /**
     * @param $gameId
     *
     * @return Game
     */
    public function deleteGame($gameId)
    {
        $game = $this->getById($gameId);
        $sql = <<<EOS
DELETE
FROM `{$this->getTableName()}`
WHERE id = :id
EOS;
        try {
            $this->connection->executeQuery($sql, ['id' => $gameId]);
        } catch (\Doctrine\DBAL\DBALException $e) {
            $this->app->abort(400, "Game with id $gameId does not exist.");
        }
        return $game;
    }
}