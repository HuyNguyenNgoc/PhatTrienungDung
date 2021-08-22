<?php

namespace App\Http\Controllers;
use App\Models\Slide;
use App\Models\SanPham;
use App\Models\LoaiSP;
use App\Models\Cart;
use App\Models\KhachHang;
use App\Models\KhachHangs;
use App\Models\DiaChiGiaoHang;
use App\Models\DonDatHang;
use App\Models\ChiTietDDH;


use Illuminate\Support\Facades\Hash;
use Sarav\Multiauth\Guard;
use Illuminate\Http\Request;
use Hamcrest\Core\HasToString;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;


use Illuminate\Support\Facades\Redirect;


class PageController extends Controller
{

    protected function guard()
    {
        return Auth::guard('khachhang');
    }

    public function getIndex(){
        $slide = Slide::all();
        $sp_moi = SanPham::where('sp_moi','1')->get();
        return view('page/trangchu',compact('slide','sp_moi'));
    }

    public function getLoaiSanPham($type){
        $sp_load = SanPham::where('MaLoaiSP',$type)->paginate(8);
        $sanpham = SanPham::all();
        $loaisp = LoaiSP::all();
        $title = LoaiSP::where('MaLoaiSP',$type)->value('TenLoaiSP');
        return view('page.loai_sanpham',compact('sanpham','loaisp','sp_load','title'));
    }

    public function getChiTietSanPham($req){
        $sanpham = SanPham::where('MaSP',$req)->first();
        return view('page.chitiet_sanpham',compact('sanpham'));
    } 

    
    public function getAddCart(Request $req, $MaSP){
        $sanpham = SanPham::where('MaSP',$MaSP)->first();
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($sanpham, $MaSP);
        $req->session()->put('cart',$cart);
        //echo "<pre>";print_r($req->soluong);die();
        return redirect()->back();
    }

