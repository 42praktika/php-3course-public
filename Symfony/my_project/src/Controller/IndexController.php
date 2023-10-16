<?php
// src/Controller/IndexController.php
namespace App\Controller;

use App\Service\GreetingGenerator;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Flex\Configurator\ContainerConfigurator;

class User
{
    public string $name;
    public string $surname;

    /**
     * @param string $name
     * @param string $surname
     */
    public function __construct(string $name, string $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

}

class IndexController extends AbstractController
{
    /**
     * @return Response
     * @Route("/index/{name}", name="index", methods={"GET"})
     */
    public function index(string $name = "world", LoggerInterface $logger, GreetingGenerator $greetingGenerator, string $adminEmail)
    {
        $users = [new User("Alexey", "Shushpanov"), new User("Vasya", "Pupkin")];
        $logger->critical("Лог точно пишется и мы сюда 100% зашли (критикаловое)");


        return $this->render("index.html.twig", ["name" => $name,"users" => $users, "html"=>"<b>жирненько</b>", "greeting"=>$greetingGenerator->getGreeting(), "admin"=>$adminEmail]);
        //return new Response(  	"<html><body>Hello $name</body></html>" 	);
    }
}