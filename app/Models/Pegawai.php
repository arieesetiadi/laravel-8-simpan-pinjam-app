<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pegawai extends Authenticatable
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';
    protected $guarded = [];

    public $timestamps = false;

    public function nasabah(){
        return $this->hasMany(Nasabah::class, 'id_pegawai', 'id_pegawai');
    }
}
