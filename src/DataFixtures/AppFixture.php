<?php

namespace App\DataFixtures;

use App\BusinessLogic\Models\Child;
use App\Factory\DailyPlanningFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixture extends Fixture
{
    const CHILD_NAME = 'John Doe';
    public function load(ObjectManager $manager): void
    {
        $child = new Child(self::CHILD_NAME);
        $manager->persist($child);
        DailyPlanningFactory::createMany(10, function() use ($child) {
            return [
                'child' => $child
            ];
        });
        $manager->flush();
    }
}
