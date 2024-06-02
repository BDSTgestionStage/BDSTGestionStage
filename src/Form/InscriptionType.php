<?php
namespace App\Form;

use App\Entity\Utilisateur;
use App\Entity\Role;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identifiant', TextType::class, ['label' => 'Identifiant'])
            ->add('role', EntityType::class, [
                'class' => Role::class,
                'choice_label' => 'ROL_LIBELLE', 
                'label' => 'Role'
            ])
            ->add('uti_password', PasswordType::class, ['label' => 'Password'])
            ->add('submit', SubmitType::class, ['label' => 'S\'inscrire']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
