<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pageTitle', TextType::class, [
                'row_attr' => [
                    'class' => 'contact-page-form__field'
                ],
                'label' => 'Titre de la page',
                'label_attr' => [
                    'class' => 'contact-page-form__field--label'
                ],
                'attr' => [
                    'class' => 'contact-page-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un titre pour la page contact.',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le titre de la page doit être de 2 caractères minimum.',
                        'max' => 255,
                        'maxMessage' => 'Le titre de la page ne doit pas dépasser 255 caractères',
                    ]),
                ],
            ])
            ->add('pageText', TextareaType::class, [
                'row_attr' => [
                    'class' => 'contact-page-form__field'
                ],
                'label' => 'Texte d\'information',
                'label_attr' => [
                    'class' => 'contact-page-form__field--label'
                ],
                'attr' => [
                    'class' => 'contact-page-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un texte pour la page contact.',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Le texte de la page doit être de 10 caractères minimum.',
                        'max' => 1255,
                        'maxMessage' => 'Le texte de la page ne doit pas dépasser 1255 caractères',
                    ]),
                ],
            ])
            ->add('phoneNumber', TextType::class, [
                'row_attr' => [
                    'class' => 'contact-page-form__field'
                ],
                'label' => 'Téléphone',
                'label_attr' => [
                    'class' => 'contact-page-form__field--label'
                ],
                'attr' => [
                    'class' => 'contact-page-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un numéro de téléphone.',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Le numéro de téléphone doit être de 10 caractères minimum.',
                        'max' => 10,
                        'maxMessage' => 'Le numéro de téléphone ne doit pas dépasser 10 caractères',
                    ]),
                    new Regex([
                        'pattern' => '/^0[1-9]([-. ]?[0-9]{2}){4}$/',
                        'message' => 'Le numéro de téléphone n\'est pas valide.',
                    ]),
                ],
            ])
            ->add('adress', TextType::class, [
                'row_attr' => [
                    'class' => 'contact-page-form__field'
                ],
                'label' => 'Adresse',
                'label_attr' => [
                    'class' => 'contact-page-form__field--label'
                ],
                'attr' => [
                    'class' => 'contact-page-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner une adresse.',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'L\'adresse doit être de 10 caractères minimum.',
                        'max' => 255,
                        'maxMessage' => 'L\'adresse ne doit pas dépasser 255 caractères',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'row_attr' => [
                    'class' => 'contact-page-form__field'
                ],
                'label' => 'Email',
                'label_attr' => [
                    'class' => 'contact-page-form__field--label'
                ],
                'attr' => [
                    'class' => 'contact-page-form__field--input',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un email.',
                    ]),
                    new Email([
                        'message' => 'L\'email n\'est pas valide.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
