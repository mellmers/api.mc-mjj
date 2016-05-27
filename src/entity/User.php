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
     * @var int
     * @SWG\Property(type="integer", format="int32")
     */
    private $coins;

    public static function createFromArray(array $row)
    {
        $user = new self();
        if (array_key_exists('id', $row)) {
            $user->setId($row['id']);
        }
        $user->setUsername($row['username']);
        if (array_key_exists('email', $row)) {
            $user->setEmail($row['email']);
        }
        if (array_key_exists('trusted', $row)) {
            $user->setTrusted($row['trusted']);
        }
        if (array_key_exists('coins', $row)) {
            $user->setCoins($row['coins']);
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

    public function setId($id)
    {
        $this->id = $id;
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
}