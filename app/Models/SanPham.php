<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = "sanpham";
    public function loaiSP(){
      return $this->belongsTo('app\Models\LoaiSP','MaLoaiSP','MaSP');
  }
  
  public function chiTietDDH(){
      return $this->hasMany('app\Models\ChiTietDDH','MaSP','MaSP');
  }
  
  public function chiTietHD(){
      return $this->hasMany('app\Models\ChiTietHD','MaSP','MaSP');
  }
}
