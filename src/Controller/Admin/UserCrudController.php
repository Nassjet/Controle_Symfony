<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('email'),
            TextField::new('password')
                ->onlyWhenCreating()
                ->setFormType(PasswordType::class),
            ChoiceField::new('roles')
                ->setChoices([
                    'Admin' => 'ROLE_ADMIN',
                    'Conseiller' => 'ROLE_CONSEILLER',
                    'User' => 'ROLE_USER',
                ])
                ->allowMultipleChoices()
                ->renderExpanded(),
        ];
    }

    public function persistEntity($entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof User && $entityInstance->getPassword()) {
            $hashedPassword = $this->passwordHasher->hashPassword(
                $entityInstance,
                $entityInstance->getPassword()
            );
            $entityInstance->setPassword($hashedPassword);
        }

        parent::persistEntity($entityManager, $entityInstance);
    }
}
