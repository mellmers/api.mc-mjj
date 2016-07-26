<?php

namespace projectx\api\entity;


class GameAccount implements \JsonSerializable
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
    private $gameAccountTypeId;
    /**
     * @var String
     */
    private $gameAccountTypePath;
    /**
     * @var GameAccount
     */
    private $gameAccountType;
    /**
     * @var string
     */
    private $userIdentifier;

    public static function createFromArray(array $row)
    {
        $gameAccountType = new self();
        if (array_key_exists('userId', $row)) {
            $gameAccountType->setUserId($row['userId']);
            $gameAccountType->setUserPath('/user/' . $row['userId']);
        }
        if (array_key_exists('user', $row)) {
            $gameAccountType->setUser($row['user']);
        }
        if (array_key_exists('gameaccountTypeId', $row)) {
            $gameAccountType->setGameAccountTypeId($row['gameaccountTypeId']);
            $gameAccountType->setGameAccountTypePath('/gameaccounttype/' . $row['gameaccountTypeId']);
        }
        if (array_key_exists('gameaccountType', $row)) {
            $gameAccountType->setGameAccountType($row['gameaccountType']);
        }
        if (array_key_exists('userIdentifier', $row)) {
            $gameAccountType->setUserIdentifier($row['userIdentifier']);
        }
        return $gameAccountType;
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
            'gameaccountTypeId' => $this->gameAccountTypeId,
            'gameaccountTypePath' => $this->gameAccountTypePath,
            'gameaccountType' => $this->gameAccountType,
            'userIdentifier' => $this->userIdentifier,
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
     * @return string
     */
    public function getUserPath()
    {
        return $this->userPath;
    }

    /**
     * @param string $userPath
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
    public function getGameAccountTypeId()
    {
        return $this->gameAccountTypeId;
    }

    /**
     * @param string $gameAccountTypeId
     */
    public function setGameAccountTypeId($gameAccountTypeId)
    {
        $this->gameAccountTypeId = $gameAccountTypeId;
    }

    /**
     * @return string
     */
    public function getGameAccountTypePath()
    {
        return $this->gameAccountTypePath;
    }

    /**
     * @param string $gameAccountTypePath
     */
    public function setGameAccountTypePath($gameAccountTypePath)
    {
        $this->gameAccountTypePath = $gameAccountTypePath;
    }

    /**
     * @return GameAccount
     */
    public function getGameAccountType()
    {
        return $this->gameAccountType;
    }

    /**
     * @param GameAccount $gameAccountType
     */
    public function setGameAccountType($gameAccountType)
    {
        $this->gameAccountType = $gameAccountType;
    }

    /**
     * @return string
     */
    public function getUserIdentifier()
    {
        return $this->userIdentifier;
    }

    /**
     * @param string $userIdentifier
     */
    public function setUserIdentifier($userIdentifier)
    {
        $this->userIdentifier = $userIdentifier;
    }
}