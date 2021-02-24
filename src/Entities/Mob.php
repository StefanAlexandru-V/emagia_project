<?php

    namespace Emagia\Entities;


    use Emagia\Traits\Skill;

    class Mob extends Entity {
        use Skill;

        function __construct()
        {
            parent::setRandomName();

            $this->stats = [
                'HP'    => rand(60, 90),
                'STR'   => rand(60, 90),
                'DEF'   => rand(40, 60),
                'SPD' => rand(40, 60),
                'LCK'  => rand(25, 40)
            ];

        }
    }