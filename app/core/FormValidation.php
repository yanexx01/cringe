<?php
namespace App\Core;

class FormValidation
{
    private array $rules = [];
    private array $errors = [];

    public function setRule(string $fieldName, string $validatorName): void
    {
        if (!isset($this->rules[$fieldName])) {
            $this->rules[$fieldName] = [];
        }
        $this->rules[$fieldName][] = $validatorName;
    }

    private function isNotEmpty($data): ?string
    {
        if (empty(trim($data))) {
            return "Поле не должно быть пустым.";
        }
        return null;
    }

    private function isInteger($data): ?string
    {
        if (!is_numeric($data) || intval($data) != $data) {
            return "Значение должно быть целым числом.";
        }
        return null;
    }

    private function isLess($data, $value): ?string
    {
        if (!is_numeric($data)) return "Значение должно быть числом.";
        if ($data < $value) {
            return "Значение должно быть не меньше {$value}.";
        }
        return null;
    }

    private function isGreater($data, $value): ?string
    {
        if (!is_numeric($data)) return "Значение должно быть числом.";
        if ($data > $value) {
            return "Значение должно быть не больше {$value}.";
        }
        return null;
    }

    private function isEmail($data): ?string
    {
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return "Некорректный формат Email.";
        }
        return null;
    }

    public function validate(array $postData): bool
    {
        $this->errors = [];

        foreach ($this->rules as $field => $validators) {
            $value = $postData[$field] ?? '';

            foreach ($validators as $validator) {
                $params = explode(':', $validator);
                $methodName = $params[0];
                $paramValue = isset($params[1]) ? $params[1] : null;

                if (method_exists($this, $methodName)) {
                    $errorMsg = ($paramValue !== null) 
                        ? $this->$methodName($value, $paramValue) 
                        : $this->$methodName($value);

                    if ($errorMsg !== null) {
                        $this->errors[$field][] = $errorMsg;
                    }
                }
            }
        }

        return empty($this->errors);
    }

    public function showErrors(): string
    {
        if (empty($this->errors)) {
            return '';
        }

        $html = '<div class="validation-errors" style="color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px; margin-bottom: 20px;">';
        $html .= '<h4 style="margin-top:0;">Обнаружены ошибки:</h4><ul style="margin-bottom:0; padding-left: 20px;">';
        
        foreach ($this->errors as $field => $messages) {
            foreach ($messages as $msg) {
                $label = ucfirst($field); 
                $html .= "<li><strong>{$label}:</strong> {$msg}</li>";
            }
        }
        
        $html .= '</ul></div>';
        return $html;
    }
    
    public function getErrors(): array
    {
        return $this->errors;
    }
}