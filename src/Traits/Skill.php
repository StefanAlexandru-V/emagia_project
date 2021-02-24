<?php

    namespace Emagia\Traits;

    trait Skill {

        public $skills = [
            'general' => [
                [
                    'key'         => 'attack',
                    'name'        => 'Attack',
                    'description' => 'Normal attack.'
                ],
                'defense' => [
                    'key'         => 'defend',
                    'name'        => 'Defend',
                    'description' => 'Defend the hit.'
                ],
            ]
        ];

    }