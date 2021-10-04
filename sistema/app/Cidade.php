<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table = 'cidades';

	public function estado()
    {
        return $this->hasOne(Estado::class, 'id', 'estado_id');
    }
}
