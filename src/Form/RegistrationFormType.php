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
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;

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
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un email',
                    ]),
                    new Email([
                        'message' => 'Veuillez renseigner un email valide',
                    ]),
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
                        'message' => 'Veuillez renseigner un mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit contenir au moins 8 caractères',
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                        'message' => 'Votre mot de passe doit contenir au moins 8 caractères, une majuscule,
                        une minuscule, un chiffre et un caractère spécial'
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
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un nom',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre nom doit contenir au moins 2 caractères',
                        'max' => 255,
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z]+$/',
                        'message' => 'Votre nom ne doit contenir que des lettres'
                    ]),
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
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un prénom',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre prénom doit contenir au moins 2 caractères',
                        'max' => 50,
                        'maxMessage' => 'Votre prénom ne doit pas dépasser 50 caractères',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-ZÀ-ÿ -]+$/',
                        'message' => 'Votre prénom ne doit contenir que des lettres'
                    ]),
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
