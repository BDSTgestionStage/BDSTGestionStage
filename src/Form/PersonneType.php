<?php

namespace App\Form;

use App\Entity\Personne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Entreprise;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\Repository\EntrepriseRepository;

class PersonneType extends AbstractType
{
    private $entrepriseRepository;

    public function __construct(EntrepriseRepository $entrepriseRepository)
    {
        $this->entrepriseRepository = $entrepriseRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('PER_NOM', TextType::class, [
                'label' => 'PER_NOM'
            ])
            ->add('PER_PRENOM', TextType::class, [
                'label' => 'PER_PRENOM'
            ])
            ->add('entreprise', ChoiceType::class, [
                'label' => 'Entreprise',
                'choices' => $this->getEntrepriseChoices(),
                'placeholder' => 'Sélectionnez une entreprise',
                'required' => true, // Changez à true si l'entreprise est obligatoire
                'choice_value' => 'id', // Spécifiez la propriété à utiliser comme valeur de l'option
                'choice_label' => 'entnom', // Spécifiez la propriété à afficher comme label de l'option
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Téléphone'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personne::class,
        ]);
    }

    private function getEntrepriseChoices()
{
    $entreprises = $this->entrepriseRepository->findAll();
    $choices = [];
    foreach ($entreprises as $entreprise) {
        $choices[$entreprise->getEntnom()] = $entreprise; // Utiliser l'objet Entreprise comme valeur de l'option
    }
    return $choices;
}
}