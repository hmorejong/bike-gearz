<?php

namespace App\Form;

use App\Config\BicycleCategory;
use App\Entity\Bicycle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
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
            ->add('description')
            ->add('category', EnumType::class, ['class' => BicycleCategory::class,
                'placeholder' => 'Select a Category',
                'choice_label' => fn ($choice) => match ($choice) {
                    BicycleCategory::Road => 'Road Bike',
                    BicycleCategory::Gravel => 'Gravel Bike',
                    BicycleCategory::Mountain => 'Mountain Bike',
                    BicycleCategory::eBikes => 'eBikes',
                    BicycleCategory::Kids => 'Kids Bike',
                },]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bicycle::class,
        ]);
    }
}