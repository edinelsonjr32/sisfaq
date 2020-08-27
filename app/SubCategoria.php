<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategoria extends Model
{
    use SoftDeletes;
    protected $table = 'sub_categoria';
    protected $fillble = ['nome', 'status', 'categoria_id'];


}
