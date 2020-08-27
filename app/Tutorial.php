<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tutorial extends Model
{
    use SoftDeletes;

    protected $table = 'tutorial';

    protected $fillable = [
        'sub_categoria_id',
        'cliente_id',
        'titulo',
        'path_foto',
        'link_video',
        'observacao',
        'passo_numero',
        'status'
    ];
}
