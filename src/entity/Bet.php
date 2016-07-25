<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 08/06/2016
 * Time: 14:27
 */

namespace projectx\api\entity;


class Bet implements \JsonSerializable
{
    /**
     * @var string
     */
    private $userId;
    /**
     * @var string
     */
    private $userPath;
    /**
     * @var User
     */
    private $user;
    /**
     * @var string
     */
    private $lobbyId;
    /**
     * @var string
     */
    private $lobbyPath;
    /**
     * @var Lobby
     */
    private $lobby;
    /**
     * @var int
     */
    private $amount;
    /**
     * @var int
     */
    private $team;


    /*
     *these need to be inside of a SWG/Definition tag
     * we gonna do that later
     * @SWG\Property(type="string")
     * @SWG\Property(type="string")
     * @SWG\Property(type="User")
     * @SWG\Property(type="string")
     * @SWG\Property(type="string")
     * @SWG\Property(type="Lobby")
     * @SWG\Property(type="integer", format="int32")
     * @SWG\Property(type="integer", format="int32")
     */

    public static function createFromArray(array $row)
    {
        $bet = new self();
        if (array_key_exists('userId', $row)) {
            $bet->setUserId($row['user_id']);
            $bet->setUserPath('/user/' . $row['userId']);
        }
        if (array_key_exists('user', $row)) {
            $bet->setUser($row['user']);
        }
        if (array_key_exists('lobbyId', $row)) {
            $bet->setLobbyId($row['lobbyId']);
            $bet->setLobbyPath('/lobby/' . $row['lobbyId']);
        }
        if (array_key_exists('lobby', $row)) {
            $bet->setLobby($row['lobby']);
        }
        if (array_key_exists('amount', $row)) {
            $bet->setAmount($row['amount']);
        }
        if (array_key_exists('team', $row)) {
            $bet->setTeam($row['team']);
        }


        return $bet;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'userId' => $this->userId,
            'userPath' => $this->userPath,
            'user' => $this->user,
            'lobbyId' => $this->lobbyId,
            'lobbyPath' => $this->lobbyPath,
            'lobby' => $this->lobby,
            'amount' => $this->amount,
            'team' => $this->team,
        ];
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return String
     */
    public function getUserPath()
    {
        return $this->userPath;
    }

    /**
     * @param String $userPath
     */
    public function setUserPath($userPath)
    {
        $this->userPath = $userPath;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getLobbyId()
    {
        return $this->lobbyId;
    }

    /**
     * @param string $lobbyId
     */
    public function setLobbyId($lobbyId)
    {
        $this->lobbyId = $lobbyId;
    }

    /**
     * @return String
     */
    public function getLobbyPath()
    {
        return $this->lobbyPath;
    }

    /**
     * @param String $lobbyPath
     */
    public function setLobbyPath($lobbyPath)
    {
        $this->lobbyPath = $lobbyPath;
    }

    /**
     * @return Lobby
     */
    public function getLobby()
    {
        return $this->lobby;
    }

    /**
     * @param Lobby $lobby
     */
    public function setLobby($lobby)
    {
        $this->lobby = $lobby;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = (int)$amount;
    }

    /**
     * @return int
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param int $team
     */
    public function setTeam($team)
    {
        $this->team = (int)$team;
    }

}