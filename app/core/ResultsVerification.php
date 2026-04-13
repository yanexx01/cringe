<?php
namespace App\Core;

class ResultsVerification extends CustomFormValidation
{
    private int $score = 0;
    private int $total = 3;

    public function checkAnswers(array $data): int
    {
        $this->score = 0;

        // ❗ правильные ответы (под твою форму)
        $correctAnswers = [
            'q2' => 'Б',
            'q3' => 'phys_chem'
        ];

        // проверка radio
        foreach ($correctAnswers as $key => $correct) {
            if (isset($data[$key]) && $data[$key] === $correct) {
                $this->score++;
            }
        }

        // текстовый вопрос (q1)
        if (!empty($data['q1'])) {
            // простая проверка (можно усложнить)
            if (mb_strlen($data['q1']) > 10) {
                $this->score++;
            }
        }

        return $this->score;
    }

    public function getResultHtml(): string
    {
        return "<div class='alert alert-success'>
                    <h3>Результат теста</h3>
                    <p>Ваш счет: <strong>{$this->score}</strong> из {$this->total}</p>
                </div>";
    }
}