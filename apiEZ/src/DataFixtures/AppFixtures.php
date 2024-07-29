<?php

namespace App\DataFixtures;

use App\Entity\Activite;
use App\Entity\Classe;
use App\Entity\Cours;
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

        // Création des activités.
        for ($i = 0; $i < 10; $i++) {
            $activite = new Activite();
            $activite->setTypeR('type ' . $i);
            $activite->setNameR('activite n°' . $i);
            $activite->setDescriptionR('Voici l\'activite n°' . $i);
            $activite->setMatiereR('Mathématiques' . $i);
            $activite->setTypeAct('quizz n°' . $i);
            $manager->persist($activite);
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
        // Créations des enfants
        for ($i = 0; $i < 100; $i++) {
            $enfant = new Enfant();
            $enfant->setLastNameE('Enfant ' . $i);
            $enfant->setFirstNameE('Prénom ' . $i);
            $enfant->setBirthDateE(new \DateTimeImmutable());
            $enfant->setClasse($listClasse[array_rand($listClasse)]);
            $manager->persist($enfant);
        }

        // Création des cours.
        for ($i = 0; $i < 10; $i++) {
            $cours = new Cours();
            $cours->setTypeR('type ' . $i);
            $cours->setNameR('cours n° ' . $i);
            $cours->setDescriptionR('Voici le cours n° ' . $i);
            $cours->setMatiereR('Mathématiques ' . $i);
            $cours->setDocC('doc n° ' . $i);
            $cours->setVideoC('video n° ' . $i);
            $cours->setRessourceSupC('ressource supplémentaire n° ' . $i);
            $manager->persist($cours);
        }



        //creation user admin
        $user = new User();
        $listUser[] = $user;
        $message = new Message;
        $listMessages[] = $message;
        $messagerie = new Messagerie();
        $listMessagerie[] = $message;
        $activite = new Activite();
        $listActivite[] = $activite;
        $cours = new Cours();
        $listCours[] = $cours;

        $listMessages = [];
        for ($i = 0; $i <10; $i++) {
        $message = new Message;
        $message->setContent('hello world'.$i);
        $message->setDestinataire('john doe'.$i);
        $message->setExpediteur('bob marley'.$i);

        $manager->persist($message);
        }
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
        $user->setEcole($listEcole[array_rand($listEcole)]);


        $manager->persist($user);

        $manager->flush();
    }
}
