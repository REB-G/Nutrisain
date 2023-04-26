<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

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
                ]
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
                ]
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
                ]
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
                ]
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
                ]
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
