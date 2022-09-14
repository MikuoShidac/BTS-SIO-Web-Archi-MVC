<?php

namespace Quizz\Core\Controller;

use FastRoute\Dispatcher;
use Quizz\Controller\Error\HttpController;

class FastRouteCore
{
    public static function getDispatcher($dispatcher) {

        // Recupere la method et l'url(uri) from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) //$pos est instansier dans le if
            {  $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) //en fonction de ce qu'il se passe ca switch
        {
            case Dispatcher::NOT_FOUND: //va chercher l'erreur 404
                $httpController = new HttpController();
                return $httpController->outputEvent();
            case Dispatcher::METHOD_NOT_ALLOWED:  //on doit creer la page de l'erreur 405
                $allowedMethods = $routeInfo[1];
                // TODO mettre les erreurs
                // ... 405 Method Not Allowed
                break;
            case Dispatcher::FOUND:  //va chercher l'url et affiche sa page
                $handler = $routeInfo[1];
                //handler = url non connu a l'avance donc dynamique
                $exeController = new $handler(); // -> Creation du controller correspondant à la demande
                $exeController->inputRequest(["GET" => $_GET, "POST" => $_POST, "VARS" => $routeInfo[2]]);
                return $exeController->outputEvent();
        }
    }
}