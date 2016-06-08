<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 08/06/2016
 * Time: 14:26
 */

namespace projectx\api\entity;


class Lobby implements \JsonSerializable
{
    /**
     * @var int
     * @SWG\Property(type="integer", format="int32")
     */
    private $id;

    /**
     * @var int
     * @SWG\Property(type="integer", format="int32")
     */
    private $ownerId;

    /**
     * @var int
     * @SWG\Property(type="integer", format="int32")
     */
    private $gameId;

    /**
     * @var int
     * @SWG\Property(type="integer", format="int32")
     */
    private $winnerTeam;

    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $imageData;

    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $imageType;

    public static function createFromArray(array $row)
    {
        $gameAccountType = new self();
        if (array_key_exists('id', $row)) {
            $gameAccountType->setId($row['id']);
        }
        if (array_key_exists('owner', $row)) {
            $gameAccountType->setOwnerId($row['owner']);
        }
        if (array_key_exists('game', $row)) {
            $gameAccountType->setGameId($row['game']);
        }
        if (array_key_exists('winnerTeam', $row)) {
            $gameAccountType->setWinnerTeam($row['winnerTeam']);
        }
        if (array_key_exists('iamgeData', $row)) {
            $gameAccountType->setGameId($row['iamgeData']);
        }
        if (array_key_exists('iamgeType', $row)) {
            $gameAccountType->setGameId($row['iamgeType']);
        }
        return $gameAccountType;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'owner' => $this->ownerId,
            'game' => $this->gameId,
            'winnerTeam' => $this->winnerTeam,
            'iamgeData' => $this->imageData,
            'iamgeType' => $this->imageData,
        ];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * @param int $ownerId
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
    }

    /**
     * @return int
     */
    public function getGameId()
    {
        return $this->gameId;
    }

    /**
     * @param int $gameId
     */
    public function setGameId($gameId)
    {
        $this->gameId = $gameId;
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
        $this->winnerTeam = $winnerTeam;
    }

    /**
     * @return string
     */
    public function getIamgeData()
    {
        return $this->imageData;
    }

    /**
     * @param string $iamgeData
     */
    public function setIamgeData($imageData)
    {
        $this->iamgeData = $imageData;
    }

    /**
     * @return string
     */
    public function getImageType()
    {
        return $this->imageType;
    }

    /**
     * @param string $imageType
     */
    public function setImageType($imageType)
    {
        $this->imageType = $imageType;
    }
}