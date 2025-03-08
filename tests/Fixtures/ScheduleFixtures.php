<?php

namespace App\Tests\Fixtures;

use App\BusinessLogic\Models\Child;
use App\Tests\Factory\ScheduleFactory;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ScheduleFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @throws \DateMalformedStringException
     */
    public function load(ObjectManager $manager): void
    {
        $child = $this->getReference(ChildFixtures::CHILD_REFERENCE, Child::class);

        $currentDate = new DateTime('2025-03-01');
        $lastDay = new DateTime('2025-03-31');

        while ($currentDate <= $lastDay) {
            if ($currentDate->format('N') <= 5) {
                ScheduleFactory::new()->create([
                    'child' => $child,
                    'startTime' => new DateTime($currentDate->format('Y-m-d 08:00')),
                    'endTime' => new DateTime($currentDate->format('Y-m-d 17:00'))
                ]);
            }

            $currentDate->modify('+1 day');
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ChildFixtures::class,
        ];
    }
}
