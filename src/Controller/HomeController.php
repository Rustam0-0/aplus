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

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ClientRepository $client, Request $request, EntityManagerInterface $em): Response
    {
        $cli = new Client();
        $form = $this->createForm(ClientType::class, $cli);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $cli->setDateAdd(new \DateTime());

            $em->persist($cli);
            $em->flush();

            // ... perform some action, such as saving the task to the database
            $this->addFlash('success', 'Merci de nous avoir contacté!');
            return $this->redirectToRoute('home');
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $form->createView()
        ]);
    }
}
