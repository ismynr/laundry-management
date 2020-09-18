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

    public static function hari($date){
        $hari = date ("D", strtotime($date));
    
        switch($hari){
            case 'Sun': $hari_ini = "Minggu";break;
            case 'Mon':	$hari_ini = "Senin";break;
            case 'Tue': $hari_ini = "Selasa";break;
            case 'Wed': $hari_ini = "Rabu";break;
            case 'Thu': $hari_ini = "Kamis";break;
            case 'Fri': $hari_ini = "Jumat";break;
            case 'Sat': $hari_ini = "Sabtu";break;
            default: $hari_ini = "Tidak di ketahui"; break;
        }
        return $hari_ini.', '.date('d-m-Y', strtotime($date));
    }

    public static function tanggal($tanggal){
        $tanggal = date ("Y-m-d", strtotime($tanggal));
        $bulan = array (
            1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei',
            'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }

    public static function hari_tanggal($tanggal){
        $tanggal = date ("Y-m-d", strtotime($tanggal));
        $bulan = array (
            1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei',
            'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );

        $hari = date ("D", strtotime($tanggal));
        switch($hari){
            case 'Sun': $hari_ini = "Minggu";break;
            case 'Mon':	$hari_ini = "Senin";break;
            case 'Tue': $hari_ini = "Selasa";break;
            case 'Wed': $hari_ini = "Rabu";break;
            case 'Thu': $hari_ini = "Kamis";break;
            case 'Fri': $hari_ini = "Jumat";break;
            case 'Sat': $hari_ini = "Sabtu";break;
            default: $hari_ini = "Tidak di ketahui"; break;
        }

        $pecahkan = explode('-', $tanggal);
        return $hari_ini . ', ' . $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
}
