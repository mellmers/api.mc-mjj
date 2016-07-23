<?php

namespace projectx\api\entity;

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
    private $id;
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $email;
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $username;
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
     * @var int
     * @SWG\Property(type="integer", format="int32")
     */
    private $coins;
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $icon;

    public static function createFromArray(array $row)
    {
        $user = new self();
        if (array_key_exists('username', $row)) {
            $user->setUsername($row['username']);
        }
        if (array_key_exists('email', $row)) {
            $user->setEmail($row['email']);
        }
        if (array_key_exists('trusted', $row)) {
            $user->setTrusted($row['trusted']);
        }
        if (array_key_exists('password', $row)) {
            $user->setPassword($row['password']);
        }
        if (array_key_exists('icon', $row)) {
            $user->setIcon($row['icon']);
        }
        return $user;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'trusted' => $this->trusted,
            'password' => $this->password,
            'icon' => $this->icon,
            'coins' => $this->coins,
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
     * @return boolean
     */
    public function isTrusted()
    {
        return $this->trusted;
    }

    /**
     * @param boolean $trusted
     */
    public function setTrusted($trusted)
    {
        $this->trusted = $trusted;
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
        $this->coins = $coins;
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
}