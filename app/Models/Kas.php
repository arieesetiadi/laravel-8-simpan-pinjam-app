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

    // Methods
    public static function getTotal()
    {
        $uangMasuk = self::where('jenis', 'Uang Masuk')->sum('total');
        $uangKeluar = self::where('jenis', 'Uang Keluar')->sum('total');
        $total = $uangMasuk - $uangKeluar;

        return $total;
    }
}
