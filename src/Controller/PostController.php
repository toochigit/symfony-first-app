<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/post/form', name: 'app_post_show')]
    public function post(Post $post): Response{
        $post = new Post();
        $post->setCreatedAt(new \DateTimeImmutable());
        $post-> setAuthor($this->getUser());

        $form = $this->createForm(PostType::class, $post);

        return $this->render('post/form.html.twig', [
            'postForm' => $form->createView(),
        ]);
    }
}
