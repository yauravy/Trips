<?php

namespace App\Form;

use App\Entity\Trip;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TripType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [ 'label' => 'Nom Sortie'])
            ->add('dateDebut', null, [
                'label' => 'Debut le',

            ])
            ->add('duree', IntegerType::class, ['label' => "Duree en heures"])
            ->add('dateLimiteInscription', null, [
                'label' => "Date limite pour l'inscription",
                'html5'=> false,
                'widget'=>'single_text',
            ])
            ->add('maxInscriptions', IntegerType::class, ['label' => 'Nombre max partecipants'])
            ->add('infosSortie', null,[
                'required' => false,
            ])
            //->add('etat')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trip::class,
        ]);
    }
}
