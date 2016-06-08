<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 08/06/2016
 * Time: 14:27
 */

namespace projectx\api\entity;


class ImageType implements \JsonSerializable
{
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $name;

    public static function createFromArray(array $row)
    {
        $gameAccountType = new self();
        if (array_key_exists('name', $row)) {
            $gameAccountType->setName($row['name']);
        }
        return $gameAccountType;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
        ];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}