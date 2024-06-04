<?php

namespace App\Form;

use App\Entity\Projet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use App\Entity\User;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomProjet',TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50',
                ],
                'label'=>'Nom',
                'label_attr'=> [
                  'class'=>  'form_label'
                ],
            ])
            ->add('langueOrigine',TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50',
                ],
                'label'=>'langue',
                'label_attr'=> [
                  'class'=>  'form_label'
                ],
            ])
            ->add('languesCibles', ChoiceType::class, [
                'choices' => [
                    'Francais' => 'Francais',
                    'Anglais' => 'Anglais',
                    'Espagnol' => 'Espagnol',
                    'Portugais' => 'Portugais',
                    'Arabe' => 'Arabe',
                ],
                'multiple' => true,
                'expanded' => true,
                'required' => true,
                'label' => 'Langues cibles (choisissez trois)',
                'choice_attr' => function() {
                    return ['style' => 'width: 120px']; 
                },
                'attr' => [
                    'size' => '3', 
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
