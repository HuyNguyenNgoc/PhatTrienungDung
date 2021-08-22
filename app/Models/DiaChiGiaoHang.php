<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaChiGiaoHang extends Model
{
    protected $table = "diachi_giaohang";

    public function khachHang(){
        return $this->belongsTo('app\Models\KhachHang','MaKH','MaHD');
    }
}
