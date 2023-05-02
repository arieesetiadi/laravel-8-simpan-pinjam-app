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
}
