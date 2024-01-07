<?php

namespace App\Controller;

use App\Entity\ActivityTypes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ActivityTypeController extends AbstractController
{
    #[Route('/activity-types', name: 'get_activity_type', format: 'json', methods: ['GET'])]
    public function getActivityTypes(EntityManagerInterface $entityManager): JsonResponse
    {
        $repository = $entityManager->getRepository(ActivityTypes::class);

        $activityTypes = $repository->findAll();

        $response = [];
        foreach ($activityTypes as $activityType) {
            $response[] = [
                'id' => $activityType->getId(),
                'name' => $activityType->getName(),
                'number_monitors' => $activityType->getNumberMonitors(),
            ];
        }

        return $this->json($response);
    }

    // #[Route('/activity-types', name: 'app_activity_type', format: 'json', methods: ['POST'])]
    // public function create(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $data = json_decode($request->getContent(), true);

    //     $activityTypes = new ActivityTypes();
    //     $activityTypes->setName($data['name'] ?? 'Pilates');
    //     $activityTypes->setNumberMonitors($data['number_monitors'] ?? 1);

    //     $entityManager->persist($activityTypes);
    //     $entityManager->flush();

    //     $response = [
    //         'data' => [
    //             'id' => $activityTypes->getId(),
    //             'name' => $activityTypes->getName(),
    //             'number_monitors' => $activityTypes->getNumberMonitors(),
    //         ],
    //     ];

    //     return $this->json($response, Response::HTTP_CREATED);
    // }
}
