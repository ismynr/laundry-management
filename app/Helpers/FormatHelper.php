<?php 

namespace App\Helpers;

class FormatHelper{

    public static function rupiah($angka)
    {
        $hasil_rupiah = "Rp. " . number_format($angka,0,'','.');
        return $hasil_rupiah;
    }

    public static function revertRupiah($angka)
    {
        return str_replace(['Rp. ', '.'], '', $angka);
    }
}
