<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Child;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ChildType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'label' => 'Nom',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('surname',TextType::class,[
                'label' => 'Prénom',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('grade', ChoiceType::class, [
                'label' => 'Classe',
                'choices'  => [
                    'PS' => "PS",
                    'MS' => "MS",
                    'GS' => "GS", 
                    'CP' => "CP",
                    'CE1' => "CE1",
                    'CE2' => "CE2",
                    'CM1' => "CM1",
                    'CM2' => "CM2",
                ],
                'multiple' => false,
                'expanded' => true,
                'attr' => [
                    'class' => 'mx-4',
                ],
                'choice_attr' => function($choice, $key, $value) {
                    return ['class' => 'mx-2'];
                },
            ])
            ->add('mistress', ChoiceType::class, [
                'label' => 'Maitresse',
                'choices'  => [
                    'Valérie' => "Valerie Vidal",
                    'Claire' => "Claire Franck",
                    'Cindy' => "Cindy Lejeune", 
                    'Lydie' => "Lydie Durand",
                    'Florence' => "Florence Goffin",
                    'Elodie' => "Elodie Lebourgeois",
                    'Sandrine' => "Sandrine Cabal",
                    'Laurence' => "Laurence Gatumel",
                    'Celine' => "Celine Jammes",
                ],
                'multiple' => false,
                'expanded' => true,
                'attr' => [
                    'class' => 'mx-4',
                ],
                'choice_attr' => function($choice, $key, $value) {
                    return ['class' => 'mx-2'];
                },
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Child::class,
        ]);
    }
}
