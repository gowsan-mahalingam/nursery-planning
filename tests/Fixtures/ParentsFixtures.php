<?php

namespace App\Tests\Fixtures;

use App\Tests\Factory\ParentsFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ParentsFixtures extends Fixture
{
    public const PARENT_REFERENCE = 'parent-1';

    public function load(ObjectManager $manager): void
    {
        $parent = ParentsFactory::new()->create([
            'email' => 'parent@test.com',
            'plainPassword' => 'password123',
            'password' => 'password123'
        ])->_real();

        $this->addReference(self::PARENT_REFERENCE, $parent);
    }
}
