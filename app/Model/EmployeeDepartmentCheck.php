<?php

namespace Model;
;

use Illuminate\Database\Eloquent\Model;

class EmployeeDepartmentCheck extends Model
{
    protected $table = 'employeedepartmentcheck';

    public $timestamps = false;


    protected $fillable = [
        'EmployeeID',
        'DepartmentID',
    ];
}
