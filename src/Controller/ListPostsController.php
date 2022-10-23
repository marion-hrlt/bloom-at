<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListPostsController extends AbstractController
{
    /**
     * @Route("/home", name="homepage")
     */
    public function index(): Response
    {

        $posts = $this->getDoctrine()->getRepository(Post::class)->findBy([], ['createdAt' => 'DESC']);

        return $this->render('home/home.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/interests", name="interests")
     */
    public function interests(): Response
    {

        $user = $this->getUser()->getId();
        $posts = $this->getDoctrine()->getRepository(Post::class)->findByUserInterests($user);


        return $this->render('home/interests.html.twig', [
            'posts' => $posts
        ]);
    }
}
