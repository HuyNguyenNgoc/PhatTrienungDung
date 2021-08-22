<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhaCungCap extends Model
{
    protected $table = "nhacungcap";

    public function phieuXuat(){
        return $this->hasMany('app\Models\PhieuXuat','MaNCC','MaNCC');
    }

    public function phieuNhap(){
        return $this->hasMany('app\Models\PhieuNhap','MaNCC','MaNCC');
    }
}
