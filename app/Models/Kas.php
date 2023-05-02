<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;

    protected $table = 'kas';
    protected $primaryKey = 'id_kas';
    protected $guarded = [];

    public $timestamps = false;

    public function tabungan()
    {
        return $this->belongsTo(NoTabungan::class, 'id_tabungan', 'id_tabungan');
    }
}
