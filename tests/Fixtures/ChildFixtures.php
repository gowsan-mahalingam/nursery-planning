<?php

namespace App\Tests\Fixtures;

use App\BusinessLogic\Models\Parents;
use App\Tests\Factory\ChildFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ChildFixtures extends Fixture implements DependentFixtureInterface
{
    public const CHILD_REFERENCE = 'child-1';

    public function load(ObjectManager $manager): void
    {
        $parent = $this->getReference(ParentsFixtures::PARENT_REFERENCE, Parents::class);

        $child = ChildFactory::new()->create([
            'name' => 'John Doe',
            'parents' => $parent
        ])->_real();

        $this->addReference(self::CHILD_REFERENCE, $child);
    }

    public function getDependencies(): array
    {
        return [
            ParentsFixtures::class,
        ];
    }
}
