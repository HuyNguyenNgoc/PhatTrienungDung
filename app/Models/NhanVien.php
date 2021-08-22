<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    protected $table = "nhanvien";

    public function hoaDon(){
        return $this->hasMany('app\Models\HoaDon','MaVN','MaNV');
    }
}
