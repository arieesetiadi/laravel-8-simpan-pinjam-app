<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengawas extends Authenticatable
{
    use HasFactory;

    protected $table = 'pengawas';
    protected $primaryKey = 'id_pengawas';
    protected $guarded = [];

    public $timestamps = false;
}
