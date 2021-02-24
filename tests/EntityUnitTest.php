<?php

    class EntityUnitTest extends \PHPUnit\Framework\TestCase {

        public function testGetName()
        {
            $entity = new \Emagia\Entities\Entity();
            $entity->setName('Orderus');
            $this->assertEquals($entity->getName(),'Orderus');
        }

        public function testEqualityStats()
        {
            $entity = new \Emagia\Entities\Entity();

            $stats = [
                'HP'    => 0,
                'STR'   => 0,
                'DEF'   => 0,
                'SPD' => 0,
                'LCK'  => 0
            ];

            $objectStats = $entity->getAllStats();

            $this->assertEquals($stats,$objectStats, "Expected default behaviour");
        }

        public function testRandomName()
        {

            $entity = new \Emagia\Entities\Entity();
            $entity->setRandomName();
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

            $this->assertContains($entity->getName(),$names);

        }


    }
