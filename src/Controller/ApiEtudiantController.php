<?php

namespace App\Controller;

use App\Entity\Etudiant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiEtudiantController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/etudiants', methods: ['GET'])]
    public function getAllStudents(SerializerInterface $serializer): JsonResponse
    {
        try {
            $students = $this->entityManager->getRepository(Etudiant::class)->findAll();
            $data = $serializer->serialize($students, 'json', ['groups' => ['etudiant.read']]);

            return new JsonResponse([
                'status' => 'success',
                'data' => json_decode($data),
                'error' => null,
            ], 200);
        } catch (\Exception $e) {
            return $this->errorResponse("DATABASE_ERROR", "An error occurred while retrieving students.", $e->getMessage());
        }
    }

    #[Route('/api/etudiants/{id}', methods: ['GET'])]
    public function getStudent($id, SerializerInterface $serializer): JsonResponse
    {
        try {
            $etudiant = $this->entityManager->getRepository(Etudiant::class)->find($id);

            if (!$etudiant) {
                return $this->errorResponse("STUDENT_NOT_FOUND", "No student found with ID $id.", "Ensure the ID is correct and try again.");
            }

            $data = $serializer->serialize($etudiant, 'json', ['groups' => ['etudiant.read']]);
            return new JsonResponse([
                'status' => 'success',
                'data' => json_decode($data),
                'error' => null,
            ], 200);
        } catch (\Exception $e) {
            return $this->errorResponse("DATABASE_ERROR", "An error occurred while retrieving the student.", $e->getMessage());
        }
    }
    #[Route("/api/tasks/{id}", methods: "GET")]
    public function findById(Etudiant $etudiant): JsonResponse
    {
        return $this->json($etudiant, 200, [], [
            'groups' => ['etudiant.read']
        ]);
    }
    #[Route('/api/etudiants', methods: ['POST'])]
    public function addStudent(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            if (!isset($data['nom'])) {
                return $this->errorResponse("INVALID_INPUT", "Name and email are required.", "Ensure both 'name' and 'email' fields are present in the request body.");
            }

            $student = new Etudiant();
            $student->setNom($data['nom']);
            

            $this->entityManager->persist($student);
            $this->entityManager->flush();

            return new JsonResponse([
                'status' => 'success',
                'data' => [
                    'id' => $student->getIdetudiant(),
                    'name' => $student->getNom(),
                ],
                'error' => null,
            ], 201);
        } catch (\Exception $e) {
            return $this->errorResponse("DATABASE_ERROR", "An error occurred while adding the student.", $e->getMessage());
        }
    }

    private function errorResponse(string $code, string $message, string $details): JsonResponse
    {
        return new JsonResponse([
            'status' => 'error',
            'data' => null,
            'error' => [
                'code' => $code,
                'message' => $message,
                'details' => $details,
            ],
        ], 500);
    }
}
