<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/doc.json' => [[['_route' => 'app.swagger', '_controller' => 'nelmio_api_doc.controller.swagger'], null, ['GET' => 0], null, false, false, null]],
        '/api/doc' => [[['_route' => 'app.swagger_ui', '_controller' => 'nelmio_api_doc.controller.swagger_ui'], null, ['GET' => 0], null, false, false, null]],
        '/api/activites' => [
            [['_route' => 'app_activite', '_controller' => 'App\\Controller\\ActiviteController::getAllActivites'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'createActivite', '_controller' => 'App\\Controller\\ActiviteController::createActivite'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/classes' => [
            [['_route' => 'classe', '_controller' => 'App\\Controller\\ClasseController::getAllClasses'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'createClasse', '_controller' => 'App\\Controller\\ClasseController::createClasse'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/cours' => [
            [['_route' => 'app_cours', '_controller' => 'App\\Controller\\CoursController::getAllCours'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'createCours', '_controller' => 'App\\Controller\\CoursController::createCours'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/ecoles' => [
            [['_route' => 'ecoles', '_controller' => 'App\\Controller\\EcoleController::getAllEcoles'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'createEcole', '_controller' => 'App\\Controller\\EcoleController::createEcole'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/enfants' => [
            [['_route' => 'enfant', '_controller' => 'App\\Controller\\EnfantController::getAllEnfants'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'createEnfant', '_controller' => 'App\\Controller\\EnfantController::createEnfant'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/messages' => [
            [['_route' => 'message', '_controller' => 'App\\Controller\\MessageController::getAllMessages'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'createmessage', '_controller' => 'App\\Controller\\MessageController::createMessage'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/messageries' => [
            [['_route' => 'messageries', '_controller' => 'App\\Controller\\MessagerieController::getAllMessageries'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'createMessagerie', '_controller' => 'App\\Controller\\MessagerieController::createMessagerie'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/register' => [[['_route' => 'register', '_controller' => 'App\\Controller\\RegisterController::register'], null, ['POST' => 0], null, false, false, null]],
        '/api/ressources' => [
            [['_route' => 'app_ressource', '_controller' => 'App\\Controller\\RessourceController::getAllRessources'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'createRessource', '_controller' => 'App\\Controller\\RessourceController::createRessource'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/users' => [[['_route' => 'users', '_controller' => 'App\\Controller\\UserController::getAllUsers'], null, ['GET' => 0], null, false, false, null]],
        '/api/login_check' => [[['_route' => 'api_login_check'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/(?'
                    .'|activites/([^/]++)(?'
                        .'|(*:71)'
                    .')'
                    .'|c(?'
                        .'|lasses/([^/]++)(?'
                            .'|(*:101)'
                        .')'
                        .'|ours/([^/]++)(?'
                            .'|(*:126)'
                        .')'
                    .')'
                    .'|e(?'
                        .'|coles/([^/]++)(?'
                            .'|(*:157)'
                        .')'
                        .'|nfants/([^/]++)(?'
                            .'|(*:184)'
                        .')'
                    .')'
                    .'|message(?'
                        .'|s/([^/]++)(?'
                            .'|(*:217)'
                        .')'
                        .'|ries/([^/]++)(?'
                            .'|(*:242)'
                        .')'
                    .')'
                    .'|ressources/([^/]++)(?'
                        .'|(*:274)'
                    .')'
                    .'|users/(?'
                        .'|([^/]++)(?'
                            .'|(*:303)'
                        .')'
                        .'|email/([^/]++)(*:326)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        71 => [
            [['_route' => 'detailActivite', '_controller' => 'App\\Controller\\ActiviteController::getActiviteDetail'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'deleteActivite', '_controller' => 'App\\Controller\\ActiviteController::deleteActivite'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'updateActivite', '_controller' => 'App\\Controller\\ActiviteController::updateActivite'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        101 => [
            [['_route' => 'detailClasse', '_controller' => 'App\\Controller\\ClasseController::getClasseDetail'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'deleteClasse', '_controller' => 'App\\Controller\\ClasseController::deleteClasse'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'updateClasse', '_controller' => 'App\\Controller\\ClasseController::updateClasse'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        126 => [
            [['_route' => 'detailCour', '_controller' => 'App\\Controller\\CoursController::getCourDetail'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'deleteCours', '_controller' => 'App\\Controller\\CoursController::deleteCours'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'updateCours', '_controller' => 'App\\Controller\\CoursController::updateCours'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        157 => [
            [['_route' => 'detailEcole', '_controller' => 'App\\Controller\\EcoleController::getEcoleDetail'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'deleteEcole', '_controller' => 'App\\Controller\\EcoleController::deleteEcole'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'updateEcole', '_controller' => 'App\\Controller\\EcoleController::updateEcole'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        184 => [
            [['_route' => 'detailEnfant', '_controller' => 'App\\Controller\\EnfantController::getEnfantDetail'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'deleteEnfant', '_controller' => 'App\\Controller\\EnfantController::deleteEnfant'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'updateEnfant', '_controller' => 'App\\Controller\\EnfantController::updateEnfant'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        217 => [
            [['_route' => 'detailmessage', '_controller' => 'App\\Controller\\MessageController::getMessageDetail'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'deletemessage', '_controller' => 'App\\Controller\\MessageController::deletemessage'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'updatemessage', '_controller' => 'App\\Controller\\MessageController::updateMessage'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        242 => [
            [['_route' => 'detailMessagerie', '_controller' => 'App\\Controller\\MessagerieController::getMessagerieDetail'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'deleteMessagerie', '_controller' => 'App\\Controller\\MessagerieController::deleteMessagerie'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'updatemessagerie', '_controller' => 'App\\Controller\\MessagerieController::updateMessagerie'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        274 => [
            [['_route' => 'detailRessource', '_controller' => 'App\\Controller\\RessourceController::getRessourceDetail'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'deleteRessource', '_controller' => 'App\\Controller\\RessourceController::deleteRessource'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'updateRessource', '_controller' => 'App\\Controller\\RessourceController::updateRessource'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        303 => [
            [['_route' => 'detailUser', '_controller' => 'App\\Controller\\UserController::getUserDetails'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'deleteUser', '_controller' => 'App\\Controller\\UserController::deleteUser'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'updateUser', '_controller' => 'App\\Controller\\UserController::updateUser'], ['id'], ['PUT' => 0], null, false, true, null],
        ],
        326 => [
            [['_route' => 'getUserByEmail', '_controller' => 'App\\Controller\\UserController::getUserByEmail'], ['email'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
