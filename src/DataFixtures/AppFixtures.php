<?php

namespace App\DataFixtures;

use App\Entity\User2;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    protected $encoder;
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User2();
        $encode = $this -> encoder -> hashPassword($user, '123');
        $user-> setName("Beso") -> setSurname("Gogoladze") -> setEmail("beso@example.com")-> setRoles(['ROLE_USER']) -> setPassword($encode);

        $admin = new User2();
        $encodedAdmin = $this -> encoder -> hashPassword($admin, '1234');
        $admin -> setName("Admin") -> setSurname("Administrator") -> setEmail("admin@example.com")->setPassword($encodedAdmin)->setRoles(['ROLE_ADMIN']);

        $employee = new User2();
        $encodedEmployee = $this -> encoder -> hashPassword($employee, '5678');
        $employee -> setName("Employee") -> setSurname("Staff") -> setEmail("employee@example.com")->setPassword($encodedEmployee)->setRoles(['ROLE_EMPLOYEE']);

        $manager->persist($admin);
        $manager->persist($employee);
        $manager->persist($user);

        $manager->flush();
    }
}
