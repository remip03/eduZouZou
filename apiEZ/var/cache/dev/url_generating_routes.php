<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], [], []],
    'app.swagger' => [[], ['_controller' => 'nelmio_api_doc.controller.swagger'], [], [['text', '/api/doc.json']], [], [], []],
    'app.swagger_ui' => [[], ['_controller' => 'nelmio_api_doc.controller.swagger_ui'], [], [['text', '/api/doc']], [], [], []],
    'app_activite' => [[], ['_controller' => 'App\\Controller\\ActiviteController::getAllActivites'], [], [['text', '/api/activites']], [], [], []],
    'detailActivite' => [['id'], ['_controller' => 'App\\Controller\\ActiviteController::getActiviteDetail'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/activites']], [], [], []],
    'deleteActivite' => [['id'], ['_controller' => 'App\\Controller\\ActiviteController::deleteActivite'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/activites']], [], [], []],
    'createActivite' => [[], ['_controller' => 'App\\Controller\\ActiviteController::createActivite'], [], [['text', '/api/activites']], [], [], []],
    'updateActivite' => [['id'], ['_controller' => 'App\\Controller\\ActiviteController::updateActivite'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/activites']], [], [], []],
    'classe' => [[], ['_controller' => 'App\\Controller\\ClasseController::getAllClasses'], [], [['text', '/api/classes']], [], [], []],
    'detailClasse' => [['id'], ['_controller' => 'App\\Controller\\ClasseController::getClasseDetail'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/classes']], [], [], []],
    'deleteClasse' => [['id'], ['_controller' => 'App\\Controller\\ClasseController::deleteClasse'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/classes']], [], [], []],
    'createClasse' => [[], ['_controller' => 'App\\Controller\\ClasseController::createClasse'], [], [['text', '/api/classes']], [], [], []],
    'updateClasse' => [['id'], ['_controller' => 'App\\Controller\\ClasseController::updateClasse'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/classes']], [], [], []],
    'app_cours' => [[], ['_controller' => 'App\\Controller\\CoursController::getAllCours'], [], [['text', '/api/cours']], [], [], []],
    'detailCour' => [['id'], ['_controller' => 'App\\Controller\\CoursController::getCourDetail'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/cours']], [], [], []],
    'deleteCours' => [['id'], ['_controller' => 'App\\Controller\\CoursController::deleteCours'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/cours']], [], [], []],
    'createCours' => [[], ['_controller' => 'App\\Controller\\CoursController::createCours'], [], [['text', '/api/cours']], [], [], []],
    'updateCours' => [['id'], ['_controller' => 'App\\Controller\\CoursController::updateCours'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/cours']], [], [], []],
    'ecoles' => [[], ['_controller' => 'App\\Controller\\EcoleController::getAllEcoles'], [], [['text', '/api/ecoles']], [], [], []],
    'detailEcole' => [['id'], ['_controller' => 'App\\Controller\\EcoleController::getEcoleDetail'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/ecoles']], [], [], []],
    'deleteEcole' => [['id'], ['_controller' => 'App\\Controller\\EcoleController::deleteEcole'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/ecoles']], [], [], []],
    'createEcole' => [[], ['_controller' => 'App\\Controller\\EcoleController::createEcole'], [], [['text', '/api/ecoles']], [], [], []],
    'updateEcole' => [['id'], ['_controller' => 'App\\Controller\\EcoleController::updateEcole'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/ecoles']], [], [], []],
    'enfant' => [[], ['_controller' => 'App\\Controller\\EnfantController::getAllEnfants'], [], [['text', '/api/enfants']], [], [], []],
    'detailEnfant' => [['id'], ['_controller' => 'App\\Controller\\EnfantController::getEnfantDetail'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/enfants']], [], [], []],
    'deleteEnfant' => [['id'], ['_controller' => 'App\\Controller\\EnfantController::deleteEnfant'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/enfants']], [], [], []],
    'createEnfant' => [[], ['_controller' => 'App\\Controller\\EnfantController::createEnfant'], [], [['text', '/api/enfants']], [], [], []],
    'updateEnfant' => [['id'], ['_controller' => 'App\\Controller\\EnfantController::updateEnfant'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/enfants']], [], [], []],
    'message' => [[], ['_controller' => 'App\\Controller\\MessageController::getAllMessages'], [], [['text', '/api/messages']], [], [], []],
    'detailmessage' => [['id'], ['_controller' => 'App\\Controller\\MessageController::getMessageDetail'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/messages']], [], [], []],
    'deletemessage' => [['id'], ['_controller' => 'App\\Controller\\MessageController::deletemessage'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/messages']], [], [], []],
    'createmessage' => [[], ['_controller' => 'App\\Controller\\MessageController::createMessage'], [], [['text', '/api/messages']], [], [], []],
    'updatemessage' => [['id'], ['_controller' => 'App\\Controller\\MessageController::updateMessage'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/messages']], [], [], []],
    'messageries' => [[], ['_controller' => 'App\\Controller\\MessagerieController::getAllMessageries'], [], [['text', '/api/messageries']], [], [], []],
    'detailMessagerie' => [['id'], ['_controller' => 'App\\Controller\\MessagerieController::getMessagerieDetail'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/messageries']], [], [], []],
    'deleteMessagerie' => [['id'], ['_controller' => 'App\\Controller\\MessagerieController::deleteMessagerie'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/messageries']], [], [], []],
    'createMessagerie' => [[], ['_controller' => 'App\\Controller\\MessagerieController::createMessagerie'], [], [['text', '/api/messageries']], [], [], []],
    'updatemessagerie' => [['id'], ['_controller' => 'App\\Controller\\MessagerieController::updateMessagerie'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/messageries']], [], [], []],
    'app_ressource' => [[], ['_controller' => 'App\\Controller\\RessourceController::getAllRessources'], [], [['text', '/api/ressources']], [], [], []],
    'detailRessource' => [['id'], ['_controller' => 'App\\Controller\\RessourceController::getRessourceDetail'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/ressources']], [], [], []],
    'deleteRessource' => [['id'], ['_controller' => 'App\\Controller\\RessourceController::deleteRessource'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/ressources']], [], [], []],
    'createRessource' => [[], ['_controller' => 'App\\Controller\\RessourceController::createRessource'], [], [['text', '/api/ressources']], [], [], []],
    'updateRessource' => [['id'], ['_controller' => 'App\\Controller\\RessourceController::updateRessource'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/ressources']], [], [], []],
    'api_login_check' => [[], [], [], [['text', '/api/login_check']], [], [], []],
    'App\Controller\ActiviteController::getAllActivites' => [[], ['_controller' => 'App\\Controller\\ActiviteController::getAllActivites'], [], [['text', '/api/activites']], [], [], []],
    'App\Controller\ActiviteController::getActiviteDetail' => [['id'], ['_controller' => 'App\\Controller\\ActiviteController::getActiviteDetail'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/activites']], [], [], []],
    'App\Controller\ActiviteController::deleteActivite' => [['id'], ['_controller' => 'App\\Controller\\ActiviteController::deleteActivite'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/activites']], [], [], []],
    'App\Controller\ActiviteController::createActivite' => [[], ['_controller' => 'App\\Controller\\ActiviteController::createActivite'], [], [['text', '/api/activites']], [], [], []],
    'App\Controller\ActiviteController::updateActivite' => [['id'], ['_controller' => 'App\\Controller\\ActiviteController::updateActivite'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/activites']], [], [], []],
    'App\Controller\ClasseController::getAllClasses' => [[], ['_controller' => 'App\\Controller\\ClasseController::getAllClasses'], [], [['text', '/api/classes']], [], [], []],
    'App\Controller\ClasseController::getClasseDetail' => [['id'], ['_controller' => 'App\\Controller\\ClasseController::getClasseDetail'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/classes']], [], [], []],
    'App\Controller\ClasseController::deleteClasse' => [['id'], ['_controller' => 'App\\Controller\\ClasseController::deleteClasse'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/classes']], [], [], []],
    'App\Controller\ClasseController::createClasse' => [[], ['_controller' => 'App\\Controller\\ClasseController::createClasse'], [], [['text', '/api/classes']], [], [], []],
    'App\Controller\ClasseController::updateClasse' => [['id'], ['_controller' => 'App\\Controller\\ClasseController::updateClasse'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/classes']], [], [], []],
    'App\Controller\CoursController::getAllCours' => [[], ['_controller' => 'App\\Controller\\CoursController::getAllCours'], [], [['text', '/api/cours']], [], [], []],
    'App\Controller\CoursController::getCourDetail' => [['id'], ['_controller' => 'App\\Controller\\CoursController::getCourDetail'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/cours']], [], [], []],
    'App\Controller\CoursController::deleteCours' => [['id'], ['_controller' => 'App\\Controller\\CoursController::deleteCours'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/cours']], [], [], []],
    'App\Controller\CoursController::createCours' => [[], ['_controller' => 'App\\Controller\\CoursController::createCours'], [], [['text', '/api/cours']], [], [], []],
    'App\Controller\CoursController::updateCours' => [['id'], ['_controller' => 'App\\Controller\\CoursController::updateCours'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/cours']], [], [], []],
    'App\Controller\EcoleController::getAllEcoles' => [[], ['_controller' => 'App\\Controller\\EcoleController::getAllEcoles'], [], [['text', '/api/ecoles']], [], [], []],
    'App\Controller\EcoleController::getEcoleDetail' => [['id'], ['_controller' => 'App\\Controller\\EcoleController::getEcoleDetail'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/ecoles']], [], [], []],
    'App\Controller\EcoleController::deleteEcole' => [['id'], ['_controller' => 'App\\Controller\\EcoleController::deleteEcole'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/ecoles']], [], [], []],
    'App\Controller\EcoleController::createEcole' => [[], ['_controller' => 'App\\Controller\\EcoleController::createEcole'], [], [['text', '/api/ecoles']], [], [], []],
    'App\Controller\EcoleController::updateEcole' => [['id'], ['_controller' => 'App\\Controller\\EcoleController::updateEcole'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/ecoles']], [], [], []],
    'App\Controller\EnfantController::getAllEnfants' => [[], ['_controller' => 'App\\Controller\\EnfantController::getAllEnfants'], [], [['text', '/api/enfants']], [], [], []],
    'App\Controller\EnfantController::getEnfantDetail' => [['id'], ['_controller' => 'App\\Controller\\EnfantController::getEnfantDetail'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/enfants']], [], [], []],
    'App\Controller\EnfantController::deleteEnfant' => [['id'], ['_controller' => 'App\\Controller\\EnfantController::deleteEnfant'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/enfants']], [], [], []],
    'App\Controller\EnfantController::createEnfant' => [[], ['_controller' => 'App\\Controller\\EnfantController::createEnfant'], [], [['text', '/api/enfants']], [], [], []],
    'App\Controller\EnfantController::updateEnfant' => [['id'], ['_controller' => 'App\\Controller\\EnfantController::updateEnfant'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/enfants']], [], [], []],
    'App\Controller\MessageController::getAllMessages' => [[], ['_controller' => 'App\\Controller\\MessageController::getAllMessages'], [], [['text', '/api/messages']], [], [], []],
    'App\Controller\MessageController::getMessageDetail' => [['id'], ['_controller' => 'App\\Controller\\MessageController::getMessageDetail'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/messages']], [], [], []],
    'App\Controller\MessageController::deletemessage' => [['id'], ['_controller' => 'App\\Controller\\MessageController::deletemessage'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/messages']], [], [], []],
    'App\Controller\MessageController::createMessage' => [[], ['_controller' => 'App\\Controller\\MessageController::createMessage'], [], [['text', '/api/messages']], [], [], []],
    'App\Controller\MessageController::updateMessage' => [['id'], ['_controller' => 'App\\Controller\\MessageController::updateMessage'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/messages']], [], [], []],
    'App\Controller\MessagerieController::getAllMessageries' => [[], ['_controller' => 'App\\Controller\\MessagerieController::getAllMessageries'], [], [['text', '/api/messageries']], [], [], []],
    'App\Controller\MessagerieController::getMessagerieDetail' => [['id'], ['_controller' => 'App\\Controller\\MessagerieController::getMessagerieDetail'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/messageries']], [], [], []],
    'App\Controller\MessagerieController::deleteMessagerie' => [['id'], ['_controller' => 'App\\Controller\\MessagerieController::deleteMessagerie'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/messageries']], [], [], []],
    'App\Controller\MessagerieController::createMessagerie' => [[], ['_controller' => 'App\\Controller\\MessagerieController::createMessagerie'], [], [['text', '/api/messageries']], [], [], []],
    'App\Controller\MessagerieController::updateMessagerie' => [['id'], ['_controller' => 'App\\Controller\\MessagerieController::updateMessagerie'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/messageries']], [], [], []],
    'App\Controller\RessourceController::getAllRessources' => [[], ['_controller' => 'App\\Controller\\RessourceController::getAllRessources'], [], [['text', '/api/ressources']], [], [], []],
    'App\Controller\RessourceController::getRessourceDetail' => [['id'], ['_controller' => 'App\\Controller\\RessourceController::getRessourceDetail'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/ressources']], [], [], []],
    'App\Controller\RessourceController::deleteRessource' => [['id'], ['_controller' => 'App\\Controller\\RessourceController::deleteRessource'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/ressources']], [], [], []],
    'App\Controller\RessourceController::createRessource' => [[], ['_controller' => 'App\\Controller\\RessourceController::createRessource'], [], [['text', '/api/ressources']], [], [], []],
    'App\Controller\RessourceController::updateRessource' => [['id'], ['_controller' => 'App\\Controller\\RessourceController::updateRessource'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/ressources']], [], [], []],
];
