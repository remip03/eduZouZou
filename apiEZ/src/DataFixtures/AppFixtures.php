<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use App\Entity\Ecole;
use App\Entity\Message;
use App\Entity\Messagerie;
use App\Entity\user;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixtures
{

    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        //creation user admin
        $user = new user();
        $listUser[] = $user;
        $ecole = new Ecole();
        $listEcoles[] = $ecole;
        $message = new Message;
        $listMessages[] = $message;
        $messagerie = new Messagerie();
        $listMessagerie[] = $message;

        $listMessages = [];

        $message = new Message;
        $message->setContent('contenu message ');
        $message->setDestinataire('ecole');
        $message->setExpediteur('user');

        $manager->persist($message);

        $listMessages[] = $message;

        $listMessagerie = [];

        $messagerie = new Messagerie();
        $messagerie->setMessages(($listMessages[array_rand($listMessages)]));

        $manager->persist($messagerie);
        $listMessagerie[] = $messagerie;

        $user->setEmail('user@api.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, 'password'));
        $user->setFirstName('jean');
        $user->setLastName('dupont');
        $user->setTel('0123456789');
        $user->setAdresse('adresse user');
        $user->setMessagerie($listMessagerie[array_rand($listMessagerie)]);


        $manager->persist($user);

        $listEcoles = [];
        for ($i = 0; $i < 5; $i++) {
            $ecole = new Ecole();
            $ecole->setNameEc('Ecole ' . $i);
            $ecole->setAdresseEc('Adresse école ' . $i);
            $ecole->setTelEc('Tel école ' . $i);
            $ecole->setMailEc('Mail école ' . $i);

            $ecole->addUser($listUser[array_rand($listUser)]);

            $manager->persist($ecole);
        }
        
        // Créations des classes
        for ($i = 0; $i < 20; $i++) {
            $classe = new Classe();
            $classe->setNameCl('Classe ' . $i);
            $classe->setNiveauCl('Niveau ' . $i);
            $classe->setAnneeCl(new \DateTimeImmutable());
            $manager->persist($classe);
        }

        $manager->flush();
    }
}
