<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoTabungan extends Model
{
    use HasFactory;

    protected $table = 'no_tabungan';
    protected $primaryKey = 'id_tabungan';
    protected $guarded = [];

    public $timestamps = false;

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'id_nasabah', 'id_nasabah');
    }

    public function kas()
    {
        return $this->hasOne(Kas::class, 'id_tabungan', 'id_tabungan');
    }
}
