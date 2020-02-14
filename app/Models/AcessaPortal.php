<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcessaPortal extends Model
{
    protected $table = 'TBL_PERFIS_ACESSO_PORTAL';
    protected $primaryKey = 'matricula';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = ['matricula', 'nivelAcesso', 'unidade'];

    public function empregados()
    {
        return $this->belongsTo('App\Models\Empregado', 'matricula', 'matricula');
    }
}