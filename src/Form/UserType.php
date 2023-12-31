<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Child;
use App\Entity\Image;
use App\Form\ChildType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices'  => [
                    'Adhérent' => "ROLE_USER",
                    'Membre actif' => "ROLE_MEMBER",
                    'Administrateur' => "ROLE_ADMIN", 
                ],
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'mx-4',
                ],
                'choice_attr' => function($choice, $key, $value) {
                    return ['class' => 'mx-2'];
                },
                    
            ])
            
            ->add('name', TextType::class,[
                'label' => 'Nom',
                'required' => true,
            ])
            ->add('surname', TextType::class,[
                'label' => 'Prénom',
                'required' => true,
            ])
            ->add('rgpd',CheckboxType::class,[
                'label' => 'Vous acceptez notre politique RGPD',
                'required' => true,
                'attr' => [
                    'class' => 'my-4',
                ],
            ])
            ->add('children', CollectionType::class, [
                'entry_type' => ChildType::class,
                'allow_add' => true,
                'by_reference' => false,
                'label' => ' ',
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
