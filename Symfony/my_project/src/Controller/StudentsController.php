<?php

namespace App\Controller;

use App\Entity\Students;
use App\Repository\StudentsRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class StudentsController extends AbstractController
{
    #[Route('/students', name: 'app_students', methods: ['GET'])]
    public function index(StudentsRepository $studentsRepository): Response
    {
        $students = $studentsRepository->findAll();

        return $this->render('students/index.html.twig', [
            "students" => $students
        ]);
    }

    /*   #[Route('/students/{firstname}/{lastname}/{groupnum}')]
       public function addStudent(string $firstname, string $lastname, int $groupnum, EntityManagerInterface $entityManager) {
           $student = new Students();
           $student->setFirstname($firstname);
           $student->setLastname($lastname);
           $student->setGroupnum($groupnum);
           $entityManager->persist($student);
           $entityManager->flush();
           return $this->redirectToRoute('app_students');
       }*/
    #[Route('/students/add', name: 'add_student')]
    public function addStudent(Request $request, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
//        $firstname = $request->request->get("firstname");
//        $lastname = $request->request->get("lastname");
//        $groupnum = $request->request->get("groupnum");
//        $student = new Students($firstname, $lastname, (int)$groupnum);

        $defaults = ["groupnum" => "1111-11"];

        $form = $this->createFormBuilder($defaults)
            ->add("firstname", TextType::class, [
                'constraints' => [
                    new NotBlank(message: "Имя не должно быть пустым"),
                    new Length(max: "100", maxMessage: "Имя не должно превышать 100 символов"),
                    new Regex(pattern: '/^\D*$/', message: "В имени не должно быть цифр")
                ]
            ])
            ->add("lastname", TextType::class, ['constraints' => [
                new NotBlank(message: "Фамилия не должна быть пустой"),
                new Length(max: "150", maxMessage: "Фамилия не должна превышать 150 символов"),
                new Regex(pattern: '/^\D*$/', message: "В фамилии не должно быть цифр")
            ]])
            ->add("groupnum", TextType::class)
            ->add("send", SubmitType::class, ["label" => "Отправить"])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            //  $student = new Students($firstname, $lastname, (int)$groupnum);
            return $this->redirectToRoute('app_students');
        }


//      s
//
//        $entityManager->persist($student);
//        $entityManager->flush();
        return $this->render("students/addstudent.html.twig", ["form" => $form->createView()]);
    }


}
