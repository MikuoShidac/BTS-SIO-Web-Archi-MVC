<?php

namespace Quizz\Controller\Questionnaire;

use Quizz\Core\Controller\ControllerInterface;
use Quizz\Model\EtudiantModel;
use Quizz\Core\View\TwigCore;


class EtudiantController implements ControllerInterface
{

    public function inputRequest(array $tabInput)
    {
        // TODO: Implement inputRequest() method.
    }

    public function outputEvent()
    {
        $etudiantModel = new EtudiantModel();

            return TwigCore::getEnvironment()->render(
                'questionnaire/etudiant.html.twig',[
                'etudiants' => $etudiantModel->getFecthAll()
            ]);


    }
}