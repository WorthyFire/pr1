<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees'; // Указываем имя таблицы, с которой связана модель

    public $timestamps = false;

    // Остальные свойства и методы модели...

    public function positions()
    {
        return $this->belongsToMany(Position::class, 'employeepositioncheck', 'EmployeeID', 'PositionID');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'employeedepartmentcheck', 'EmployeeID', 'DepartmentID');
    }

    public function employeeDepartmentCheck()
    {
        return $this->hasOne(EmployeeDepartmentCheck::class, 'EmployeeID');
    }
}
