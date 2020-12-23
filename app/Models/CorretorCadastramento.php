<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorretorCadastramento extends Model
{
    protected $table = 'TBL_CORRETORES_CADASTRAMENTO';
    protected $primaryKey = 'idProcesso';
    protected $fillable = [
         'credenciado'
        ,'CNPJ'
        ,'CPF'
        ,'Representante'
        ,'numeroContrato'
        ,'dataConvoc'
        ,'contratoDevolvido'
        ,'endereço'
        ,'email'
        ,'obs'
        ,'SICAF'];
}