<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\ResultsVerification;

class TestController extends Controller {

    public function indexAction()
    {
        $errorsHtml = '';
        $resultHtml = '';
        $oldInput = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $oldInput = $_POST;

            $validator = new ResultsVerification();

            if ($validator->validateTest($_POST)) {

                $validator->checkAnswers($_POST);
                $resultHtml = $validator->getResultHtml();

                $oldInput = [];
            } else {
                $errorsHtml = $validator->showErrors();
            }
        }

        $this->view('test/index', [
            'title' => 'Тест по БЖД',
            'errorsHtml' => $errorsHtml,
            'resultHtml' => $resultHtml,
            'oldInput' => $oldInput
        ]);
    }
}