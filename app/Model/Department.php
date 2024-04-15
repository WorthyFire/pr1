<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments'; // Указываем имя таблицы в базе данных

    protected $primaryKey = 'DepartmentID'; // Указываем первичный ключ

    protected $fillable = ['Name', 'Type']; // Указываем поля, доступные для массового заполнения

    public $timestamps = false;


}
