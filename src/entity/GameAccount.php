<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 08/06/2016
 * Time: 14:26
 */

namespace projectx\api\entity;


class GameAccount implements \JsonSerializable
{
    /**
     * @var int
     * @SWG\Property(type="integer", format="int32")
     */
    private $userId;

    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $gameAccountType;

    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $userIdendtifier;

    public static function createFromArray(array $row)
    {
        $gameAccountType = new self();
        if (array_key_exists('user_id', $row)) {
            $gameAccountType->setUserId($row['user_id']);
        }
        if (array_key_exists('gameaccount_type_id', $row)) {
            $gameAccountType->setGameAccountType($row['gameaccount_type_id']);
        }
        if (array_key_exists('userIdentifier', $row)) {
            $gameAccountType->setUserIdendtifier($row['userIdentifier']);
        }
        return $gameAccountType;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'user' => $this->userId,
            'gameaccount_type_id' => $this->gameAccountType,
            'userIdentifier' => $this->userIdendtifier,
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
     * @return string
     */
    public function getGameAccountType()
    {
        return $this->gameAccountType;
    }

    /**
     * @param string $gameAccountType
     */
    public function setGameAccountType($gameAccountType)
    {
        $this->gameAccountType = $gameAccountType;
    }

    /**
     * @return string
     */
    public function getUserIdendtifier()
    {
        return $this->userIdendtifier;
    }

    /**
     * @param string $userIdendtifier
     */
    public function setUserIdendtifier($userIdendtifier)
    {
        $this->userIdendtifier = $userIdendtifier;
    }
}