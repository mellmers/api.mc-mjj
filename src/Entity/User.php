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
}