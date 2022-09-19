<?php

namespace Quizz\Controller\Questionnaire;

use Quizz\Core\Controller\ControllerInterface;
use Quizz\Core\View\TwigCore;
use Quizz\Model\EtudiantModel;

class AddController implements ControllerInterface
{
    private $POST;

    public function inputRequest(array $tabInput)
    {
        if (!empty($tabInput["POST"])){
            $this->POST = $tabInput["POST"];
            $etudiantModel = new EtudiantModel();
            $etudiantModel->createEtudiant($this->POST["login"],$this->POST["nom"], $this->POST["prenom"],$this->POST["email"],$this->POST["mdp"]);
        }
    }

    public function outputEvent()
    {
        return TwigCore::getEnvironment()->render('questionnaire/add.html.twig',[]);
    }
}