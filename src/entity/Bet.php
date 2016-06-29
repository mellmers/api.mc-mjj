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
     * @var int
     * @SWG\Property(type="integer", format="int32")
     */
    private $lobbyId;

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
        $gameAccountType = new self();
        if (array_key_exists('user_id', $row)) {
            $gameAccountType->setUserId($row['user_id']);
        }
        if (array_key_exists('lobby_id', $row)) {
            $gameAccountType->setLobbyId($row['lobby_id']);
        }
        if (array_key_exists('amount', $row)) {
            $gameAccountType->setAmount($row['amount']);
        }
        if (array_key_exists('team', $row)) {
            $gameAccountType->setTeam($row['team']);
        }


        return $gameAccountType;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'user_id' => $this->userId,
            'lobby_id' => $this->lobbyId,
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