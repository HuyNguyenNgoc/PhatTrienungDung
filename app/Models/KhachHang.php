<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    protected $table = "khachhang";

    public function donDatHang(){
        return $this->hasMany('app\Models\DonDatHang','MaKH','MaKH');
    }

    public function hoaDon(){
        return $this->hasMany('app\Models\HoaDon','MaKH','MaKH');
    }
}
