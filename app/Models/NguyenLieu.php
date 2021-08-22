<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NguyenLieu extends Model
{
    protected $table = "nguyenlieu";

    public function chiTietNhap(){
        return $this->hasMany('app\Models\ChiTietNhap','MaNL','MaNL');
    }

    public function chiTietXuat(){
        return $this->hasMany('app\Models\ChiTietXuat','MaNL','MaNL');
    }
}
