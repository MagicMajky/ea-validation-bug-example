<?php

namespace App\Controller\Admin;

use App\Entity\Person;
use App\Form\CustomEmailType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PersonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Person::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
//            IdField::new('id'),
            TextField::new('name'),
            CollectionField::new('emails')
                ->setEntryType(CustomEmailType::class)
                ->setFormTypeOption('by_reference', false)
                ->setFormTypeOption('allow_add', true)
                ->setFormTypeOption('allow_delete', true)
        ];
    }
}
