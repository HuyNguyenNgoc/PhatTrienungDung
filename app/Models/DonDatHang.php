<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonDatHang extends Model
{
    protected $table = "dondathang";

    public function chiTietDDH(){
        return $this->hasMany('app\Models\ChiTietDDH','MaDDH','MaDDH');
    }

    public function hoaDon(){
        return $this->hasMany('app\Models\HoaDon','MaDDH','MaDDH');
    }

    public function khachHang(){
        return $this->belongsTo('app\Models\KhachHang','MaKH','MaDDH');
    }
}
