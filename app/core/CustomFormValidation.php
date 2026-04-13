<?php
namespace App\Core;

class CustomFormValidation extends FormValidation
{
    public function validateTest(array $data): bool
    {
        // используем уже существующую систему правил
        $this->setRule('fio', 'isNotEmpty');
        $this->setRule('group', 'isNotEmpty');
        $this->setRule('q1', 'isNotEmpty');
        $this->setRule('q2', 'isNotEmpty');
        $this->setRule('q3', 'isNotEmpty');

        return $this->validate($data);
    }
}