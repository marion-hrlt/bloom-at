<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Créer un nouvel utilisateur');
            });
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom'),
            TextField::new('firstname', 'Prénom'),
            TextField::new('password')->hideOnIndex()->hideOnForm(),
            EmailField::new('email'),
            TextField::new('presentation')->hideOnIndex(),
            ChoiceField::new('roles', 'Role')
                ->setChoices(['Administrateur' => 'ROLE_ADMIN', 'Modérateur' => 'ROLE_MOD', 'Utilisateur' => 'ROLE_USER'])
                ->allowMultipleChoices(),
            AssociationField::new('categories', 'Intérêts (catégories)')->hideOnIndex(),
            AssociationField::new('types', 'Intérêts (Type de post)')->hideOnIndex(),
            AssociationField::new('relations', 'Intérêts (Relation)')->hideOnIndex(),
            ImageField::new('profil_picture', 'Photo de profil')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
        ];
    }
}
