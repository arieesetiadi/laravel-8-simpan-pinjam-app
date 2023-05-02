<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanPinjam extends Model
{
    use HasFactory;

    protected $table = 'permohonan_pinjam';
    protected $primaryKey = 'id_permohonan_pinjam';
    protected $guarded = [];

    public $timestamps = false;
}
