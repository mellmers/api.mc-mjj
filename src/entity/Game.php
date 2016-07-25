<?php

namespace projectx\api\entity;


class Game implements \JsonSerializable
{
    /**
     * @var string
     * @SWG\Property(type="string")
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
    private $icon;
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $rules;
    /**
     * @var string
     * @SWG\Property(type="string")
     */
    private $genre;
    /**
     * @var int
     * @SWG\Property(type="int", format="int32")
     */
    private $timelimit;

    public static function createFromArray(array $row)
    {
        $game = new self();
        if (array_key_exists('id', $row)) {
            $game->setId($row['id']);
        }
        if (array_key_exists('name', $row)) {
            $game->setName($row['name']);
        }
        if (array_key_exists('typ', $row)) {
            $game->setTyp($row['typ']);
        }
        if (array_key_exists('icon', $row)) {
            $game->setIcon($row['icon']);
        }
        if (array_key_exists('rules', $row)) {
            $game->setRules($row['rules']);
        }
        if (array_key_exists('genre', $row)) {
            $game->setGenre($row['genre']);
        }
        if (array_key_exists('timelimit', $row)) {
            $game->setTimelimit($row['timelimit']);
        }

        return $game;
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
            'icon' => $this->icon,
            'rules' => $this->rules,
            'timelimit' => $this->timelimit,
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
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param string $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return int
     */
    public function getTimelimit()
    {
        return $this->timelimit;
    }

    /**
     * @param int $timelimit
     */
    public function setTimelimit($timelimit)
    {
        $this->timelimit = (int)$timelimit;
    }
}