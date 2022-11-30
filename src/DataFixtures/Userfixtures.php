<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class Userfixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
       $user= new User();
       $user->setEmail('demo@gmail.com');
       $password = $this->hasher->hashPassword($user, 'demodemodemo');
       $user->setPassword($password);
       $user->setRoles(['ROLE_USER']);
       $manager->persist($user);

       $admin= new User();
       $admin->setEmail('admin@gmail.com');
       $password = $this->hasher->hashPassword($admin, 'adminadmin');
       $admin->setPassword($password);
       $admin->setRoles(['ROLE_ADMIN']);
       $manager->persist($admin);
       $spadmin= new User();
       $spadmin->setEmail('spadmin@gmail.com');
       $password = $this->hasher->hashPassword($spadmin, 'superadmin');
       $spadmin->setPassword($password);
       $spadmin->setRoles(['ROLE_SUPER_ADMIN']);
       $manager->persist($spadmin);
       $manager->flush();
    }
}
