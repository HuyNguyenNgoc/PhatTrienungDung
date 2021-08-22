<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SanPham;

class Cart extends Model
{
    public $itemSP = null;
    public $tongSo = 0;
    public $tongTien = 0;

    public function __construct($oldCart){
        if($oldCart){
            $this->itemSP = $oldCart->itemSP;
            $this->tongSo = $oldCart->tongSo;
            $this->tongTien = $oldCart->tongTien;
        }
    }

    public function add($item, $MaSP){
        $giohang = ['qty'=>0, 'price' => $item->DonGia, 'item' => $item];
        if($this->itemSP){
            if(array_key_exists($MaSP, $this->itemSP)){
                $giohang = $this->itemSP[$MaSP];
            }
        }
        $giohang['qty']++;
        $giohang['price'] = $item->DonGia * $giohang['qty'];
        $this->itemSP[$MaSP] = $giohang;
        $this->tongSo++;
        $this->tongTien += $item->DonGia;
    }

    public function addQty($id, $qty){
        $this->tongSo -= $this->itemSP[$id]['qty'];
        $this->tongTien -= $this->itemSP[$id]['price'];
        $sanpham = SanPham::where('MaSP',$id)->first();
        $this->itemSP[$id]['qty']=$qty;
        $this->itemSP[$id]['price'] = $sanpham->DonGia * $qty;
        $this->tongSo += $qty;
        $this->tongTien += $this->itemSP[$id]['price'];
        //print_r($this->itemSP[$id]['price']);die();
    }

    //xóa 1
    public function reduceByOne($id){
        $this->itemSP[$id]['qty']--;
        $this->itemSP[$id]['price'] -= $this->itemSP[$id]['item']['price'];
        $this->tongSo--;
        $this->tongTien -= $this->itemSP[$id]['item']['price'];
        if($this->itemSP[$id]['qty']<=0){
            unset($this->itemSP[$id]);
        }
    }
    //xóa nhiều
    public function removeItem($id){
        $this->tongSo -= $this->itemSP[$id]['qty'];
        $this->tongTien -= $this->itemSP[$id]['price'];
        unset($this->itemSP[$id]);
    }
}
