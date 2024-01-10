<?php

namespace App\Controller\Admin;

use App\Entity\Association;
use App\Form\UploadedImagesType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AssociationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Association::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud 
        ->setEntityLabelInPlural('Associations')
        ->setEntityLabelInSingular('Association')

        ->setPageTitle("index", "L'APE - Administration de l'association");

    }


    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('name', label: 'Nom'),
            EmailField::new('email', label: 'Email'),
            TextField::new('siret', label: 'SIRET'),
            TextField::new('adress', label: 'Adresse'),
            CollectionField::new('images',label: 'Images')
            ->setEntryType(UploadedImagesType ::class),
            

        ];
    }
    
}

