<?php

namespace App\Controller\Admin;

use App\Entity\Episode;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EpisodeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Episode::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            AssociationField::new('series')
                ->setRequired(true)
                ->setHelp('Select the series this episode belongs to'),
            DateField::new('date'),
            NumberField::new('rating')
                ->setNumDecimals(1)
                ->setHelp('Rating between 0 and 10'),
        ];
    }
}