<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Child;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ChildCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Child::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud 
        ->setEntityLabelInPlural('Enfants')
        ->setEntityLabelInSingular('Enfant')

        ->setPageTitle("index", "L'APE - Administration des Enfants");

    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            TextField::new('name', label: 'Nom'),
            TextField::new('surname', label: 'Prénom'),
            ChoiceField::new('grade', 'Classe')
            ->setChoices([
                'PS' => 'PS',
                'MS' => 'MS',
                'GS' => 'GS',
                'CP' => 'CP',
                'CE1' => 'CE1',
                'CE2' => 'CE2',
                'CM1' => 'CM1',
                'CM2' => 'CM2',
            ]),
            ChoiceField::new('mistress', label: 'Maitresse')
            ->setChoices([
                    'Valérie' => "Valerie Vidal",
                    'Claire' => "Claire Franck",
                    'Cindy' => "Cindy Lejeune", 
                    'Lydie' => "Lydie Durand",
                    'Florence' => "Florence Goffin",
                    'Elodie' => "Elodie Lebourgeois",
                    'Sandrine' => "Sandrine Cabal",
                    'Laurence' => "Laurence Gatumel",
                    'Celine' => "Celine Jammes",
                ]),
        ];
    }
    
}
