<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/user/form', name: 'app_user_form')]
    public function index(): Response
    {
        $user = new User();
    $form = $this->createForm(UserType::class, $user);
    return $this->render('user/userform.html.twig', [
        'userForm' => $form->createView()
    ]);
    }
}


