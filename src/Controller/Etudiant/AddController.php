<?php

namespace Quizz\Controller\Etudiant;

use Quizz\Core\Controller\ControllerInterface;
use Quizz\Core\View\TwigCore;
use Quizz\Model\EtudiantModel;

class AddController implements ControllerInterface
{
    private $POST;
    private $success;

    public function inputRequest(array $tabInput)
    {
        $this->success = false;

        if (!empty($tabInput["POST"])){
            $this->POST = $tabInput["POST"];
            $option = ['cost'=> 5];
            $pwd = password_hash($this->POST["mdp"],PASSWORD_BCRYPT,$option);
            $etudiantModel = new EtudiantModel();
            $etudiantModel->createEtudiant($this->POST["login"],$this->POST["nom"], $this->POST["prenom"],$this->POST["email"],$pwd);
            $this->success=true;
        }
        if ($this->success == true){
            header('Location:/etudiant');
        }else{
            return TwigCore::getEnvironment()->render('etudiants/add.html.twig');
        }
    }

    public function outputEvent()
    {
        return TwigCore::getEnvironment()->render('etudiants/add.html.twig',[]);
    }
}