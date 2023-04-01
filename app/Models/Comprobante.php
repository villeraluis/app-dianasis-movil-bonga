<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    // use HasFactory;
    protected $table = 'comprobantes';
    protected $primaryKey = 'comcodi';
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
}
