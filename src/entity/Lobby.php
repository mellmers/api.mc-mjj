<?php

namespace projectx\api\entity;


class Lobby implements \JsonSerializable
{
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $id;
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $ownerId;
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $ownerPath;
    /**
     * @var User
     * @SWG\Property(type="User")
     */
    private $owner;
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $gameId;
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $gamePath;
    /**
     * @var Game
     * @SWG\Property(type="Game")
     */
    private $game;
    /**
     * @var Game
     * @SWG\Property(type="Game")
     */
    private $winnerTeam;
    /**
     * @var int
     * @SWG\Property(type="integer", format="int32")
     */
    private $createdAt;
    /**
     * @var int
     * @SWG\Property(type="integer", format="int32")
     */
    private $starttime;
    /**
     * @var int
     * @SWG\Property(type="integer", format="int32")
     */
    private $endtime;

    public static function createFromArray(array $row)
    {
        $lobby = new self();
        if (array_key_exists('id', $row)) {
            $lobby->setId($row['id']);
        }
        if (array_key_exists('ownerId', $row)) {
            $lobby->setOwnerId($row['ownerId']);
            $lobby->setOwnerPath('/user/' . $row['ownerId']);
        }
        if (array_key_exists('owner', $row)) {
            $lobby->setOwner($row['owner']);
        }
        if (array_key_exists('gameId', $row)) {
            $lobby->setGameId($row['gameId']);
            $lobby->setGamePath('/game/' . $row['gameId']);
        }
        if (array_key_exists('game', $row)) {
            $lobby->setGame($row['game']);
        }
        if (array_key_exists('winnerTeam', $row)) {
            $lobby->setWinnerTeam($row['winnerTeam']);
        }
        if (array_key_exists('createdAt', $row)) {
            $lobby->setCreatedAt($row['createdAt']);
        }
        if (array_key_exists('starttime', $row)) {
            $lobby->setStarttime($row['starttime']);
        }
        if (array_key_exists('endtime', $row)) {
            $lobby->setEndtime($row['endtime']);
        }

        return $lobby;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'owner_id' => $this->ownerId,
            'owner_path' => $this->ownerPath,
            'owner' => $this->owner,
            'game_id' => $this->gameId,
            'game_path' => $this->gamePath,
            'game' => $this->game,
            'winnerTeam' => $this->winnerTeam,
            'createdAt' => $this->createdAt,
            'starttime' => $this->starttime,
            'endtime' => $this->endtime,
        ];
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * @param string $ownerId
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
    }

    /**
     * @return string
     */
    public function getOwnerPath()
    {
        return $this->ownerPath;
    }

    /**
     * @param string $ownerPath
     */
    public function setOwnerPath($ownerPath)
    {
        $this->ownerPath = $ownerPath;
    }

    /**
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return string
     */
    public function getGameId()
    {
        return $this->gameId;
    }

    /**
     * @param string $gameId
     */
    public function setGameId($gameId)
    {
        $this->gameId = $gameId;
    }

    /**
     * @return string
     */
    public function getGamePath()
    {
        return $this->gamePath;
    }

    /**
     * @param string $gamePath
     */
    public function setGamePath($gamePath)
    {
        $this->gamePath = $gamePath;
    }

    /**
     * @return Game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param Game $game
     */
    public function setGame($game)
    {
        $this->game = $game;
    }

    /**
     * @return int
     */
    public function getWinnerTeam()
    {
        return $this->winnerTeam;
    }

    /**
     * @param int $winnerTeam
     */
    public function setWinnerTeam($winnerTeam)
    {
        $this->winnerTeam = (int)$winnerTeam;
    }

    /**
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param int $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = (int)$createdAt;
    }

    /**
     * @return int
     */
    public function getStarttime()
    {
        return $this->starttime;
    }

    /**
     * @param int $starttime
     */
    public function setStarttime($starttime)
    {
        $this->starttime = (int)$starttime;
    }

    /**
     * @return int
     */
    public function getEndtime()
    {
        return $this->endtime;
    }

    /**
     * @param int $endtime
     */
    public function setEndtime($endtime)
    {
        $this->endtime = (int)$endtime;
    }
}