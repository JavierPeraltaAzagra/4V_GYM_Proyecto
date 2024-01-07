<?php

namespace App\Controller;

use App\Entity\Activities;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ActivityTypes;
use App\Entity\ActivityMonitors;

class ActivityController extends AbstractController
{
    #[Route('/activities', name: 'get_activities', format: 'json', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Activities::class);

        $activities = $repository->findAll();

        $response = [];
        foreach ($activities as $activity) {
            $response[] = [
                'id' => $activity->getId(),
                'activity_type' => $activity->getActivityType(),
                'activityMonitors' => $activity->getActivityMonitors(),
                'beggining_date' => $activity->getBegginingDate(),
                'end_date' => $activity->getEndDate(),
            ];
        }

        return $this->json($response);
    }

    #[Route('/activities', name: 'post_activities', format: 'json', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        $activities = new Activities();
        $activities->setActivityType($data['activity_type'] ?? 'pilates');
        $activities->setBegginingDate($data['beggining_date'] ?? 16/12/2021);
        $activities->setEndDate($data['end_date'] ?? 17/12/2021);
        $activities->setActivityMonitors($data['activityMonitors'] ?? 'evaristo123@gmail.com');

        $entityManager->persist($activities);
        $entityManager->flush();

        $response = [
            'data' => [
                'activity_type' => $activities->getActivityType(),
                'beggining_date' => $activities->getBegginingDate(),
                'end_date' => $activities->getEndDate(),
                'activityMonitors' => $activities->getActivityMonitors(),
            ],
        ];

        return $this->json($response, Response::HTTP_CREATED);
    }
    #[Route('/activities/{id}', name: 'put_activity', format: 'json', methods: ['PUT'])]
    public function update(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        
        $activity = $entityManager->getRepository(Activities::class)->find($id);

        $data = json_decode($request->getContent(), true);

        if (isset($data['activityMonitors'])) {
            $activity->setActivityMonitors($data['activityMonitors']);
        }

        if (isset($data['activity_type'])) {
            $activity->setActivityType($data['activity_type']);
        }

        if (isset($data['beggining_date'])) {
            $activity->setBegginingDate($data['beggining_date']);
        }

        if (isset($data['end_date'])) {
            $activity->setBegginingDate($data['end_date']);
        }

        $entityManager->flush();

        $response = [
            'data' => [
                'id' => $activity->getId(),
                'activityMonitors' => $activity->getActivityMonitors(),
                'activity_type' => $activity->getActivityType(),
                'beggining_date' => $activity->getBegginingDate(),
                'end_date' => $activity->getEndDate(),
            ],
        ];

        return $this->json($response);
    }

    #[Route('/activities/{id}', name: 'delete_activity', format: 'json', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $entityManager, $id): Response
    {
        $activity = $entityManager->getRepository(Activities::class)->find($id);

        $entityManager->remove($activity);
        $entityManager->flush();

        return $this->json(['message' => 'Activity deleted']);
    }
}
