<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments'; // Указываем имя таблицы в базе данных

    // Определяем, какие атрибуты можно массово присваивать
    protected $fillable = ['name', 'type'];
    public $timestamps = false;



    // Дополнительные методы и свойства класса, если необходимо
}
