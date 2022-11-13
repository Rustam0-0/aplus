<?php

// namespace App\Form;

// use App\Entity\Service;
// use Symfony\Component\Form\AbstractType;
// use Symfony\Component\Form\FormBuilderInterface;
// use Symfony\Component\OptionsResolver\OptionsResolver;

// class ServiceType extends AbstractType
// {
//     public function buildForm(FormBuilderInterface $builder, array $options): void
//     {
//         $builder
//             ->add('name')
//             ->add('description')
//             ->add('price')
//             ->add('date_add')
//             ->add('date_update')
//             ->add('picture')
//             ->add('picture2')
//             ->add('picture3')
//             ->add('picture4')
//             ->add('picture5')
//         ;
//     }

//     public function configureOptions(OptionsResolver $resolver): void
//     {
//         $resolver->setDefaults([
//             'data_class' => Service::class,
//         ]);
//     }
// }


namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nom',
                'attr' => ['class' => 'form-control']
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'Description',
                'attr' => ['class' => 'form-control']
            ])
            ->add('price', TextType::class, [
                'required' => true,
                'label' => 'Prix',
                'constraints' => [
                    new NotBlank(),
                    new Regex('/[0-9]{1,10}/')
                ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('picture', FileType::class, [
                'label' => 'Image',
                'mapped' => false,
                'required' => false,
                'attr' => ['accept' => 'image/*', 'class' => 'form-control-file'],
                'data_class' => null
            ])
            ->add('picture2', FileType::class, [
                'label' => 'Image',
                'mapped' => false,
                'required' => false,
                'attr' => ['accept' => 'image/*', 'class' => 'form-control-file'],
                'data_class' => null
            ])
            ->add('picture3', FileType::class, [
                'label' => 'Image',
                'mapped' => false,
                'required' => false,
                'attr' => ['accept' => 'image/*', 'class' => 'form-control-file'],
                'data_class' => null
            ])
            ->add('picture4', FileType::class, [
                'label' => 'Image',
                'mapped' => false,
                'required' => false,
                'attr' => ['accept' => 'image/*', 'class' => 'form-control-file'],
                'data_class' => null
            ])
            ->add('picture5', FileType::class, [
                'label' => 'Image',
                'mapped' => false,
                'required' => false,
                'attr' => ['accept' => 'image/*', 'class' => 'form-control-file'],
                'data_class' => null
            ])
            ->add('date_add', HiddenType::class, ['mapped' => false, 'data_class' => null])
            ->add('date_update', HiddenType::class, ['mapped' => false, 'data_class' => null]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}