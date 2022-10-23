<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\CreatePostFlow;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard", methods={"GET"})
     */
    public function index(PostRepository $postRepository): Response
    {
        $user = $this->getUser();
        $posts = $postRepository->findAllUserPosts($user->getId());
        $lastPosts = $postRepository->findLastUserPosts($user->getId());

        return $this->render('dashboard/dashboard.html.twig', [
            'posts' => $posts,
            'lastPosts' => $lastPosts
        ]);
    }

    /**
     * @Route("/new", name="post_new", methods={"GET","POST"})
     */
    public function new(Request $request, CreatePostFlow $flow): Response
    {
        $post = new Post();

        $flow->bind($post);
        $form = $flow->createForm();

        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                $form = $flow->createForm();
            } else {
                $user = $this->getUser();

                if ($user) {
                    $post->setAuthor($user);
                }

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($post);
                $entityManager->flush();

                $flow->reset();

                return $this->redirectToRoute('dashboard');
            }
        }

        // $form = $this->createForm(PostType::class, $post);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {

        //     $user = $this->getUser();
        //     $post->setAuthor($user);
        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->persist($post);
        //     $entityManager->flush();

        //     return $this->redirectToRoute('post_index');
        // }

        return $this->render('post/new.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
            'flow' => $flow
        ]);
    }

    /**
     * @Route("/{id}", name="post_show", methods={"GET"})
     */
    public function show(Post $post): Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="post_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Post $post): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_index');
        }

        return $this->render('post/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="post_delete", methods={"POST"})
     */
    public function delete(Request $request, Post $post): Response
    {
        if ($this->isCsrfTokenValid('delete' . $post->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('post_index');
    }
}
