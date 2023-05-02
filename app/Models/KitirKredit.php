<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitirKredit extends Model
{
    use HasFactory;

    protected $table = 'kitir_kredit';
    protected $primaryKey = 'id_kitir';
    protected $guarded = [];

    public $timestamps = false;
}
