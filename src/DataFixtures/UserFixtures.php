<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setFirstname('Brian')
            ->setLastname('User')
            ->setEmail('brian@gmail.com')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->userPasswordHasher->hashPassword($user, 'brian'))
            ->setPhone('06 06 06 06 06')
            ->setAdress('10 rue de Paris')
            ->setCityCode(75009)
            ->setCity('Paris');
        $this->addReference('user_Brian', $user);
        $manager->persist($user);

        $user = new User();
        $user->setFirstname('Arthur')
            ->setLastname('User')
            ->setEmail('arthur@gmail.com')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->userPasswordHasher->hashPassword($user, 'arthur'))
            ->setPhone('06 07 06 07 06')
            ->setAdress('10 rue de Bordeaux')
            ->setCityCode(33000)
            ->setCity('Bordeaux');
        $this->addReference('user_Arthur', $user);
        $manager->persist($user);

        $user = new User();
        $user->setFirstname('Alexandre')
            ->setLastname('User')
            ->setEmail('alexandre@gmail.com')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->userPasswordHasher->hashPassword($user, 'alexandre'))
            ->setPhone('06 07 69 07 96')
            ->setAdress('10 rue de Montpellier')
            ->setCityCode(34000)
            ->setCity('Montpellier');
        $this->addReference('user_Alexandre', $user);
        $manager->persist($user);

        $user = new User();
        $user->setFirstname('Admin')
            ->setLastname('Test')
            ->setEmail('admin@gmail.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->userPasswordHasher->hashPassword($user, 'admin'))
            ->setPhone('06 87 89 97 36')
            ->setAdress('10 rue de Lyon')
            ->setCityCode(69000)
            ->setCity('Lyon');
        $manager->persist($user);

        $manager->flush();
    }
}
