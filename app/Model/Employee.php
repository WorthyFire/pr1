<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $primaryKey = 'EmployeeID';
    protected $table = 'employees'; // Указываем имя таблицы, с которой связана модель

    public $timestamps = false;

    // Остальные свойства и методы модели...

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class, 'employeepositioncheck', 'EmployeeID', 'PositionID');
    }

    public function departmentsCheck(): HasMany
    {
        return $this->hasMany(EmployeePositionCheck::class,  'DepartmentID', 'DepartmentID');
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'employeedepartmentcheck', 'EmployeeID', 'DepartmentID');
    }
}
