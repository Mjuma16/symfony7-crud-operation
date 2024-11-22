<?php

namespace App\Form;

use App\Entity\TodoList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AddItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array(
                    'class' => 'form-control ps-3 mt-1 mb-3',
                    'placeholder' => 'Name',
                ),
                'required' => false
            ])
            ->add('title', TextType::class, [
                'attr' => array(
                    'class' => 'form-control ps-3 mt-1 mb-3',
                    'placeholder' => 'Title'
                ),
                'required' => false
            ])
            ->add('description', TextType::class, [
                'attr' => array(
                    'class' => 'form-control ps-3 mt-1 mb-3',
                    'placeholder' => 'Description'
                ),
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TodoList::class,
        ]);
    }
}
