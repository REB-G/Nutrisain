<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Email;

class EditUserProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'row_attr' => [
                    'class' => 'change-user-informations-form__field'
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'change-user-informations-form__field--label'
                ],
                'attr' => [
                    'placeholder' => 'Nom',
                    'class' => 'change-user-informations-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un nom.',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le nom doit être de 2 caractères minimum.',
                        'max' => 255,
                        'maxMessage' => 'Le nom ne doit pas dépasser 255 caractères',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z]+$/',
                        'message' => 'Le nom ne doit contenir que des lettres.',
                    ]),
                ],
            ])
            ->add('firstname', TextType::class, [
                'row_attr' => [
                    'class' => 'change-user-informations-form__field'
                ],
                'label' => 'Prénom',
                'label_attr' => [
                    'class' => 'change-user-informations-form__field--label'
                ],
                'attr' => [
                    'placeholder' => 'Prénom',
                    'class' => 'change-user-informations-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un prénom.',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le prénom doit être de 2 caractères minimum.',
                        'max' => 50,
                        'maxMessage' => 'Le prénom ne doit pas dépasser 50 caractères',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-ZÀ-ÿ -]+$/',
                        'message' => 'Le prénom ne doit contenir que des lettres.',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'row_attr' => [
                    'class' => 'change-user-informations-form__field'
                ],
                'label' => 'Email',
                'label_attr' => [
                    'class' => 'change-user-informations-form__field--label'
                ],
                'attr' => [
                    'placeholder' => 'Email',
                    'class' => 'change-user-informations-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un email.',
                    ]),
                    new Email([
                        'message' => 'Veuillez renseigner un email valide.',
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
