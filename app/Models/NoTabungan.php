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

    // Relations
    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'id_nasabah', 'id_nasabah');
    }

    public function kas()
    {
        return $this->hasOne(Kas::class, 'id_tabungan', 'id_tabungan');
    }

    // Methods
    public static function generateNoTabungan()
    {
        $no = str_pad(self::count() + 1, 3, '0', STR_PAD_LEFT);
        $company = 'BUMDES';
        $month = month_to_roman(now()->month);
        $year = now()->year;

        return "$no/$company/$month/$year";
    }
}
