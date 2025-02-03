<?php

namespace App\Controller;

use App\Service\CalcService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/home')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response{
        return $this->render('home/index.html.twig');
    }

    /*
    #[Route('/hello', name: 'hello')]
    public function hello(Request $request): Response{
        $name = $request->query->get('name', 'inconnu');
        return new Response("Bonjour $name");
    }
    */

    #[Route('/hello/{id}', name: 'hello_with_id', requirements: ['id' => '\d+'])]
    public function helloWithId(int $id): Response{
        return new Response("Bonjour vous avez l'id : $id");
    }


    #[Route('/hello/{name}', name: 'hello_with_name')]
    public function helloWithParam(string $name = 'inconnu'): Response{
        return $this->render('home/hello_with_param.html.twig', [
            'name' => $name,
            'now' => new DateTime(),
            'person' => [
                'name' => 'John Doe',
                'skills' => ['PHP', 'Javascript', 'HTML', 'CSS']
            ]
        ]);
    }

    #[Route('/addition/{n1}/{n2}', name: 'addition')]
    public function addition(int $n1, int $n2, CalcService $calc): Response{
        return $this->render('home/addition.html.twig', [
            'n1' => $n1,
            'n2' => $n2,
        ]);
    }



}