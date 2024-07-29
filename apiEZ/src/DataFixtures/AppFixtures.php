<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use App\Entity\Ecole;
use App\Entity\Enfant;
use App\Entity\Message;
use App\Entity\Messagerie;
use App\Entity\User;
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
        $user = new User();
        $listUser[] = $user;
        $message = new Message;
        $listMessages[] = $message;
        $messagerie = new Messagerie();
        $listMessagerie[] = $messagerie;
        $listMessages = [];

        $message = new Message;
        $message->setContent('hello world');
        $message->setDestinataire('john doe');
        $message->setExpediteur('bob marley');

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

        // Créations des écoles
        $listEcole = [];
        for ($i = 0; $i < 5; $i++) {
            $ecole = new Ecole();
            $ecole->setNameEc('Ecole ' . $i);
            $ecole->setAdresseEc('Adresse école ' . $i);
            $ecole->setTelEc('Tel école ' . $i);
            $ecole->setMailEc('Mail école ' . $i);
            $manager->persist($ecole);

            $listEcole[] = $ecole;
        }

        // Créations des classes
        for ($i = 0; $i < 20; $i++) {
            $classe = new Classe();
            $classe->setNameCl('Classe ' . $i);
            $classe->setNiveauCl('Niveau ' . $i);
            $classe->setAnneeCl(new \DateTimeImmutable());
            $classe->setEcole($listEcole[array_rand($listEcole)]);
            $manager->persist($classe);

            $listClasse[] = $classe;
        }

        // Créations des enfants
        for ($i = 0; $i < 100; $i++) {
            $enfant = new Enfant();
            $enfant->setLastNameE('Enfant ' . $i);
            $enfant->setFirstNameE('Prénom ' . $i);
            $enfant->setBirthDateE(new \DateTimeImmutable());
            $enfant->setClasse($listClasse[array_rand($listClasse)]);
            $manager->persist($enfant);
        }

        $manager->flush();
    }
}
