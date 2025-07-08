<?php

namespace App\Controller\Admin;

use App\Entity\Movie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MovieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Movie::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('title', 'Title');
        yield TextField::new('director', 'Director');
        yield TextField::new('streamingPlatform', 'Streaming Platform');
        yield DateField::new('date', 'Date');

        yield AssociationField::new('sequel', 'Sequel')
            ->setHelp('Select the sequel of this movie')
            ->formatValue(function ($value, $entity) {
                return $entity->getSequel() ? $entity->getSequel()->getTitle() : 'Nincs';
            });

        yield AssociationField::new('prequel', 'Prequel')
            ->setHelp('Select the prequel of this movie')
            ->formatValue(function ($value, $entity) {
                return $entity->getPrequel() ? $entity->getPrequel()->getTitle() : 'None';
            });
    }
}
