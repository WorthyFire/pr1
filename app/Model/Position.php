<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'positions';
    protected $primaryKey = 'PositionID';
    public $timestamps = false;

    // Остальные связи, методы и функции могут быть добавлены здесь
}
