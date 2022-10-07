<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
           
        ]);
    }
    #[Route('/admin/commande', name: 'admin_commande')]
    public function adminCommande(CommandeRepository $repo, EntityManagerInterface $manager)
    {   
        $colonnes =$manager->getClassMetadata(Commande::class)->getFieldNames();
    
        //dd($colonnes);
        //dump &die

        $commande =$repo->findAll();

        return $this->render('admin/admin_commande.html.twig', [
            'commandes' => $commande,
            'colonnes' => $colonnes    
            ]);
    }

    #[Route('/admin/commande/new', name: 'admin_new_commande')]
    #[Route('/admin/commande/edit/{id}', name: 'admin_edit_commande')]

    public function formCommande(Request $globals, EntityManagerInterface $manager, Commande $commande =null)
    { 
        if($commande == null)
        {
            $commande = new Commande;
            $commande->setDateEnregistrement(new \DateTime);
    }
        
    $form = $this->createForm(CommandeType::class, $commande);
    $form->handleRequest($globals);

    if($form->isSubmitted() && $form->isValid())
    { 
   
    $manager->persist($commande);
            $manager->flush();
            $this->addFlash('success',"commande a bien été enregistré !");
            return $this->redirectToRoute('admin_commande');
    }

    return $this->renderForm("admin/form_commande.html.twig",[
            'formCommande' => $form,
            'editMode' => $commande->getId() !==null
        ]);
    

    }

    #[Route('/admin/delete_commande/{id}', name: 'admin_delete_commande')]

    public function deleteCommande(Commande $commande, EntityManagerInterface $manager)
    {
        $manager->remove($commande);
        $manager->flush();
        $this->addFlash('success', "commande a bien été supprimé !");
        return $this->redirectToRoute('admin_commande');


    }

}
