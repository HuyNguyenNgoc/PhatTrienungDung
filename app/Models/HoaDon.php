<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    protected $table = "hoadon";

    public function donDatHang(){
        return $this->belongsTo('app\Models\DonDatHang','MaDDH','MaHD');
    }

    public function khachHang(){
        return $this->belongsTo('app\Models\KhachHang','MaKH','MaHD');
    }

    public function nhanVien(){
        return $this->belongsTo('app\Models\NhanVien','MaNV','MaHD');
    }

    public function chiTietHD(){
        return $this->hasMany('app\Models\ChiTietHD','MaHD','MaHD');
    }
}
