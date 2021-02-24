<?php

namespace Emagia\Entities;

class Entity
{
    public $name;

    public $stats = [
        'HP' => 0,
        'STR' => 0,
        'DEF' => 0,
        'SPD' => 0,
        'LCK' => 0
    ];

    public function setRandomName()
    {
        $names = [
            'Malachai',
            'Arakaali',
            'Kitava',
            'Avarius',
            'Glace',
            'Hillock',
            'Maven',
            'Sirus',
        ];
        $this->setName($names[rand(0, count($names) - 1)]);
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStat($key)
    {
        return $this->stats[$key];
    }

    public function setStat($key, $value)
    {
        $this->stats[$key] = $value;
    }

    public function getAllStats()
    {
        return $this->stats;
    }

    public function hasSpecialSkills()
    {
        return (isset($this->specialSkills)) ? true : false;
    }

    public function isLucky()
    {
        $randomLuck = rand(0, 100);
        return  ($this->stats['LCK'] > $randomLuck) ? true :false;
    }

}