<?php

namespace App\Controller;

use App\Entity\Monitors;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class MonitorController extends AbstractController
{
    #[Route('/monitors', name: 'get_monitors', format: 'json', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Monitors::class);

        $monitors = $repository->findAll();

        $response = [];
        foreach ($monitors as $monitor) {
            $response[] = [
                'id' => $monitor->getId(),
                'name' => $monitor->getName(),
                'photo' => $monitor->getPhoto(),
                'telephone' => $monitor->getTelephone(),
                'email' => $monitor->getEmail(),
            ];
        }

        return $this->json($response);
    }

    #[Route('/monitors', name: 'post_monitors', format: 'json', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        $monitors = new Monitors();
        $monitors->setName($data['name'] ?? 'Ana Gonzalez');
        $monitors->setPhoto($data['photo'] ?? 'Example Photo');
        $monitors->setTelephone($data['telephone'] ?? 632985711);
        $monitors->setEmail($data['email'] ?? 'anagonzalez@gmail.com');

        $entityManager->persist($monitors);
        $entityManager->flush();

        $response = [
            'data' => [
                'id' => $monitors->getId(),
                'name' => $monitors->getName(),
                'photo' => $monitors->getPhoto(),
                'telephone' => $monitors->getTelephone(),
                'email' => $monitors->getEmail(),
            ],
        ];

        return $this->json($response, Response::HTTP_CREATED);
    }
    #[Route('/monitors/{id}', name: 'put_monitor', format: 'json', methods: ['PUT'])]
    public function update(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        
        $monitor = $entityManager->getRepository(Monitors::class)->find($id);

        $data = json_decode($request->getContent(), true);

        if (isset($data['name'])) {
            $monitor->setName($data['name']);
        }

        if (isset($data['email'])) {
            $monitor->setEmail($data['email']);
        }

        if (isset($data['telephone'])) {
            $monitor->setTelephone($data['telephone']);
        }

        if (isset($data['photo'])) {
            $monitor->setPhoto($data['photo']);
        }

        $entityManager->flush();

        $response = [
            'data' => [
                'id' => $monitor->getId(),
                'name' => $monitor->getName(),
                'email' => $monitor->getEmail(),
                'telephone' => $monitor->getTelephone(),
                'photo' => $monitor->getPhoto(),
            ],
        ];

        return $this->json($response);
    }

    #[Route('/monitors/{id}', name: 'delete_monitor', format: 'json', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $entityManager, $id): Response
    {
        $monitor = $entityManager->getRepository(Monitors::class)->find($id);

        $entityManager->remove($monitor);
        $entityManager->flush();

        return $this->json(['message' => 'Monitor deleted']);
    }
}
