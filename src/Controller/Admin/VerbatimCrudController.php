<?php

namespace App\Controller\Admin;

use App\Entity\Verbatim;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VerbatimCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Verbatim::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud 
        ->setEntityLabelInPlural('Verbatims')
        ->setEntityLabelInSingular('Verbatim')

        ->setPageTitle("index", "L'APE - Administration des Verbatims");

    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            TextField::new('name', label:'Prénom'),
            TextEditorField::new('description', label:'Verbatim'),
        ];
    }
    
}
