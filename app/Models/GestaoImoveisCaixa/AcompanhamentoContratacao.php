<?php

namespace App\Models\GestaoImoveisCaixa;

use Illuminate\Database\Eloquent\Model;

class AcompanhamentoContratacao extends Model
{
    protected $table = 'TBL_ACOMPANHAMENTO_CONTRATACAO';
    protected $primaryKey = 'idAcompanhamentoContratacao';
    public $timestamps = false;
}
