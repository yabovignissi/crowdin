<?php

namespace App\Form;

use App\Entity\Traduction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TraductionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_id', HiddenType::class)
            ->add('sources', ChoiceType::class, [
                'choices' => $options['sources'],
                'multiple' => true,
                'expanded' => true,
                'choice_label' => function($source) {
                    return 'Cle: ' . $source->getCle();
                },
            ])
            ->add('save', SubmitType::class, ['label' => 'Enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Traduction::class,
            'sources' => [],
        ]);
    }
}
