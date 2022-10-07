<?php

namespace App\Form;

use DateTime;
use App\Entity\Membre;
use App\Entity\Commande;
use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('membre',EntityType::class,[
                    'class'=>Membre::class,
                    'choice_label'=>'email'
                ])
                ->add('vehicule',EntityType::class,[
                    'class'=>Vehicule::class,
                    'choice_label'=>'titre'
                ])
                ->add('dateHeureDepart',DateTimeType::class)
                ->add('dateHeureFin',DateTimeType::class)
                ->add('prixTotal')
                
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' =>Commande::class,
        ]);
    }
}
