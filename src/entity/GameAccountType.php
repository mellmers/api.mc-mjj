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
    private $icon;


    public static function createFromArray(array $row)
    {
        $gameAccountType = new self();
        if (array_key_exists('name', $row)) {
            $gameAccountType->setName($row['name']);
        }
        if (array_key_exists('icon', $row)) {
            $gameAccountType->setIconData($row['icon']);
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
            'icon' => $this->icon,
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
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->iconData = $icon;
    }
}