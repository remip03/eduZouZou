<?php

namespace App\DataFixtures;

use App\Entity\Ecole;
use App\Entity\SuperAdmin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
 //creation user admin
 $superAdmin= new SuperAdmin();
 $superAdmin->setLastNameSA('dupont');
 $superAdmin->setFirstNameSA('michel');
 $superAdmin->setMailSA('superAdmin@api.com');
 $superAdmin->setPassSA('password');
 $superAdmin->setTelephoneSA('0123456789');
 $superAdmin->setAdresseSA('place de la gare');


 $manager->persist($superAdmin);


        $listEcoles = [];
        for ($i = 0; $i < 5; $i++) {
            $ecole = new Ecole();
            $ecole->setNameEc('ecole ' . $i);
            $ecole->setAdresseEc('adresse école ' . $i);
            $ecole->setTelephoneEc('tel école ' . $i);
            $ecole->setMailEc('mail école ' . $i);
           
            $manager->persist($ecole);
            $listEcoles[] = $ecole;

        $manager->flush();
    }


}

}
