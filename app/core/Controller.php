<?php
namespace App\Core;

class Controller {
    // Метод для рендеринга представления
    protected function view($viewName, $data = []) {
        // Извлекаем переменные из массива $data, чтобы они были доступны в view как обычные переменные
        extract($data);
        
        $viewFile = __DIR__ . '/../views/' . $viewName . '.php';
        
        ob_start();
        
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            throw new \Exception("Представление не найдено: $viewFile");
        }

        $content = ob_get_clean();

        if (!isset($pageTitle)){
            $pageTitle = "LabBack";
        }

        if (isset($pageName)){
            $parts = explode('/', $viewName);
            $pageName = end($parts);
        }

        $layoutFile = __DIR__ . '/../views/layouts/main.php';

        if(file_exists($layoutFile)){
            require $layoutFile;
        }
        else {
            echo $content;
        }
    }
}