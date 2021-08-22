<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiSP extends Model
{
    protected $table = "loaisp";
    public function sanPham(){
        return $this->hasMany('app\Models\SanPham','MaLoaiSP','MaLoaiSP');
    }
}
