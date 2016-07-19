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
     * @var int
     * @SWG\Property(type="integer", format="int32")
     */
    private $userId;
    /**
     * @var String
     * @SWG\Property(type="string")
     */
    private $userPath;
    /**
     * @var User
     * @SWG\Property(type="User")
     */
    private $user;
    /**
     * @var int
     * @SWG\Property(type="integer", format="int32")
     */
    private $lobbyId;
    /**
     * @var String
     * @SWG\Property(type="string")
     */
    private $lobbyPath;
    /**
     * @var Lobby
     * @SWG\Property(type="integer", format="int32")
     */
    private $lobby;
    /**
     * @var int
     * @SWG\Property(type="integer", format="int32")
     */
    private $amount;

    /**
     * @var int
     * @SWG\Property(type="integer", format="int32")
     */
    private $team;



    public static function createFromArray(array $row)
    {
        $bet = new self();
        if (array_key_exists('user_id', $row)) {
            $bet->setUserId($row['user_id']);
            $bet->setUserPath("/user/" . $row['user_id']);
        }
        if (array_key_exists('user', $row)) {
            $bet->setUser($row['user']);
        }
        if (array_key_exists('lobby_id', $row)) {
            $bet->setLobbyId($row['lobby_id']);
            $bet->setLobbyPath("/lobby/" . $row['lobby_id']);
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
            'user_id' => $this->userId,
            'user_path' => $this->userPath,
            'user' => $this->user,
            'lobby_id' => $this->lobbyId,
            'lobby_path' => $this->lobbyPath,
            'lobby' => $this->lobby,
            'amount' => $this->amount,
            'team' => $this->team,
        ];
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
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
     * @return int
     */
    public function getLobbyId()
    {
        return $this->lobbyId;
    }

    /**
     * @param int $lobbyId
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
        $this->amount = $amount;
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
        $this->team = $team;
    }

}