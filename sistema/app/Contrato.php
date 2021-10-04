<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrato extends Model
{
    protected $table = 'contratos';
    use SoftDeletes;

    protected $fillable = [
        'polo_id',
        'empresa_id',
        'aluno_id',
        'tabela_id',
        'data_inicial',
        'data_final',
        'status'
    ];

    public function polo()
    {
        return $this->belongsTo(Polo::class, 'polo_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    public function tabela()
    {
        return $this->belongsTo(Tabela::class, 'tabela_id');
    }

}
