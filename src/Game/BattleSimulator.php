<?php

    namespace Emagia\Game;

    use Emagia\Helpers\Console;

    class BattleSimulator {

        private $attacker;
        private $defender;
        private $winner;
        private $console;
        private $totalTurns = 20;
        private $damage = 0;

        function __construct($mob, $hero)
        {
            $this->console = new Console();
            $this->attacker = $hero;
            $this->defender = $mob;
            $this->setPositions();
        }

        private function setPositions()
        {
            $attacker = $this->attacker;
            $defender = $this->defender;

            if ($this->defender->getStat('SPD') > $this->attacker->getStat('SPD')) {
                $this->attacker = $defender;
                $this->defender = $attacker;
            }

            if ($this->defender->getStat('SPD') == $this->attacker->getStat('SPD'))
            {
                if ($this->defender->getStat('LCK') > $this->attacker->getStat('LCk')) {
                    $this->attacker = $defender;
                    $this->defender = $attacker;
                }
            }
        }

        public function start()
        {
            echo 'A battle has begun between ' . $this->attacker->name . ' and ' . $this->defender->name . '.' . PHP_EOL;
            echo $this->attacker->name . ' attacks ' . $this->defender->name . ' first!' . PHP_EOL;
            $this->simulate();
        }

        private function simulate()
        {
            $turns = 1;
            while ($this->defender->getStat('HP') >= 0 && $turns <= $this->totalTurns)
            {
                echo $this->console->header('# [Turn] ' . $turns . ' - ' . $this->attacker->name . ' attacks! #') . PHP_EOL;

                $attacker = $this->attacker;
                $defender = $this->defender;
                $defendAttack = $this->defender->isLucky();
                $this->damageAmount();

                if ($defendAttack)
                {
                    echo $this->console->alert($this->defender->name . ' defended the hit from ' . $this->attacker->name . '.') . PHP_EOL;
                }

                if (!$defendAttack)
                {
                    if ($this->defender->hasSpecialSkills()) {
                        $defendSkill = $this->defender->defenseLuck();
                        if ($defendSkill != false) {
                            echo $this->console->info('***' . $defendSkill['name'] . '***') . PHP_EOL;
                            switch ($defendSkill['key']) {
                                case "magic_shield":
                                    $this->damage = $this->damage / 2;
                                    break;
                                case "exhaust":
                                    echo $this->console->info('Sorry, you have failed to exhaust the enemy.') . PHP_EOL;
                                    break;
                            }
                        }
                    }

                    if ($this->attacker->hasSpecialSkills()) {
                        $attackSkill = $this->attacker->attackLuck();
                        if ($attackSkill != false) {
                            echo $this->console->info('***' . $attackSkill['name'] . '***') . PHP_EOL;
                            switch ($attackSkill['key']) {
                                case "rapid_strike":
                                    $this->logAttack();
                                    $this->meleeAttack();
                                    break;
                            }
                        }
                    }

                    $this->logAttack();
                    $this->meleeAttack();
                }

                $this->attacker = $defender;
                $this->defender = $attacker;
                $turns++;

                if ($this->checkHealth()) {
                    break;
                }
            }
            echo $this->console->deathMessage(($this->checkWinner()->name !== $this->attacker->name ? $this->attacker->name : $this->defender->name) . ' has perished!') . PHP_EOL;
            echo $this->console->info($this->checkWinner()->name . ' wins!') . PHP_EOL;
        }

        private function checkWinner()
        {
            $winner = ($this->defender->getStat('HP') > $this->attacker->getStat('HP')) ? $this->defender : $this->attacker;

            if ($this->attacker->getStat('HP') <= 0) {
                $winner = $this->defender;
            }

            if ($this->defender->getStat('HP') <= 0) {
                $winner = $this->attacker;
            }

            $this->winner = $winner;

            return $this->winner;
        }

        private function meleeAttack()
        {
            $newHp = $this->defender->getStat('HP') - $this->damage;
            $this->defender->setStat('HP',$newHp);
        }

        private function damageAmount()
        {
            $this->damage = $this->attacker->getStat('STR') - $this->defender->getStat('DEF');
        }

        private function logAttack()
        {
            echo $this->attacker->name . ' (' . $this->attacker->stats['HP'] . ' HP) damaged ' . $this->defender->name . '(' . $this->defender->stats['HP'] . ' HP) with ' . $this->damage . ' damage.' . PHP_EOL;
        }

        private function checkHealth()
        {
            if ($this->attacker->getStat('HP') <= 0 || $this->defender->getStat('HP') <= 0) return true;
        }


    }