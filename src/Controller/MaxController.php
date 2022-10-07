<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\MembreType;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MaxController extends AbstractController
{
    #[Route('/max', name: 'app_max')]
    public function index(): Response
    {
        return $this->render('max/index.html.twig', [
            'controller_name' => 'MaxController',
        ]);
    }
    #[Route('/max/liste', name: 'max_liste')]
    public function liste(MembreRepository $repo) 
    {

        $membre =$repo->findAll();
        return $this->render('max/index.html.twig', ['membre' =>$membre  ]);
    } 
    #[Route('/max/new', name:"app_register")]
    #[Route('/max/edit{id}', name:"max_edit")]
     public function form(Request $globals, EntityManagerInterface $manager, Membre $user =null)
        {  if($user == null)
            
        {
          $user = new Membre;
    
        }
         $form = $this->createForm(MembreType::class, $user);
    
          $form->handleRequest($globals);
    
         
    
    
             if($form->isSubmitted() && $form->isValid()){
    
              $user->setDateEnregistrement(new \DateTime);
              $manager->persist($user);
              $manager->flush();
    
              return $this->redirectToRoute('max_liste',[
                'id' => $user->getId()
              ]);
            
             }
    
            return $this->renderForm("max/form.html.twig",[
              'form' => $form,
              'editMode' => $user->getId() !==null
            ]);
        }
        #[Route('/max/delete/{id}', name: 'max_delete')]
        
        public function delete( membre $membre, EntityManagerInterface $manager  )
        {
          
    
          $manager->remove($membre);
          $manager->flush();
    
          return $this->redirectToRoute('max_liste');
        
        
         
        }
    


      }
