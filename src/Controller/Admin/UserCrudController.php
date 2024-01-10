<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UploadedImagesType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
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
            TextField::new('Password', label:'Mot de passe'),
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
    
}
