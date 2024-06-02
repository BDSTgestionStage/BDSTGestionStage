<?php

namespace App\Form;

use App\Entity\Utilisateur;
use App\Entity\Role;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identifiant', TextType::class, [
                'label' => 'Identifiant'
            ])
            ->add('role',TextType::class, [
                'label' => 'Role'
            ])
            ->add('uti_password', PasswordType::class, [
                'label' => 'Mot de passe de l\'utilisateur'
            ])
            ->add('submit', SubmitType::class, ['label' => 'S\'inscrire'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}

