<?php

namespace App\Tests\Factory;

use App\BusinessLogic\Models\DailyPlanning;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

final class DailyPlanningFactory extends PersistentProxyObjectFactory
{

    public static function class(): string
    {
        return DailyPlanning::class;
    }

    protected function defaults(): array|callable
    {
        $faker = self::faker();

        $randomDate = $faker->dateTimeThisMonth();

        $morningHour = $faker->numberBetween(8, 12);
        $morningTime = new \DateTime($randomDate->format('Y-m-d') . " {$morningHour}:00:00");

        $afternoonHour = $faker->numberBetween(14, 18);
        $afternoonTime = new \DateTime($randomDate->format('Y-m-d') . " {$afternoonHour}:00:00");

        return [
            'child' => ChildFactory::new(),
            'startTime' => $morningTime,
            'endTime' => $afternoonTime,
        ];
    }


}
