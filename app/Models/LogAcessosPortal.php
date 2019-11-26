<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAcessosPortal extends Model
{
    protected $table = 'TBL_PORTAL_LOG_ACESSOS';
    protected $primaryKey = 'idLog';
    public $timestamps = false;
}