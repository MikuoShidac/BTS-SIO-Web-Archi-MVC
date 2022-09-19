<?php

namespace Quizz\Controller\Questionnaire;

use Quizz\Core\Controller\ControllerInterface;
use Quizz\Core\View\TwigCore;
use Quizz\Model\EtudiantModel;

class ConfigController implements ControllerInterface
{
    private $id;
    private $POST;

    public function inputRequest(array $tabInput)
    {
        if (isset($tabInput["VARS"]["id"])){
            $this->id = $tabInput["VARS"]["id"];

        }
        if (!empty($tabInput["POST"])){
            $this->POST = $tabInput["POST"];
            $etudiantModel = new EtudiantModel();
            $etudiantModel->updateEtudiant($this->id,$this->POST["nom"]
                ,$this->POST["prenom"]);
        }
    }

    public function outputEvent()
    {
        $etudiantModel = new EtudiantModel();

        if (isset($this->id)){
            return TwigCore::getEnvironment()->render(
                'questionnaire/config.html.twig',[
                    'etudiant' => $etudiantModel->getFetchId((int) $this->id)
                ]);
        } else {
            return null;
        }
    }
}