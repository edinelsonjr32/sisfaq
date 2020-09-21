<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemTutorial extends Model
{
    use SoftDeletes;
    protected $table = 'item_tutorial';

    protected $fillable = [
        'tutorial_id',
        'path_foto',
        'link_video',
        'observacao',
        'foto_principal'
    ];
}
