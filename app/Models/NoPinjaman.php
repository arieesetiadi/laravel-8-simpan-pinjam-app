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

    // Methods
    public static function generateNoPinjaman()
    {
        $no = str_pad(self::count() + 1, 3, '0', STR_PAD_LEFT);
        $context = 'SPK';
        $company = 'BUMDES';
        $month = month_to_roman(now()->month);
        $year = now()->year;

        return "$no/$context/$company/$month/$year";
    }
}
