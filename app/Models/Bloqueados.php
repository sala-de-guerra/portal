<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bloqueados extends Model
{
    protected $table = 'TBL_PROPONENTES_BLOQUEADOS';
    protected $fillable = ['Nome','CPF_CNPJ','UF','email','CPF_CONJUGE','NOME_CONJUGE'];
    public $timestamps = false;

}