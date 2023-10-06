<?php

namespace App\Form;

use App\Entity\Bicycle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BicycleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand')
            ->add('model')
            ->add('color')
            ->add('price')
            ->add('description', TextareaType::class)
            ->add('category', ChoiceType::class, [
                'placeholder' => 'Choose a category',
                'choices'  => [
                    'Road Bike' => 'Road',
                    'Gravel Bike' => 'Gravel',
                    'Mountain Bike' => 'Mountain',
                    'eBikes' => 'eBikes',
                    'Kids Bike' => 'Kids',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bicycle::class,
        ]);
    }
}