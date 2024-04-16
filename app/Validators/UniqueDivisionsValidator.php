<?php

namespace Validators;

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Validator\AbstractValidator;
use Model\Department;

class UniqueDivisionsValidator extends AbstractValidator
{
    protected string $message = 'Подразделение с таким названием уже существует';

    public function rule(): bool
    {
        $departmentName = $this->value;

        // Проверяем, существует ли подразделение с таким именем
        $existingDepartment = Department::where('name', $departmentName)->exists();

        // Возвращаем результат валидации (true - если подразделение уникально, false - если уже существует)
        return !$existingDepartment;
    }
    public function fails(): bool
    {
        return !empty($this->errors);
    }


}
