<?php

namespace App\Controller;

use App\Entity\Students;
use App\Repository\StudentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentsController extends AbstractController
{
    #[Route('/students', name: 'app_students', methods: ['GET'])]
    public function index(StudentsRepository $studentsRepository): Response
    {
        $students=$studentsRepository->findAll();

        return $this->render('students/index.html.twig', [
            "students"=>$students
        ]);
    }

    #[Route('/students/{firstname}/{lastname}/{groupnum}')]
    public function addStudent(string $firstname, string $lastname, int $groupnum, EntityManagerInterface $entityManager) {
        $student = new Students();
        $student->setFirstname($firstname);
        $student->setLastname($lastname);
        $student->setGroupnum($groupnum);
        $entityManager->persist($student);
        $entityManager->flush();
        return $this->redirectToRoute('app_students');
    }
}
