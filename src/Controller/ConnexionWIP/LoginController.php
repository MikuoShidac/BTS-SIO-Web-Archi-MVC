<?php

namespace Quizz\Controller\ConnexionWIP;

use Quizz\Core\Controller\ControllerInterface;
use Quizz\Core\Service\DatabaseService;
use Quizz\Service\TwigService;

class LoginController implements ControllerInterface
{

    public function inputRequest(array $tabInput)
    {
        $twig = TwigService::getEnvironment();
        $connexion = DatabaseService::getConnect();
        if(isset($_POST["username"]) and $_POST["pass"]){
            $recupUser = $connexion->prepare('select * from etudiants where login=? and mdp=?');
            $recupUser->execute(array($_POST["username"],$_POST["pass"]));

            if ($recupUser->rowCount() > 0){
                $_SESSION['username'] = $_POST["username"];
                header("Location: /");
            }else{
                echo $twig->render('login.html.twig',[
                    'errorauth' => true
                ]);
            }
        }
    }

    public function outputEvent()
    {
        //récupère le visuel de la page
        $twig = TwigService::getEnvironment();
        echo $twig->render('etudiants/login.html.twig',[]);
    }
}