<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    protected $table = 'categoria';
    protected $fillable = [
        'nome',
        'status',
        'cliente_id'
    ];
}
