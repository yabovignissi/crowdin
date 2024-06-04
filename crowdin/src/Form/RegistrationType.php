<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\EmailType; 
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '100',
                ],
                'label'=>'Email',
                'label_attr'=> [
                  'class'=>  'form-label'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                   new Assert\Length(['min'=> 2 , 'max'=> 100]) 
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' =>PasswordType::class,
                'first_options' =>[
                    'label'=>'Mot de passe',
                ],
                'second_options' => [
                    'label'=>'Confirmation du mot de passe', 
                ],
                'invalid_message'=>'Les mots de passe ne correspondent pas', 
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50',
                ],
                'label'=>'Prenom',
                'label_attr'=> [
                  'class'=>  'form_label'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                   new Assert\Length(['min'=> 2 , 'max'=> 50]) 
                ]
            ])
            
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50',
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form_label'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 2, 'max' => 50])
                ],
            ])
            ->add('typeProfil', ChoiceType::class, [
                'label' => 'Type de Profil',
                'choices' => [
                    'Chef de projet' => 'chef de projet',
                    'Traducteur' => 'traducteur',
                    'Les deux' => 'les deux',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new Choice([
                        'choices' => ['chef de projet', 'traducteur', 'les deux'],
                        'message' => 'Veuillez choisir un type de profil valide.',
                    ]),
                ],
            ])
            ->add('submit',SubmitType::class, [
                'attr'=>[
                   'class'=>'btn btn-primary'
                ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
