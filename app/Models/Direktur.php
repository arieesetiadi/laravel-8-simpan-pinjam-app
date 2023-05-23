<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Direktur extends Authenticatable
{
    use HasFactory;

    protected $table = 'direktur';
    protected $primaryKey = 'id_direktur';
    protected $guarded = [];

    public $timestamps = false;
}
