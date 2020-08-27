<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;


    protected $table = 'cliente';


    protected $fillables = [
        'nome',
        'dominio',
        'versao',
        'link_acesso',
        'status',

    ];
    protected $dates = ['deleted_at'];
}
