<?php 

namespace App\Traits;

trait OtherFUnc
{
    public function rupiah($number)
    {
        return number_format($number,0,'','.');
    }
}

