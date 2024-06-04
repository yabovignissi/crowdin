<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom'
            ])
            // ->add('password', PasswordType::class, [
            //     'label' =>'Mot de pase',
            // ])
            ->add('langue', TextType::class, [
                'label' => 'Langue'
            ])
            ->add('typeProfil', ChoiceType::class, [
                'label' => 'Type de Profil',
                'choices' => [
                    'Chef de projet' => 'chef de projet',
                    'Traducteur' => 'traducteur',
                    'Les deux' => 'les deux',
                ],
            ])
            ->add('niveauLinguistique', TextType::class, [
                'label' => 'Niveau Linguistique'
            ])
            ->add('description', TextType::class, [
                'label' => 'Description'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
