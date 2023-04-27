<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
