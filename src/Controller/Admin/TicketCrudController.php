<?php

namespace App\Controller\Admin;

use App\Entity\Ticket;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TicketCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ticket::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideonForm(),
            TextField::new('artistName', 'artist name'),
            DateTimeField::new('startDate', 'Start date')
            ->setFormat('dd/MM/yyyy HH:mm'),
            DateTimeField::new('endDate', 'End date')
            ->setFormat('dd/MM/yyyy HH:mm'),
            TextField::new('venue', 'Venue'),
            MoneyField::new('price', 'Prix')
            ->setCurrency('EUR'),
            IntegerField::new('remainingQuantity', 'Ticket quantity'),
            AssociationField::new('category', 'Category'),
            CollectionField::new('orderItems', 'Order items')
            ->onlyOnDetail()

            

        ];
    }
    
}
