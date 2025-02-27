<?php

declare(strict_types=1);

namespace App\Adapters\Primary\Controller;

use App\Adapters\Primary\Controller\Model\PostDayPlanningDto;
use App\Adapters\Secondary\Fixtures\AppFixture;
use App\Adapters\Secondary\Repositories\ChildRepositoryInterface;
use App\BusinessLogic\UseCases\DayPlanning\CreateDayPlanningUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class DayPlanningController extends AbstractController
{
    #[Route('/day-planning', methods: ['POST'])]
    public function create(CreateDayPlanningUseCase $createDayPlanningUseCase, #[MapRequestPayload] PostDayPlanningDto $postDayPlanning, ChildRepositoryInterface $childRepository): JsonResponse
    {
        try {
            $child = $this->getUser()->getChildren()->first();
            $dailyPlanning = $createDayPlanningUseCase->execute($child, new \DateTime($postDayPlanning->date.' '.$postDayPlanning->startTime), new \DateTime($postDayPlanning->date.' '.$postDayPlanning->endTime));
        } catch (\Exception $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($dailyPlanning, Response::HTTP_CREATED);
    }
}
