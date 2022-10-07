<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\VehiculeType;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DataController extends AbstractController
{

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('data/home.html.twig');
    }

    #[Route('/data/liste', name: 'data_liste')]
    public function liste(VehiculeRepository $repo) 
    {

        $vehicule =$repo->findAll();
        return $this->render('data/index.html.twig', ['vehicule' =>$vehicule  ]);
    } 
    #[Route('/data/new', name:"data_new")]
    #[Route('/data/edit{id}', name:"data_edit")]
     public function form(Request $globals, EntityManagerInterface $manager, Vehicule $vehicule =null)
        {  if($vehicule == null)
            
        {
          $vehicule = new Vehicule;
    
        }
         $form = $this->createForm(VehiculeType::class, $vehicule);
    
          $form->handleRequest($globals);
    
         
    
    
             if($form->isSubmitted() && $form->isValid()){
    
              $vehicule->setDateEnregistrement(new \DateTime);
              $manager->persist($vehicule);
              $manager->flush();
    
              return $this->redirectToRoute('data_liste',[
                'id' => $vehicule->getId()
              ]);
            
             }
    
            return $this->renderForm("data/form.html.twig",[
              'form' => $form,
              'editMode' => $vehicule->getId() !==null
            ]);
        }
        #[Route('/data/delete/{id}', name: 'data_delete')]
        
        public function delete( Vehicule $vehicule, EntityManagerInterface $manager  )
        {
          
    
          $manager->remove($vehicule);
          $manager->flush();
    
          return $this->redirectToRoute('data_liste');
        
        
         
        }
    



    }