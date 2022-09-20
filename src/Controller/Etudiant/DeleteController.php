<?php

namespace Quizz\Controller\Etudiant;

use Quizz\Core\Controller\ControllerInterface;
use Quizz\Core\View\TwigCore;
use Quizz\Model\EtudiantModel;

class DeleteController implements ControllerInterface
{
    private $id;
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
            $etudiantModel->deleteEtudiant($this->id);
            $this->success = true;
        }
        if ($this->success == true){
            header('Location:/etudiants');
        }else{
            return TwigCore::getEnvironment()->render('etudiants/delete.html.twig');
        }
    }

    public function outputEvent()
    {
        $etudiantModel = new EtudiantModel();

        if (isset($this->id)){
            return TwigCore::getEnvironment()->render(
                'etudiants/delete.html.twig',[
                    'etudiants' => $etudiantModel->getFetchId((int) $this->id)
                ]);

        }else{
            return null;
        }

    }
}