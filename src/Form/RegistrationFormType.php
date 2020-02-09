<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Nom d\'utilisateur',
                'required' => true
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Répéter le mot de passe'],
                'invalid_message' => 'Les 2 mots de passe doivent être identiques',
                'required' => true
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse mail',
                'required' => true
            ])
            ->add('lastName',  TextType::class, [
                'label' => 'Nom',
                'required' => true
            ])
            ->add('firstName',  TextType::class, [
                'label' => 'Prénom',
                'required' => true
            ])
            ->add('birthday', BirthdayType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'label' => 'Date de naissance',
                'format'=> 'dd/MM/yyyy',
                'invalid_message' => 'Date incorrecte',
                'attr' => ['class' => 'js-datepicker'],
                'required' => true
            ])
            ->add('submitRegister', SubmitType::class, [
                'label' => 'Envoyer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
