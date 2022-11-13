<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'constraints' => [
                    new NotBlank(),
                    new Regex("/^[a-zA-Z'-]{2,}$/")
                ],
                'attr' => ['placeholder' => 'Votre prénom', 'class' => 'form-control'],
                'required' => true
            ])
            ->add('surname', TextType::class, [
                'label' => false,
                'constraints' => [
                    new NotBlank(),
                    new Regex("/^[a-zA-Z'-]{2,}$/")
                ],
                'attr' => ['placeholder' => 'Votre nom', 'class' => 'form-control'],
                'required' => true
            ])
            ->add('tel', TextType::class, [
                'label' => false,
                'constraints' => [
                    new NotBlank(),
                    new Regex('/[0-9]{10,10}$/'),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Entrez {{ limit }} caractéres',
                        'max' => 10,
                        'maxMessage' => 'Entrez {{ limit }} caractéres',
                    ])
                ],
                'attr' => ['placeholder' => 'Téléphone', 'class' => 'form-control'],
                'required' => true
            ])
            ->add('email', TextType::class, [
                'label' => false,
                'constraints' => [
                    new NotBlank(),
                    new Regex(['pattern' => '/[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/'])
                ],
                'attr' => ['placeholder' => 'Email', 'class' => 'form-control'],
                'required' => true
            ])
            ->add('message', TextareaType::class, [
                'label' => false,
                'constraints' => [
                    new NotBlank(),
                    new Regex("/^[a-zA-Z'-]{2,}$/")
                ],
                'attr' => ['placeholder' => 'Décrivez-nous la situation avec votre PC svp', 'class' => 'form-control', 'rows' => '5'],
                'required' => true
            ])
            ->add('save', SubmitType::class, [
                'label' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
