<?php

namespace App\Controller\Admin;

use App\Entity\Pub;
use App\Form\UploadedImagesType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PubCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pub::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud 
        ->setEntityLabelInPlural('Partenaires')
        ->setEntityLabelInSingular('Partenaire')

        ->setPageTitle("index", "L'APE - Administration des Partenaires");

    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            TextField::new('name', label:'Nom'),
            CollectionField::new('image',label: 'Images')
            ->setEntryType(UploadedImagesType ::class),
            
        ];
    }
    
}
