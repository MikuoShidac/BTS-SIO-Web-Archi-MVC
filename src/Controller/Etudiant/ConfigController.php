<?php

namespace Quizz\Controller\Etudiant;

use Quizz\Core\Controller\ControllerInterface;
use Quizz\Core\View\TwigCore;
use Quizz\Model\EtudiantModel;

class ConfigController implements ControllerInterface
{
    private $id;
    private $POST;
    private $success;

    public function inputRequest(array $tabInput)
    {
        $this->success = false;
        if (isset($tabInput["VARS"]["id"])){
            $this->id = $tabInput["VARS"]["id"];

        }
        if (!empty($tabInput["POST"])){
            $this->POST = $tabInput["POST"];
            $etudiantModel = new EtudiantModel();
            $etudiantModel->updateEtudiant($this->POST["nom"]
                ,$this->POST["prenom"],$this->id);
            $this->success = true;
        }
        if ($this->success == true){
            header('Location:/etudiant');
        }else{
            return TwigCore::getEnvironment()->render('etudiants/config.html.twig');
        }
    }

    public function outputEvent()
    {
        $etudiantModel = new EtudiantModel();

        if (isset($this->id)){
            return TwigCore::getEnvironment()->render(
                'etudiants/config.html.twig',[
                    'etudiants' => $etudiantModel->getFetchId((int) $this->id)
                ]);
        } else {
            return null;
        }
    }
}