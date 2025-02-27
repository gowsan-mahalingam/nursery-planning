<?php

declare(strict_types=1);

namespace App\Tests\EndToEnd\Controller;

use App\Tests\Factory\ChildFactory;
use App\Tests\Factory\ParentsFactory;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class DayPlanningControllerTest extends WebTestCase
{
    use ResetDatabase, Factories;
    #[Test]
    public function should_not_allowed_without_authentication(): void
    {
        $client = static::createClient();
        $client->request('POST', '/day-planning', [
            'date' => '2024-01-01',
            'startTime' => '09:00',
            'endTime' => '17:00'
        ],[], [
            'HTTP_CONTENT_TYPE' => 'application/json',
            'HTTP_ACCEPT' => 'application/json'
        ]);
        $this->assertResponseStatusCodeSame(401);
    }

    #[Test]
    public function create_day_planning(): void
    {
        $client = static::createClient();
        $parent = ParentsFactory::createOne()->_real();

        ChildFactory::createOne([
            'parents' => $parent
        ]);

        $client->loginUser($parent);

        $client->request('POST', '/day-planning', [
            'date' => '2024-01-01',
            'startTime' => '09:00',
            'endTime' => '17:00'
        ],[], [
            'HTTP_CONTENT_TYPE' => 'application/json',
            'HTTP_ACCEPT' => 'application/json'
        ]);
        $this->assertResponseStatusCodeSame(201);
    }
}
