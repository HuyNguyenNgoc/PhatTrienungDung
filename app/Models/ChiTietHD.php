<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SanPham;

class ChiTietHD extends Model
{
    protected $table = "chitiethd";
    protected $primaryKey = ['MaHD', 'MaSP'];

    public function hoaDon(){
        return $this->belongsTo('app\Models\HoaDon','MaHD', 'MaSP');
    }

    public function sanPham(){
        return $this->belongsTo('app\Models\SanPham','MaSP', 'MaHD');
    }
}
