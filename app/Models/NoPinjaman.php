<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoPinjaman extends Model
{
    use HasFactory;

    protected $table = 'no_pinjaman';
    protected $primaryKey = 'id_pinjaman';
    protected $guarded = [];

    public $timestamps = false;

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'id_nasabah', 'id_nasabah');
    }
}
