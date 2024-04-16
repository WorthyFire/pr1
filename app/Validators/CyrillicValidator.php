<?php


namespace Validators;

use Src\Validator\AbstractValidator;

class CyrillicValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно быть заполнено только на Русском языке';

    public function rule(): bool
    {
        // Проверяем, содержит ли значение только кириллические символы
        return preg_match('/^\p{Cyrillic}+$/u', $this->value);
    }
}