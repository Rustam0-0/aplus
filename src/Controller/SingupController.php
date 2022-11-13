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
        $cli = new Client();
        $form = $this->createForm(ClientType::class, $cli);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $cli->setDateAdd(new \DateTime());
            if($form->isValid()){
            $em->persist($cli);
            $em->flush();

            // ... perform some action, such as saving the task to the database
            $this->addFlash('success', 'Merci de nous avoir contacté!');
            return $this->redirectToRoute('home');
            }else{
                $this->addFlash('danger', 'Veuillez correctement remplir tout les champs!');
                return $this->redirectToRoute('home');
            }
        }

        return $this->render('singup/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}