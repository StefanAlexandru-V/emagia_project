<?php

    namespace Emagia;

    use Emagia\Entities\Hero;
    use Emagia\Entities\Mob;
    use Emagia\Helpers\Console;
    use Emagia\Game\BattleSimulator;

    class Orderus {

        public function spawnMob()
        {
            return new Mob();
        }

        public function spawnHero()
        {
            $hero = new Hero();
            $console = new Console();
            $hero->setName('Orderus');
            echo $console->welcome('Hello. I am ' . $hero->name . ' and I`m a hero in Emagia.') . PHP_EOL;

            return $hero;
        }

        public function battle()
        {
            $hero = $this->spawnHero();
            $mob = $this->spawnMob();

            $battle = new BattleSimulator($hero, $mob);
            $battle->start();
        }


    }