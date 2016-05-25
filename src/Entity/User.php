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
    private $username;

    public static function createFromArray(array $row)
    {
        $user = new self();
        if (array_key_exists('id', $row)) {
            $user->setId($row['id']);
        }
        $user->setUsername($row['username']);

        return $user;
    }
    
    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id'     => $this->id,
            'username' => $this->username,
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
}