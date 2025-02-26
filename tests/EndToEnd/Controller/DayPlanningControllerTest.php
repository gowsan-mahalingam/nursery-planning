<?php

declare(strict_types=1);

namespace App\Tests\EndToEnd\Controller;

use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DayPlanningControllerTest extends WebTestCase
{
    #[Test]
    public function createDayPlanning(): void
    {
        $client = static::createClient();
        $container = static::getContainer();
        $entityManager = $container->get('doctrine')->getManager();
        $entityManager->getConnection()->executeStatement('DELETE FROM daily_planning');
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
