<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDDH extends Model
{
    protected $table = "chitietddh";

    public function donDatHang(){
        return $this->belongsTo('app\Models\DonDatHang','MaDDH','MaSP');
    }

    public function sanPham(){
        return $this->belongsTo('app\Models\SanPham','MaSP','MaDDH');
    }
}
