<?php
namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller {
    
    public function indexAction() {
        // Здесь можно передать данные в представление
        $this->view('home/index', [
            'title' => 'Главная страница'
        ]);
    }

    public function aboutAction() {
        $this->view('home/about');
    }
    
    public function interestsAction() {
        $interestsModel = new \App\Models\Interest();
        $interestsCategories = $interestsModel->getCategories();
        $interestsData = $interestsModel->getInterests();
        $this->view('home/interests',[
            'categories' => $interestsCategories,
            'interests' => $interestsData
        ]);
    }

    public function photosAction() {
        $photoModel = new \App\Models\Photo();
        $photosData = $photoModel->getAll();
        $this->view('home/photos', [
            'photos' => $photosData
        ]);
    }
    
    public function studyAction() {
        $this->view('home/study');
    }

    public function historyAction() {
        $this->view('home/history');
    }

    public function contactsAction() 
    {
        $errorsHtml = '';
        $successMessage = '';
        $oldInput = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // echo '<pre>'; print_r($_POST); echo '</pre>'; exit; 
            $oldInput = $_POST; // Сохраняем введенные данные, чтобы вернуть их в форму
            
            $validator = new \App\Core\FormValidation();

            // Правила для формы контактов (согласно name="" в contacts.php)
            $validator->setRule('ФИО', 'isNotEmpty');
            $validator->setRule('Пол', 'isNotEmpty');
            $validator->setRule('Дата_рождения', 'isNotEmpty');
            $validator->setRule('Сообщение', 'isNotEmpty');
            $validator->setRule('Email', 'isNotEmpty');
            $validator->setRule('Email', 'isEmail');
            // Телефон опционален, но если заполнен, можно проверить формат (нужен доп. метод или regex)
            // Пока оставим только проверку на заполнение, если вдруг он станет обязательным
            // $validator->setRule('Контактный телефон', 'isNotEmpty'); 

            if ($validator->validate($_POST)) {
                // ВАЛИДАЦИЯ ПРОЙДЕНА
                // Здесь логика отправки письма или сохранения в БД
                $successMessage = "Спасибо, {$oldInput['ФИО']}! Ваше сообщение успешно отправлено.";
                $oldInput = []; // Очищаем форму после успешной отправки
            } else {
                // ЕСТЬ ОШИБКИ
                $errorsHtml = $validator->showErrors();
            }
        }

        $this->view('home/contacts', [
            'title' => 'Обратная связь',
            'errorsHtml' => $errorsHtml,
            'successMessage' => $successMessage,
            'oldInput' => $oldInput
        ]);
    }

    // public function testAction()
    // {
    //     // die('TEST ACTION WORKS');
    //     $errorsHtml = '';
    //     $resultHtml = '';
    //     $oldInput = [];

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $oldInput = $_POST;

    //         $validator = new \App\Core\ResultsVerification();

            
    //         $validator->setRule('fio', 'isNotEmpty');
    //         $validator->setRule('group', 'isNotEmpty');
    //         $validator->setRule('q1', 'isNotEmpty');
    //         $validator->setRule('q2', 'isNotEmpty'); 
    //         $validator->setRule('q3', 'isNotEmpty');

    //         if ($validator->validateTest($_POST)) {

    //             $validator->checkAnswers($_POST);
    //             $resultHtml = $validator->getResultHtml();

    //             $oldInput = [];
    //         } else {
    //             $errorsHtml = $validator->showErrors();
    //         }
    //     }

    //     $this->view('home/test', [
    //         'title' => 'Тест по БЖД',
    //         'errorsHtml' => $errorsHtml,
    //         'resultHtml' => $resultHtml,
    //         'oldInput' => $oldInput
    //     ]);
    // }
}