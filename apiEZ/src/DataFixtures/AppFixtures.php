<?php

namespace App\DataFixtures;

use App\Entity\Ecole;
use App\Entity\user;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
{
    $this->userPasswordHasher = $userPasswordHasher;
}
    public function load(ObjectManager $manager): void
    {
 //creation user admin
 $user= new user();

 $user->setEmail('user@api.com');

 $user->setRoles(['ROLE_ADMIN']);
 $user->setPassword($this->userPasswordHasher->hashPassword($user, 'password'));
 

 $listUser[] = $user;


 $manager->persist($user);


        $listEcoles = [];
        for ($i = 0; $i < 5; $i++) {
            $ecole = new Ecole();
            $ecole->setNameEc('ecole ' . $i);
            $ecole->setAdresseEc('adresse école ' . $i);
            $ecole->setTelEc('tel école ' . $i);
            $ecole->setMailEc('mail école ' . $i);

         
$ecole->addUser($listUser[array_rand($listUser)]);
           
            $manager->persist($ecole);
            $listEcoles[] = $ecole;

        $manager->flush();
    }


}

}
