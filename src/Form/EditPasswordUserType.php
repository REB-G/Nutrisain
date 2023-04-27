<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class EditPasswordUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez saisir un mot de passe.',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Votre mot de passe doit contenir au moins 6 caractères.',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    'row_attr' => [
                        'class' => 'user-change-password-form__field'
                    ],
                    'label' => 'Nouveau mot de passe',
                    'label_attr' => [
                        'class' => 'user-change-password-form__field--label'
                    ],
                    'attr' => [
                        'placeholder' => 'Mot de passe',
                        'class' => 'user-change-password-form__field--input',
                    ],
                ],
                'second_options' => [
                    'row_attr' => [
                        'class' => 'user-change-password-form__field'
                    ],
                    'label' => 'Confirmer le mot de passe',
                    'label_attr' => [
                        'class' => 'user-change-password-form__field--label'
                    ],
                    'attr' => [
                        'placeholder' => 'Mot de passe',
                        'class' => 'user-change-password-form__field--input',
                    ],
                ],
                'invalid_message' => 'Les mots de passes doivent correspondre.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
            ->add('Valider', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn__linear-gradient',
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
