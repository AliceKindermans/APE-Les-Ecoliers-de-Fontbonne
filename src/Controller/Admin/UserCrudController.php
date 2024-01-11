<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UploadedImagesType;
use Symfony\Component\Form\FormEvents;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Symfony\Component\Validator\Constraints\Regex;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    public function __construct(
        public UserPasswordHasherInterface $userPasswordHasher
    ) {}
    
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud 
        ->setEntityLabelInPlural('Parents d\'élèves')
        ->setEntityLabelInSingular('Parent d\'élèves')

        ->setPageTitle("index", "L'APE - Administration des Parents d\'élèves");

    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            TextField::new('name', label:'Nom'),
            TextField::new('surname', label:'Prénom'),
            TextField::new('email', label:'Email'),
            ArrayField::new('roles', label: 'Rôle'),
            TextField::new('status', label:'Statut'),
            TextField::new('password')
            ->setFormType(RepeatedType::class)
            ->setFormTypeOptions([
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Répéter le mot de passe'],
                'mapped' => false,
                'constraints' => [
                    new Regex([
                        'pattern' => '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{14,}$/',
                        'message' =>  'Le mot de passe doit comporter au moins 14 caractères avec 1 majuscule, 1 minuscule, 1chiffre et 1 caractère spécial.'
                    ])
                    ],
            ]),
            BooleanField::new('rgpd', label:'Accord RGPD'),
            DateTimeField::new('createdAt', label:'Créée le'),
            AssociationField::new('children', label:'Enfants')
            ->setFormTypeOptions([
                'by_reference' => false, // Cela garantit que les enfants sont ajoutés correctement
                'multiple' => true, // Cela permet de sélectionner plusieurs enfants
            ]),
            CollectionField::new('images',label: 'Images')
            ->setEntryType(UploadedImagesType ::class),
        ];

    
    }

    public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    private function addPasswordEventListener(FormBuilderInterface $formBuilder): FormBuilderInterface
    {
        return $formBuilder->addEventListener(FormEvents::POST_SUBMIT, $this->hashPassword());
    }

    private function hashPassword() {
        return function($event) {
            $form = $event->getForm();
            if (!$form->isValid()) {
                return;
            }
    
            $user = $form->getData();
            $password = $form->get('password')->getData();
    
            if ($password === null) {
                return;
            }
    
            $hash = $this->userPasswordHasher->hashPassword($user, $password);
            $user->setPassword($hash);
        };
    }
    
    
}
