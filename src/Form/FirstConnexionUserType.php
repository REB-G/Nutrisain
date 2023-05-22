<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\Regex;

class FirstConnexionUserType extends AbstractType
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
                            'min' => 8,
                            'minMessage' => 'Votre mot de passe doit contenir au moins 8 caractères.',
                            'max' => 4096,
                        ]),
                        new Regex([
                            'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                            'message' => 'Votre mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial.'
                        ]),
                    ],
                    'row_attr' => [
                        'class' => 'first-connexion-form__field'
                    ],
                    'label' => 'Nouveau mot de passe',
                    'label_attr' => [
                        'class' => 'first-connexion-form__field--label'
                    ],
                    'attr' => [
                        'placeholder' => 'Mot de passe',
                        'class' => 'first-connexion-form__field--input',
                    ],
                ],
                'second_options' => [
                    'row_attr' => [
                        'class' => 'first-connexion-form__field'
                    ],
                    'label' => 'Confirmer le mot de passe',
                    'label_attr' => [
                        'class' => 'first-connexion-form__field--label'
                    ],
                    'attr' => [
                        'placeholder' => 'Mot de passe',
                        'class' => 'first-connexion-form__field--input',
                    ],
                ],
                'invalid_message' => 'Les mots de passes doivent correspondre.',
                'mapped' => false,
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'row_attr' => [
                    'class' => 'first-connexion-form__field-checkbox'
                ],
                'label' => 'Veuillez accepter nos conditions générales d\'utilisation',
                'label_attr' => [
                    'class' => 'first-connexion-form__field-checkbox--label'
                ],
                'attr' => [
                    'class' => 'first-connexion-form__field-checkbox--input',
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veuillez accepter nos conditions générales d\'utilisation, nos mentions légales et notre politique de confidentialité',
                    ]),
                ],
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
