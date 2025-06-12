<?php
// src/Controller/Admin/UserCrudController.php
namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
         IdField::new('id')->hideOnForm(), 
         EmailField::new('email', 'Email'),                               
         TextField::new('name',  'Name'),
         TextField::new('address','Address'),
         ChoiceField::new('roles', 'Roles')
            ->setChoices([
                'User' => 'ROLE_USER',
                'Admin'       => 'ROLE_ADMIN',
            ])
            ->renderExpanded()   // cases à cocher
            ->onlyOnForms()   // n’apparaît que sur <new>
            ->allowMultipleChoices(), // permet de sélectionner plusieurs rôles

        // 4) Password en formulaire uniquement
         TextField::new('password', 'Password')
            ->setFormType(PasswordType::class)
            ->onlyOnForms()
            ->setRequired($pageName === Crud::PAGE_NEW)
        
        ];
    }
}