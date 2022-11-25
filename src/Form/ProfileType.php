<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('isAdmin')
            ->add('actif')
            ->add('photo')
            ->add('pseudo')
            ->add('campus', EntityType::class, [
                'label' => 'Votre ecole',
                'class' => Campus::class,
                'choice_label' => 'nom'
            ])
            ->add('submit', SubmitType::class, ['label' => 'Lets go'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
