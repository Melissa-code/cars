<?php

namespace App\Form;

use App\Entity\SearchCar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchCarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('minYear', IntegerType::class, [
                'label' => 'Année de :',
                'required' => 'false'
            ])
            ->add('maxYear', IntegerType::class, [
                'label' => 'Année à :',
                'required' => 'false'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchCar::class,
        ]);
    }
}
