<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 08/06/2016
 * Time: 14:26
 */

namespace projectx\api\entity;


class Game implements \JsonSerializable
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
    private $name;

    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $typ;

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

    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $rules;


    public static function createFromArray(array $row)
    {
        $gameAccountType = new self();
        if (array_key_exists('id', $row)) {
            $gameAccountType->setId($row['id']);
        }
        if (array_key_exists('name', $row)) {
            $gameAccountType->setName($row['name']);
        }
        if (array_key_exists('typ', $row)) {
            $gameAccountType->setTyp($row['typ']);
        }
        if (array_key_exists('imageData', $row)) {
            $gameAccountType->setIconData($row['imageData']);
        }
        if (array_key_exists('imageType', $row)) {
            $gameAccountType->setIconType($row['imageType']);
        }
        if (array_key_exists('rules', $row)) {
            $gameAccountType->setRules($row['rules']);
        }

        return $gameAccountType;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'typ' => $this->typ,
            'imageData' => $this->iconData,
            'imageType' => $this->iconType,
            'rules' => $this->rules,
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
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * @param string $typ
     */
    public function setTyp($typ)
    {
        $this->typ = $typ;
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

    /**
     * @return string
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param string $rules
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
    }

}