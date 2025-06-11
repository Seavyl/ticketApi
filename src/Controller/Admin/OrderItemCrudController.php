<?php

namespace App\Controller\Admin;

use App\Entity\OrderItem;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OrderItemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrderItem::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            IntegerField::new('quantity', 'Quantity'),
            MoneyField::new('unitPrice', 'Unit price')
            ->setCurrency('EUR'),
            DateTimeField::new('createdAt', 'Created at')
            ->hideOnForm(),
            AssociationField::new('relatedOrder', 'Order'),
            AssociationField::new('ticket', 'Ticket')

            
        ];
    }
    
}
