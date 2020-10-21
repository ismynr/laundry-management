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

    public static function hariIni(){
        $hari = date ("D");
    
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
        return $hari_ini;
    }

    public static function bulanIni(){
        $tanggal = date ("Y-m-d");
        $bulan = array (
            1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei',
            'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        return $bulan[ (int)$pecahkan[1] ];
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

    public static function timeAgo($time_ago){
        // date_default_timezone_set('Asia/Jakarta');
        $time_ago = strtotime($time_ago);
        $cur_time   = time();
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60 );
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400 );
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640 );
        $years      = round($time_elapsed / 31207680 );
        // Seconds
        if($seconds <= 60){
            return "baru saja";
        }
        //Minutes
        else if($minutes <=60){
            if($minutes==1){
                return "one minute ago";
            }
            else{
                return "$minutes minutes ago";
            }
        }
        //Hours
        else if($hours <=24){
            if($hours==1){
                return "one hour ago";
            }else{
                return "$hours hours ago";
            }
        }
        //Days
        else if($days <= 7){
            if($days==1){
                return "tomorrow";
            }else{
                return "$days days ago";
            }
        }
        //Weeks
        else if($weeks <= 4.3){
            if($weeks==1){
                return "one week ago";
            }else{
                return "$weeks weeks ago";
            }
        }
        //Months
        else if($months <=12){
            if($months==1){
                return "one month ago";
            }else{
                return "$months months ago";
            }
        }
        else if($years >= 49){
            return "never logged in";
        }
        //Years
        else{
            if($years==1){
                return "one year ago";
            }else{
                return "$years years ago";
            }
        }
    }
}
