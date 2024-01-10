<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use App\Form\UploadedImagesType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud 
        ->setEntityLabelInPlural('Evenements')
        ->setEntityLabelInSingular('Evenement')

        ->setPageTitle("index", "L'APE - Administration des Evenements");

    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            TextField::new('title', label:'Titre'),
            TextEditorField::new('description', label:'Description'),
            TextField::new('date', label:'Date'),
            CollectionField::new('images',label: 'Images')
            ->setEntryType(UploadedImagesType ::class),

        ];
    }

}