    public function getDeleteCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->itemSP)>0){
            Session::put('cart',$cart);
        }
        else Session::forget('cart');
        return redirect()->back()->with('thanhcong','Xóa giỏ hàng thành công');
    }

    public function gioHang(){
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            
        return view('page.giohang')->with(['cart'=>Session::get('cart'), 'sanpham_cart'=>$cart->itemSP, 'tongTien'=>$cart->tongTien, 'tongSo'=>$cart->tongSo]);
    }

    public function suaSoLuongGioHang(Request $req, $id){
        if($req->isMethod('POST')){
            $oldCart = Session::has('cart')?Session::get('cart'):null;
            $cart = new Cart($oldCart);
            //print_r($req->slGioHang);die();
            $cart->addQty($id, $req->slGioHang);
            Session::put('cart',$cart);
            return redirect()->back()->with('thanhcong','Cập nhật số lượng thành công');
        }
       
    }
    public function getLienHe(){
        return view('page/lienhe');
    }
    public function getBlog(){
        return view('page.blog');
    }
    public function getChef(){
        return view('page.our-team');
    }
    public function getAbout(){
        return view('page.aboutus');
    }
    public function register(Request $req){
        if($req->isMethod('POST')){
            //echo "<pre>";print_r($req->gioitinh);die();
            $this->validate($req,
            [
                'hoten'=>'required|string|max:50',
                'email'=>'required|email|unique:khachhang,Email',
                'sdt'=>'required|numeric',
                'ngaysinh'=>'required|date',
                'gioitinh'=>'required',
                'diachi'=>'required',
                'password'=>'required|min:6',
                'repassword'=>'required|same:password'
            ],
            [
                'hoten.required'=>'Vui lòng nhập họ tên',
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng email',
                'email.unique'=>'email đã được sử dụng',
                'sdt.required'=>'Vui lòng nhập số điện thoại',
                'sdt.numeric'=>'Số điện thoại không đúng định dạng',
                'ngaysinh.required'=>'Vui lòng nhập ngày sinh',
                'ngaysinh.date'=>'Ngày sinh không đúng định dạng',
                'gioitinh.required'=>'Vui lòng chọn giới tính',
                'diachi.required'=>'Vui lòng nhập địa chỉ',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu ít hơn 6 ký tự',
                'repassword.same'=>'Mật khẩu không giống nhau'
            ]
            );
            $user = new KhachHang();
            $user->TenKH = $req->hoten;
            $user->email = $req->email;
            $user->NgaySinh = $req->ngaysinh;
            $user->password = Hash::make($req->password);
            $user->GioiTinh = $req->gioitinh;
            $user->DiaChi = $req->diachi;
            $user->SDT = $req->sdt;
            $user->save();
            return redirect('/khach-hang-login')->with('thanhcong','Đăng ký tài khoản thành công');
        }
        return view('page.register');
    }

    
    public function khachHangLogin(Request $req){
        if($req->isMethod('POST')){
            $data = $req->all();
            $this->validate($req,[
                'email' => 'required|min:4',
                'password' => 'required|min:6'
            ]);
            
            if(Auth::guard('khachhang')->attempt(['email' => $req->email, 'password' => $req->password], $req->remember)){
                session::put('userSession',$data['email']);
                 return redirect()->intended(route('trang-chu'));
            }
            else{
                $errors = new MessageBag(['Email' => ['email hoặc mật khẩu không chính xác!']]);
                return Redirect::back()->withErrors($errors)->withInput($req->only('Email','remember'));
            }
        }
        return view('page.login');
    }

    public function logout(){
        Auth::guard('khachhang')->logout();
        Session::forget('userSession');
        return redirect()->back();
    }

    public function getMuaHang(Request $req){
        $khachhang_email = session('userSession');
        $chiTiet_khachHang = KhachHang::where('email',$khachhang_email)->first();
        $diaChi = DiaChiGiaoHang::where('MaKH',$chiTiet_khachHang->id)->value('DiaChi');  

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        //return view('page/giohang')->with(['cart'=>Session::get('cart'), 'sanpham_cart'=>$cart->itemSP, 'tongTien'=>$cart->tongTien, 'tongSo'=>$cart->tongSo]);
        // if(empty($diaChi)){
        //     print_r('xxxx');die();
        // }
        //echo "<pre>"; print_r($diaChi);die();
        if($req->isMethod('POST')){
            $this->validate($req,
            [
                'hoten'=>'required|string',
                'sdt'=>'required|numeric',
                'thoigian'=>'required|date',
                'pt_thanhtoan'=>'required'
            ],
            [
                'hoten.required'=>'Vui lòng nhập họ tên người nhận hàng',
                'sdt.required'=>'Vui lòng nhập số điện thoại nhận hàng',
                'sdt.numeric'=>'Số điện thoại không đúng định dạng',
                'thoigian.required'=>'Vui lòng nhập thời gian nhận hàng',
                'thoigian.date'=>'Thời gian nhận hàng không đúng định dạng',
                'pt_thanhtoan.required'=>'Vui lòng chọn phương thức thanh toán'
            ]
            );

            if(empty($req->diachi1) and empty($req->diachi2) and empty($diaChi))
            {
                print_r($diaChi);die();
                return Redirect::back()->withErrors(['diachi' => ['Vui lòng nhập địa chỉ nhận hàng']]);
            }
            else
            {

                if(isset($req->diachi1)) $diachi_gh = $req->diachi1;
                else
                {
                    if(isset($req->diachi2)) $diachi_gh = $req->diachi2;
                    else $diachi_gh = $diaChi;
                }

                $hoten = $req->hoten;
                $sdt = $req->sdt;
                $thoigian = $req->thoigian;
                $diachi_nh = $diachi_gh;
                $pt_thanhtoan = $req->pt_thanhtoan;
                $ghichu = $req->ghichu;

                return redirect()->route(
                    'order', ([
                        'hoten' => $hoten, 'sdt' => $sdt, 'thoigian' => $thoigian, 'diachi' => $diachi_nh, 'ghichu' => $ghichu, 'pt_thanhtoan' => $pt_thanhtoan
                    ]));
                
            }

            // $new_time = DateTime::createFromFormat('h:i A', $req->thoigian);
            // $time_24 = $new_time->format('H:i:s');

            

            
        }
        //echo "<pre>"; print_r($cart['item']['TenSP']);die();
        return view('page.muahang')->with(compact('chiTiet_khachHang','diaChi'))->with(['cart'=>Session::get('cart'), 'sanpham_cart'=>$cart->itemSP, 'tongTien'=>$cart->tongTien, 'tongSo'=>$cart->tongSo]);
    }

    public function Order(Request $req){
        $hoten = $req->hoten;
        $sdt = $req->sdt;
        $thoigian = $req->thoigian;
        $diachi = $req->diachi;
        $ghichu = $req->ghichu;
        $pt_thanhtoan = $req->pt_thanhtoan;

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        if($req->isMethod('POST')){
            $time = $req->thoigian;
            $s=Carbon::parse($time);
            $tg_giaohang =$s->format('Y/m/d H:i:s',strtotime($time));

            $khachhang_email = session('userSession');
            $ma_khachHang = KhachHang::where('email',$khachhang_email)->value('id');

            $ddh = new DonDatHang();
            $ddh->MaKH = $ma_khachHang;
            $ddh->TenNguoiNhan = $req->hoten;
            $ddh->sdt = $req->sdt;
            $ddh->DiaChiGiaoHang = $req->diachi;
            $ddh->ThoiGianGiaoHang = $tg_giaohang;
            $ddh->GhiChu = $req->ghichu;
            $ddh->TtrangDH = '1';
            $ddh->PT_ThanhToan = $req->pt_thanhtoan;
            $ddh->TtThanhToan = '1';
            $ddh->save();

            $ma_ddh = DB::getPdo()->lastInsertId();
            
            foreach($cart->itemSP as $spcart)
            {
                ChiTietDDH::insert(
                ['MaDDH' => $ma_ddh, 'MaSP' =>  $spcart['item']['MaSP'], 'SoLuong' => $spcart['qty']]
            );
            }

            $diachikh = DiaChiGiaoHang::where('MaKH',$ma_khachHang)->first();
            if(isset($diachikh))
            {
                if($diachikh->DiaChi != $req->diachi)
                {
                    DiaChiGiaoHang::where('id',$diachikh->id)->update(['DiaChi' => $req->diachi]);
                }
            }
            else
            {
                DiaChiGiaoHang::insert(
                    ['MaKH' => $ma_khachHang, 'DiaChi' =>  $req->diachi]
                );
            }

            Session::forget('cart');
            
            return redirect('/khach-hang-login')->with('thanhcong','Đặt hàng thành công');
        }

        return view('page/order')->with(compact('hoten','sdt','thoigian','diachi','ghichu','pt_thanhtoan'))
        ->with(['cart'=>Session::get('cart'), 'sanpham_cart'=>$cart->itemSP, 'tongTien'=>$cart->tongTien, 'tongSo'=>$cart->tongSo]);
    }

    public function search(Request $req){
        $sp_load = SanPham::where('TenSP','like','%'.$req->key.'%')
                                ->orwhere('DonGia',$req->key)
                                ->paginate(6);
        $sanpham = SanPham::all();
        $loaisp = LoaiSP::all();
        $title = 'Tìm kiếm';
        $key = $req->key;
        return view('page/loai_sanpham',compact('sanpham','loaisp','sp_load','title','key'));

    }
}