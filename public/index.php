<?php

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Quizz\Core\Controller\FastRouteCore;

session_start();

// Gestion des fichiers environnement
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// Couche Controller
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/', 'Quizz\Controller\HomeController');
    $route->addRoute('GET', '/lword', 'Quizz\Controller\Questionnaire\LwordController');
    $route->addRoute('GET', '/lword/{benoit}', 'Quizz\Controller\Questionnaire\BenoitController');
    $route->addRoute('GET', '/lister', 'Quizz\Controller\Questionnaire\ListController');
    $route->addRoute('GET', '/detail/{id:\d+}', 'Quizz\Controller\Questionnaire\ViewController');

    $route->addRoute(['GET','POST'],'/etudiant', 'Quizz\Controller\Etudiant\EtudiantController');
    $route->addRoute(['GET','POST'],'/modifier/{id:\d+}', 'Quizz\Controller\Etudiant\ConfigController');
    $route->addRoute(['GET','POST'],'/delete/{id:\d+}', 'Quizz\Controller\Etudiant\DeleteController');
    $route->addRoute(['GET','POST'],'/ajouter', 'Quizz\Controller\Etudiant\AddController');

});
// Dispatcher -> Couche view
echo FastRouteCore::getDispatcher($dispatcher);

