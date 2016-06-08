<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 08/06/2016
 * Time: 14:27
 */

namespace projectx\api\entity;


class GameAccountType implements \JsonSerializable
{
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $name;

    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $iconData;
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $iconType;

    public static function createFromArray(array $row)
    {
        $gameAccountType = new self();
        if (array_key_exists('name', $row)) {
            $gameAccountType->setName($row['name']);
        }
        if (array_key_exists('imageData', $row)) {
            $gameAccountType->setIconData($row['imageData']);
        }
        if (array_key_exists('imageType', $row)) {
            $gameAccountType->setIconType($row['imageType']);
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
            'imageData' => $this->iconData,
            'imageType' => $this->iconType,
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

    /**
     * @return string
     */
    public function getIconData()
    {
        return $this->iconData;
    }

    /**
     * @param string $iconData
     */
    public function setIconData($iconData)
    {
        $this->iconData = $iconData;
    }

    /**
     * @return string
     */
    public function getIconType()
    {
        return $this->iconType;
    }

    /**
     * @param string $iconType
     */
    public function setIconType($iconType)
    {
        $this->iconType = $iconType;
    }
}