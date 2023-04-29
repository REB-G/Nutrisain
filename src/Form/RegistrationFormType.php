<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'row_attr' => [
                    'class' => 'register-form__field'
                ],
                'label' => 'Email',
                'label_attr' => [
                    'class' => 'register-form__field--label'
                ],
                'attr' => [
                    'placeholder' => 'Email',
                    'class' => 'register-form__field--input',
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'row_attr' => [
                    'class' => 'register-form__field'
                ],
                'label' => 'Mot de passe',
                'label_attr' => [
                    'class' => 'register-form__field--label'
                ],
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Mot de passe',
                    'class' => 'register-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('name', TextType::class, [
                'row_attr' => [
                    'class' => 'register-form__field'
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'register-form__field--label'
                ],
                'attr' => [
                    'placeholder' => 'Nom',
                    'class' => 'register-form__field--input',
                ],
            ])
            ->add('firstname', TextType::class, [
                'row_attr' => [
                    'class' => 'register-form__field'
                ],
                'label' => 'Prénom',
                'label_attr' => [
                    'class' => 'register-form__field--label'
                ],
                'attr' => [
                    'placeholder' => 'Prénom',
                    'class' => 'register-form__field--input',
                ],
            ])
            ->add('allergy', EntityType::class, [
                'class' => 'App\Entity\Allergies',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Allergies',
                'label_attr' => [
                    'class' => 'register-form__field--label'
                ],
            ])
            ->add('diet', EntityType::class, [
                'class' => 'App\Entity\Diets',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Régimes',
                'label_attr' => [
                    'class' => 'register-form__field--label'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
