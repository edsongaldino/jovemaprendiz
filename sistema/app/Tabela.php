<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tabela extends Model
{
    protected $table = 'tabelas';
    use SoftDeletes;
}
