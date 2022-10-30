<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class SingupController extends AbstractController
{
    /**
     * @Route("/singup", name="app_singup")
     */
    public function index(ClientRepository $client, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ClientType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $cli = new Client();
            $cli->setName($task["name"]);
            $cli->setSurname($task["surname"]);
            $cli->setTel($task["tel"]);
            $cli->setAddress($task["address"]);
            $cli->setMessage($task["message"]);
            $cli->setDateAdd(new \DateTime());

            $em->persist($cli);
            $em->flush();

            // ... perform some action, such as saving the task to the database
            // $this->addFlash('success', 'Vous êtes bien inscrit. Veuillez vous êntrer avec vos Email et mot de passe!');
            return $this->redirectToRoute('home');
        }

        return $this->render('singup/index.html.twig', [
            'form' => $form->createView()
        ]);

        //     return $this->render('singup/index.html.twig', [
        //         'controller_name' => 'SingupController',
        //     ]);
    }
}