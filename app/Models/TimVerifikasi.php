<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TimVerifikasi extends Authenticatable
{
    use HasFactory;

    protected $table = 'tim_verifikasi';
    protected $primaryKey = 'id_tim';
    protected $guarded = [];

    public $timestamps = false;
}
