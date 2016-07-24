<?php

namespace projectx\api\entity;

use DateTime;
use Swagger\Annotations as SWG;

/**
 * Class User
 * @package projectx\api\entity
 */
class User implements \JsonSerializable
{
    /**
     * @var int
     * @SWG\Property(type="integer", format="int32")
     */
    private $coins;
    /**
     * @var int
     * @SWG\Property(type="int", format="int32")
     */
    private $createdAt;
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $email;
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $id;
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $icon;
    /**
     * @var bool
     * @SWG\Property(type="bool")
     */
    private $trusted;
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $password;
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $username;

    /**
     * @param array $row
     * @return User
     */
    public static function createFromArray(array $row)
    {
        $user = new self();
        if (array_key_exists('coins', $row)) {
            $user->setCoins($row['coins']);
        }
        if (array_key_exists('createdAt', $row)) {
            $user->setCreatedAt($row['createdAt']);
        } else {
            $date = new DateTime();
            $user->setCreatedAt($date->getTimestamp());
        }
        if (array_key_exists('email', $row)) {
            $user->setEmail($row['email']);
        }
        if (array_key_exists('icon', $row)) {
            $user->setIcon($row['icon']);
        }
        if (array_key_exists('id', $row)) {
            $user->setId($row['id']);
        }
        if (array_key_exists('password', $row)) {
            $user->setPassword($row['password']);
        }
        if (array_key_exists('trusted', $row)) {
            $user->setTrusted($row['trusted']);
        }
        if (array_key_exists('username', $row)) {
            $user->setUsername($row['username']);
        }
        return $user;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'coins' => $this->coins,
            'createdAt' => $this->createdAt,
            'icon' => $this->icon,
            'id' => $this->id,
            'email' => $this->email,
            'password' => $this->password,
            'trusted' => $this->trusted,
            'username' => $this->username,
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return bool
     */
    public function isTrusted()
    {
        return $this->trusted;
    }

    /**
     * @param bool $trusted
     */
    public function setTrusted($trusted)
    {
        $this->trusted = (bool)$trusted;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getCoins()
    {
        return $this->coins;
    }

    /**
     * @param int $coins
     */
    public function setCoins($coins)
    {
        $this->coins = (int)$coins;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
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
}