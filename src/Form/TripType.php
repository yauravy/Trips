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
                'html5'=> true,
                'widget'=>'single_text',
                //'attr' => ['class' => 'datetimepicker'],
                //'format' => 'dd/MM/yyyy HH:mm'

            ])
            ->add('duree', IntegerType::class, ['label' => "Duree en heures"])
            ->add('dateLimiteInscription', null, [
                'label' => "Date limite inscription",
                'html5'=> true,
                'widget'=>'single_text',
            ])
            ->add('maxInscriptions', IntegerType::class, ['label' => 'Nombre max partecipants'])
            ->add('infosSortie', TextType::class,[
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
