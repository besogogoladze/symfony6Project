<?php
namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile', methods: ['GET'])]
    public function index(ManagerRegistry $doctrine): JsonResponse
    {
        $repo = $doctrine->getRepository(User::class);
        $users = $repo->findAll();

        return $this->json($users, 200, [
            'Access-Control-Allow-Origin' => 'http://localhost:3000',
            'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS',
            'Access-Control-Allow-Headers' => 'Content-Type, Authorization'
        ]);
    }

    #[Route('/post_profile', name: 'create_user', methods: ['POST'])]
    public function createUser(Request $request, ManagerRegistry $doctrine): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate data (you can add more validation as needed)
        if (!isset($data['name'], $data['surname'], $data['age'], $data['email'])) {
            return $this->json(['error' => 'Missing parameters'], 400);
        }

        $user = new User();
        $user->setName($data['name']);
        $user->setSurname($data['surname']);
        $user->setAge($data['age']);
        $user->setEmail($data['email']);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json($user, 201, [
            'Access-Control-Allow-Origin' => 'http://localhost:3000',
            'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS',
            'Access-Control-Allow-Headers' => 'Content-Type, Authorization'
        ]);
    }
}
