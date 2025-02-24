<?php

namespace App\Controller;

use App\Entity\User2;
use App\Form\User2Type;
use App\Repository\User2Repository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('/user2')]
class User2Controller extends AbstractController
{
    #[Route('/', name: 'app_user2_index', methods: ['GET'])]
    public function index(User2Repository $user2Repository): Response
    {
        return $this->render('user2/index.html.twig', [
            'user2s' => $user2Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user2_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user2 = new User2();
        $form = $this->createForm(User2Type::class, $user2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user2);
            $entityManager->flush();

            return $this->redirectToRoute('app_user2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user2/new.html.twig', [
            'user2' => $user2,
            'form' => $form,
        ]);
    }

    // #[Route('/{id}', name: 'app_user2_show', methods: ['GET'])]
    // public function show(User2 $user2): Response
    // {
    //     return $this->render('user2/show.html.twig', [
    //         'user2' => $user2,
    //     ]);
    // }
    #[Route('/user2/{id}', name: 'app_user2_show', methods: ['GET'])]
    public function show(User2 $user2): Response
    {
        // Symfony should resolve $user2 based on the "id" route parameter.
        return $this->render('user2/show.html.twig', [
            'user2' => $user2,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user2_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User2 $user2, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(User2Type::class, $user2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user2_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user2/edit.html.twig', [
            'user2' => $user2,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user2_delete', methods: ['POST'])]
    public function delete(Request $request, User2 $user2, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user2->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user2);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user2_index', [], Response::HTTP_SEE_OTHER);
    }
    

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('/home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    

}
