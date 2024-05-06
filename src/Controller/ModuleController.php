<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleType;
use App\Repository\ModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ModuleController extends AbstractController
{
    #[Route('/module/new', name:'module_new' ,methods: ["GET","POST"])]
    public function new(Request $request, EntityManagerInterface
    $entityManager) 
    {
        $module = new Module();
        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $module = $form->getData();

            $entityManager->persist($module);
            $entityManager->flush();

            return $this->redirectToRoute('module_index');
        }

        return $this->render('module/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/module', name: 'module_index')]
    public function index( ModuleRepository $repo): Response
    {
        $modules = $repo->findAll();

        return $this->render('module/index.html.twig', [
            'modules' => $modules,
        ]);
    }


}
