<?php

namespace projectx\api\game;

use Doctrine\DBAL\Connection;
use projectx\api\entity\Game;
use Silex\Application;

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

        $games = $this->connection->fetchAll($sql);

        $result = [];

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
     * @return array
     */
    public function getByGenre($genre)
    {
        $sql = <<<EOS
SELECT g.*
FROM `{$this->getTableName()}` g
WHERE g.genre = :genre
EOS;

        $games = $this->connection->fetchAll($sql, ['genre' => $genre]);
        if (count($games) === 0) {
            $this->app->abort(400, 'No games with the genre: ' . $genre);
        }
        $result = [];
        foreach ($games as $game) {
            $result[] = Game::createFromArray($game);
        }
        return $result;
    }

    /**
     * @param Game $game
     */
    public function create(Game $game)
    {
        $name = $game->getName();
        $typ = $game->getTyp();
        $genre = $game->getGenre();
        if (isset($name) && isset($typ) && isset($genre)) {
            $game->setId(md5($name . $typ . $genre));
        } else {
            $this->app->abort(400, 'A game need a name');
        }

        $data = $game->jsonSerialize();
        //unset($data['owner_path']);
        foreach ($data as $key => $value) {
            if (empty($value)) {
                unset($data[$key]);
            }
        }

        $this->connection->insert("`{$this->getTableName()}`", $data);

        return $this->getById($game->getId());
    }

    /**
     * @param $gameId
     * @return array
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
            $this->app->abort(400, "Game with id $id does not exist!");
        }
        $result[] = Game::createFromArray($games[0]);
        return $result;
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