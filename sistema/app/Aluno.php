<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $table = 'alunos';
    use SoftDeletes;

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id', 'endereco_id');
    }

    public function polo()
    {
        return $this->hasOne(Polo::class, 'id', 'polo_id');
    }

    public function conjuge()
    {
        return $this->hasOne(Conjuge::class, 'aluno_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function verificaDuplicidade($campo, $valor){

        $dup = $this::where($campo, $valor)->first();

        if(isset($dup)){
            return $dup;
        }else{
            return false;
        }
    }

}
