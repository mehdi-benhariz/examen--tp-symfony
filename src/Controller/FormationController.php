<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FormationController extends AbstractController
{
    #[Route('/formation/new', name:'formation_new' ,methods: ["GET","POST"])]
    public function new(Request $request, EntityManagerInterface
    $entityManager) 
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formation = $form->getData();

            $entityManager->persist($formation);
            $entityManager->flush();

            return $this->redirectToRoute('formation_index');
        }

        return $this->render('formation/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
        #[Route('/formation', name: 'formation_index')]
        public function index(FormationRepository $repo)
        {   
            $formations = $repo->findAll();
            return $this->render('formation/index.html.twig', [
                "formations"=>  $formations
            ]);
        }

        
    #[Route('/formation/choisir/{id}', name:'formation_choisir' ,methods: ["GET","POST"])]
    public function choisir(Request $request,$id ,FormationRepository $repo) 
    {
        $formation = $repo->find($id);
    
        return $this->render('formation/choisir.html.twig', [
            'formation' => $formation,
        ]);
    }

    

}
