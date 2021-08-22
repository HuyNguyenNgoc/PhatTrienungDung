<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class KhachHangs extends Authenticatable
{
    use Notifiable;

    protected $table = 'khachhang';

    protected $guard = 'khachhang';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'MaKH', 'TenKH', 'Email', 'MatKhau', 'GioiTinh', 'DiaChi', 'SDT', 'ChucVu', 'created_at', 'updated_at', 'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
