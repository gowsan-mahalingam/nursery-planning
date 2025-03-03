<?php

declare(strict_types=1);

namespace App\Adapters\Primary\Controller;

use App\Adapters\Primary\Controller\Model\PostScheduleDto;
use App\Adapters\Secondary\Repositories\ChildRepositoryInterface;
use App\BusinessLogic\Models\Parents;
use App\BusinessLogic\UseCases\Schedule\CreateScheduleUseCase;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class ScheduleController extends AbstractController
{
    #[Route('/schedule', methods: ['POST'])]
    public function create(CreateScheduleUseCase $createScheduleUseCase, #[MapRequestPayload] PostScheduleDto $postScheduleDto, ChildRepositoryInterface $childRepository): JsonResponse
    {
        try {
            /** @var Parents $parents */
            $parents = $this->getUser();
            $child = $parents->getChildren()->first();
            $schedule = $createScheduleUseCase->execute($child, new DateTime($postScheduleDto->date.' '.$postScheduleDto->startTime), new DateTime($postScheduleDto->date.' '.$postScheduleDto->endTime));
        } catch (Exception $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($schedule, Response::HTTP_CREATED);
    }
}
