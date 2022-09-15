<?php

namespace Quizz\Controller\Questionnaire;
use Quizz\Core\Controller\ControllerInterface;
use Quizz\Model\questionnaireModel;
use Quizz\Service\TwigService;

class BenoitController implements ControllerInterface
{

    public function inputRequest(array $tabInput)
    {
        // TODO: Implement inputRequest() method.
    }

    public function outputEvent()
    {
        $twig = TwigService::getEnvironment();
        $questionnaireModel = new questionnaireModel();
        echo $twig->render('questionnaire/benoit.html.twig',[
            'result' => $questionnaireModel->getFechAll(),
            'visu' => false
        ]);
    }
}