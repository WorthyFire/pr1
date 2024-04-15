<?php

namespace Model;
;

use Illuminate\Database\Eloquent\Model;

class EmployeePositionCheck extends Model
{
    protected $table = 'employeepositioncheck';

    public $timestamps = false;


    protected $fillable = [
        'EmployeeID',
        'PositionID',
    ];
}
