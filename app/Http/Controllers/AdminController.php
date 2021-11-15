<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NhanVien;
use App\Http\Requests;
use Validator;
use Illuminate\Support\MessageBag;
use App\models\LoaiSP;
use App\Models\SanPham;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\URL;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use App\Models\DonDatHang;
use App\Models\KhachHang;
use App\Models\KhachHangs;
use App\Models\Admin;
use App\Models\ChiTietDDH;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use App\Models\HoaDon;
use App\Models\ChiTietHD;
use Symfony\Component\Console\Input\Input as InputInput;

class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //index---------------------------------
    public function index(){
        //Khách hàng
        $users = KhachHang::select(DB::raw("COUNT(*) as kh"))
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw("Month(created_at)"))
                ->pluck('kh');

        $monthsKH = KhachHang::select(DB::raw("Month(created_at) as monthKH"))
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw("Month(created_at)"))
                ->pluck('monthKH');
        //End KhachHang
        //Đơn đặt hàng
        $orders = DonDatHang::select(DB::raw("COUNT(*) as ddh"))
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw("Month(created_at)"))
                ->pluck('ddh');

        $monthsDDH = DonDatHang::select(DB::raw("Month(created_at) as monthDDH"))
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw("Month(created_at)"))
                ->pluck('monthDDH');
        //End DonDatHang
        
        //Sản phẩm bán chạy
        $spbanchay = SanPham::select(DB::raw("SUM(SoLuongBan) as spbc"))
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw("Month(created_at)"))
                ->pluck('spbc');
        //dd($spbanchay);
        $monthsspbc = SanPham::select(DB::raw("Month(created_at) as monthspbc"))
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw("Month(created_at)"))
                ->pluck('monthspbc');
        //End SP bán chạy
        //Doanh thu 
        $doanhthu = SanPham::select(DB::raw("SUM((SoLuongBan)*(DonGia)) as doanhthu"))
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw("Month(created_at)"))
                ->pluck('doanhthu');
        //dd($doanhthu);
        $monthsdoanhthu = SanPham::select(DB::raw("Month(created_at) as monthsdoanhthu"))
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw("Month(created_at)"))
                ->pluck('monthsdoanhthu');
        //End Doanh thu theo tháng

        //Sản phẩm
        $products = SanPham::select(DB::raw("COUNT(*) as sp"))
                ->pluck('sp');
        //End SanPham

        //Loại sản phẩm
        $loaisp = LoaiSP::select(DB::raw("COUNT(*) as lsp"))
                ->pluck('lsp');
        //End loaiSanPham

        //khách hàng
        $khdk = KhachHang::select(DB::raw("COUNT(*) as kh"))
                ->pluck('kh');
        //End khách hàng 

        $total = SanPham::select(DB::raw("SUM((SoLuongBan)*(DonGia)) as total"))
                ->pluck('total');
        //dd($total);

        $data = [ ['name' => 'users'],
                ['name' => 'orders'],
                ['name' => 'products'], 
                ['name' => 'total'], 
                ['name' => 'loaisp'], 
                ['name' => 'spbc'], 
                ['name' => 'doanhthu'],
                ['name' => 'khdk']
            ];
                
        $data['users'] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $data['orders'] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $data['products'] = $products;
        $data['loaisp'] = $loaisp;
        $data['total'] = $total;
        $data['khdk'] = $khdk;
        $data['spbc'] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $data['doanhthu'] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        

        foreach ($monthsKH as $index => $monthsKH){
            --$monthsKH;
            $data['users'][$monthsKH] = $users[$index];
        }

        foreach ($monthsDDH as $index => $monthsDDH){
            --$monthsDDH;
            $data['orders'][$monthsDDH] = $orders[$index];
        }

        foreach ($monthsspbc as $index => $monthsspbc){
            --$monthsspbc;
            $data['spbc'][$monthsspbc] = $spbanchay[$index];
        }

        foreach ($monthsdoanhthu as $index => $monthsdoanhthu){
            --$monthsdoanhthu;
            $data['doanhthu'][$monthsdoanhthu] = $doanhthu[$index];
        }
        return view('admin.dashboard', ['data' => $data]);
    }

    //get đăng ký tài khoản---------------------------------
    public function getDangKy(){
        return view('admin.admin_dangky');
    }

    //post đăng ký tài khoản---------------------------------
    public function postDangKy(Request $req){
        $this->validate($req,
            [
                'fullname'=>'required',
                'username'=>'required|string|min:5|unique:nhanvien,Username',
                'email'=>'required|email|unique:nhanvien,Email',
                'gender'=>'required',
                'address'=>'required',
                'phone_number'=>'required',
                'password'=>'required|min:6',
                're_password'=>'required|same:password'
            ],
            [
                'fullname.required'=>'Vui lòng nhập họ tên',
                'username.required'=>'Vui lòng nhập username',
                'username.min'=>'Tên đăng nhập ít hơn 5 ký tự',
                'username.unique'=>'Tên đăng nhập đã được sử dụng',
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng email',
                'email.unique'=>'email đã được sử dụng',
                'address.required'=>'Vui lòng nhập địa chỉ',
                'phone_number.required'=>'Vui lòng nhập số điện thoại',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu ít hơn 6 ký tự',
                're_password.same'=>'Mật khẩu không giống nhau'
            ]
            );
            $user = new NhanVien();
            $user->TenNV = $req->fullname;
            $user->username = $req->username;
            $user->password = Hash::make($req->password);
            $user->GioiTinh = $req->gender;
            $user->Email = $req->email;
            $user->DiaChi = $req->address;
            $user->SDT = $req->phone_number;
            $user->Quyen = 2;
            $user->save();
            return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');
    }

    //thêm loại sản phẩm---------------------------------
    public function themLoaiSP(Request $req){
        if($req->isMethod('POST')){
            $this->validate($req,
            [
                'idloaisp'=>'required|string|min:5|unique:loaisp,MaLoaiSP',
                'tenloaisp'=>'required|string|min:5|unique:loaisp,TenLoaiSP',
                'mota'=>'required'
            ],
            [
                'idloaisp.required'=>'Vui lòng nhập mã loại sản phẩm',
                'idloaisp.min'=>'Mã loại sản phẩm ít hơn 5 ký tự',
                'idloaisp.unique'=>'Mã loại sản phẩm đã được sử dụng',
                'tenloaisp.required'=>'Vui lòng nhập tên loại sản phẩm',
                'tenloaisp.min'=>'Tên loại sản phẩm ít hơn 5 ký tự',
                'tenloaisp.unique'=>'Tên loại sản phẩm đã được sử dụng',
                'mota.required'=>'Vui lòng nhập mô tả'
            ]
            );
            $loaisp = new LoaiSP;
            $loaisp->MaLoaiSP=$req->idloaisp;
            $loaisp->TenLoaiSP=$req->tenloaisp;
            $loaisp->MoTa=$req->mota;
            $loaisp->save();
            return redirect('admin.loaisp.xemloaisp')->with('thanhcong','Thêm loại sản phẩm thành công');
        }
        return view('admin.loaisp.themloaisp');
    }

    //xem loại sản phẩm---------------------------------
    public function xemLoaiSP(){
        $loaisp = LoaiSP::all();
        return view('admin.loaisp.xemloaisp')->with(compact('loaisp'));
    }

    //sửa loại sản phẩm---------------------------------
    public function suaLoaiSP(Request $req, $id = null){
        if($req->isMethod('POST')){
            $data = $req->all();
            LoaiSP::where(['MaLoaiSP'=>$id])->update(['MaLoaiSP'=>$data['idloaisp'], 'TenLoaiSP'=>$data['tenloaisp'], 'MoTa'=>$data['mota']]);
            return redirect('loaisp/xemloaisp')->with('thanhcong','Cập nhật loại sản phẩm thành công');
        }
        $loaisp = LoaiSP::where(['MaLoaiSP'=>$id])->first();
        return view('admin.loaisp.sualoaisp')->with(compact('loaisp'));
    }

    //xóa loại sản phẩm---------------------------------
    public function xoaLoaiSP($id = null){
        if(!empty($id)){
            LoaiSP::where(['MaLoaiSP'=>$id])->delete();
            return redirect()->back()->with('thanhcong','Xóa loại sản phẩm thành công');
        }
    }

    //---------------------------------********---------------------------------------

    //thêm sản phẩm---------------------------------
    public function themSanPham(Request $req){
        if($req->isMethod('POST')){
            //print_r($req->image); die();
            $this->validate($req,
            [
                'masanpham'=>'required|string|min:6|unique:sanpham,MaSP',
                'tensanpham'=>'required|string|unique:sanpham,TenSP',
                'loaisp'=>'required',
                'dvt'=>'required',
                'dongia'=>'required|numeric',
                'mota'=>'required',
                'nguyen_lieu'=> 'required',
                'image'=>'required|image',
            ],
            [
                'masanpham.required'=>'Vui lòng nhập mã sản phẩm',
                'masanpham.min'=>'Mã sản phẩm ít hơn 6 ký tự',
                'masanpham.unique'=>'Mã sản phẩm đã được sử dụng',
                'tensanpham.required'=>'Vui lòng nhập tên sản phẩm',
                'tensanpham.unique'=>'Tên sản phẩm đã được sử dụng',
                'dongia.required'=>'Vui lòng nhập đơn giá',
                'dongia.numeric'=>'Sai định dạng đơn giá',
                'soluong.numeric'=>'Sai định dạng số lượng',
                'mota.required'=>'Vui lòng nhập mô tả',
                'nguyen_lieu.required'=>'Vui lòng nhập nguyên liệu',
                'image.required'=>'Vui lòng chọn hình ảnh',
            ]
            );
            $sanpham = new SanPham;
            $sanpham->MaSP=$req->masanpham;
            $sanpham->TenSP=$req->tensanpham;
            $sanpham->MaLoaiSP=$req->loaisp;
            $sanpham->DonViTinh=$req->dvt;
            $sanpham->sp_moi='1';
            $sanpham->hien_thi='1';
            $sanpham->KhuyenMai=0;
            $sanpham->DonGia=$req->dongia;
            $sanpham->SoLuong=$req->soluong;
            $sanpham->MoTa=$req->mota;
            $sanpham->nguyen_lieu=$req->nguyen_lieu;

            if($req->hasFile('image')){
                $image = Input::file('image');
                if($image->isValid()){
                   $extension = $image->getClientOriginalExtension();
                   $filename = rand(111,99999).'.'.$extension;
                   $large_image_path = 'images/img-SanPham/large/'.$filename;
                   $small_image_path = 'images/img-SanPham/small/'.$filename;

                   Image::make($image)->save($large_image_path);
                   Image::make($image)->resize(270,200)->save($small_image_path);

                   $sanpham->Image = $filename;

                }
            }
            $sanpham->save();
            return redirect('admin/sanpham/xemsanpham')->with('thanhcong','Thêm sản phẩm thành công');
        }

        $loaisp = LoaiSP::all();
        return view('admin.sanpham.themsanpham')->with(compact('loaisp'));
    }

    //xem sản phẩm---------------------------------
    public function xemSanPham(){
        $sanpham = SanPham::all();
        $sanpham = json_decode(json_encode($sanpham));
        
        foreach($sanpham as $key =>$val){
            $tenlsp = LoaiSP::where(['MaLoaiSP'=>$val->MaLoaiSP])->first();
            $sanpham[$key]->TenLoaiSP = $tenlsp->TenLoaiSP;
        }
        //echo "<pre>";print_r($sanpham); die();
        return view('admin/sanpham/xemsanpham')->with(compact('sanpham'));
    }

    //sửa sản phẩm---------------------------------
    public function suaSanPham(Request $req, $id = null){
        if($req->isMethod('POST')){
            $data = $req->all();

            if($req->hasFile('image')){
                $image = Input::file('image');
                if($image->isValid()){
                   $extension = $image->getClientOriginalExtension();
                   $filename = rand(111,99999).'.'.$extension;
                   $large_image_path = 'images/img-SanPham/large/'.$filename;
                   $small_image_path = 'images/img-SanPham/small/'.$filename;

                   Image::make($image)->save($large_image_path);
                   Image::make($image)->resize(270,200)->save($small_image_path);

                }
            }
            else{
                if(!empty($data['oldimage'])){
                    $filename = $data['oldimage'];
                }
                else{
                    $filename = '';
                }
                
            }
            SanPham::where(['MaSP'=>$id])->update(['MaLoaiSP'=>$data['loaisp'],'TenSP'=>$data['tensanpham'],
            'DonViTinh'=>$data['dvt'],'DonGia'=>$data['dongia'],'SoLuong'=>$data['soluong'],'MoTa'=>$data['mota'],'nguyen_lieu'=>$data['nguyen_lieu'],'MaSP'=>$data['masanpham'],'Image'=>$filename]);
            return redirect('admin.sanpham.xemsanpham')->with('thanhcong','Cập nhật sản phẩm thành công');
        }
        $sanpham = SanPham::where(['MaSP'=>$id])->first();
        $malsp = $sanpham->MaLoaiSP;
        $loaisp = LoaiSP::all();
        return view('admin.sanpham.suasanpham')->with(compact('sanpham','loaisp','malsp'));
    }

    //xóa sản phẩm---------------------------------
    public function xoaSanPham($id = null){
        if(!empty($id)){
            SanPham::where(['MaSP'=>$id])->delete();
            //print_r("xx");die();
            return redirect()->back()->with('thanhcong','Xóa sản phẩm thành công');
        }
    }

    //xóa image sản phẩm---------------------------------
    public function xoaImgSanPham($id = null){
        SanPham::where(['MaSP'=>$id])->update(['Image'=>'']);
        return redirect()->back()->with('thanhcong','Xóa ảnh thành công');
    }


    //----------------------------users------------------
    //xem tài khoản----------------------------
    public function xemTaiKhoan(){
        $nhanvien= NhanVien::all();
        return view('admin.nhanvien.xemnhanvien')->with(compact('nhanvien'));
    }

    //xử lý đơn hàng----------------------------------------
    public function xuLyDonHang(){
        $donhang = DB::table('DonDatHang')->select('*')->where('TtrangDH', '1')->orderBy('MaDDH', 'desc')->get();
        $tt = 0;
        foreach($donhang as $key => $val){
            $khachhang = KhachHang::where(['MaKH' => $val->MaKH])->first();
            //dd($khachhang);
            $donhang[$key]->TenKH = $khachhang->TenKH;
            
        }
        
        foreach($donhang as $key =>$val){
            $ct_ddh = ChiTietDDH::where(['MaDDH'=>$val->MaDDH])->get();
            //$ct_ddh = DB::table('ChiTietDDH')->select('*')->where('MaDDH',$val->MaDDH)->get();
            
            foreach($ct_ddh as $item)
            {
                // print_r($item->MaSP);
                // die();
                //$sp = SanPham::where(['MaSP'=>$item->MaSP])->get();
                $sl = $item->SoLuong;
                $sp = DB::table('SanPham')->select('DonGia')->where('MaSP',$item->MaSP)->get();
                //dd($sp);
                foreach($sp as $sp_item)
                {
                    $tt = 0;
                    $tt += $sp_item->DonGia*$sl;
                }
                
            }
            $donhang[$key]->TongTien = $tt;
        }
        
        // foreach ($donhang as $dh){
        //     print_r($dh->TenKH);
        // }die();
        
        return view('admin.donhang.xemdonhang')->with(compact('donhang'));
    }

    public function loadDonHang(){
        
        $donhangs = DB::table('DonDatHang')->select('*')->where('TtrangDH', '1')->get();
        $tt = 0;

        foreach($donhangs as $key =>$val){
            $khachhang = KhachHang::where(['MaKH'=>$val->MaKH])->first();
            $donhangs[$key]->TenKH = $khachhang->TenKH;
        }

        foreach($donhangs as $key =>$val){
            //$ct_ddh = ChiTietDDH::where(['MaDDH'=>$val->MaDDH])->get();
            $ct_ddh = DB::table('ChiTietDDH')->select('*')->where('MaDDH',$val->MaDDH)->get();
            
            foreach($ct_ddh as $item)
            {
                // print_r($item->MaSP);
                // die();
                //$sp = SanPham::where(['MaSP'=>$item->MaSP])->get();
                $sl = $item->SoLuong;
                $sp = DB::table('SanPham')->select('DonGia')->where('MaSP',$item->MaSP)->get();
                foreach($sp as $sp_item)
                {
                    $tt += $sp_item->DonGia*$sl;
                } 
            }
            $donhangs[$key]->TongTien = $tt;
        }

            ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Khách hàng</th>
                <th>Thời gian giao hàng</th>
                <th>Tổng tiền</th>
                <th>Thời gian đặt</th>
                <th>Địa chỉ giao hàng</th>
                <th>Tình trạng thanh toán</th>
                <th>Tình trạng</th>
              </tr>
            </thead>
            <?php
            $stt = 0;
            foreach($donhangs as $dh)
            {
            // echo "<script>console.log( 'Debug Objects:xxxx " . $stt . "' );</script>";
            ?>
            <tbody>
                <tr>
                    <input type="hidden" id="maddh" name="hoten" value="<?php echo $dh->MaDDH ?>">
                    <td><?php echo $stt+1; ?></td>
                    <td><?php echo $dh->TenKH ?></td>
                    <td><?php echo $dh->ThoiGianGiaoHang ?></td>
                    <td><?php echo number_format($dh->TongTien).'đ' ?></td>
                    <td><?php echo $dh->created_at ?></td>
                    <td><?php echo $dh->DiaChiGiaoHang ?></td>
                    <td><?php if($dh->TtThanhToan=="1"){
                    ?>
                        <a href="" data-toggle="modal" class="btn btn-danger btn-sm">Chưa thanh toán</a>       
                    <?php
                    }else{
                    ?>
                        <a href="" data-toggle="modal" class="btn btn-success btn-sm">Đã thanh toán</a>
                    <?php    
                    }
                    ?></td>
                    <td><button type="submit" data-href="<?php URL::to('admin/donhang/xacnhandonhang.'.$dh->MaDDH) ?>" id="xuly_dh"  class="btn btn-success btn-sm">Xử lý</button></td>
                </tr>
                <?php $stt++; 
            } 
             ?>
            </tbody>
            </table>
            
            <?php
            //echo "<script>console.log( 'Debug Objects:xxxx " . $donhangs->MaDDH . "' );</script>";
            if($stt == 0) {?>
                
                <h2>Không có đơn đặt hàng</h2>
            <?php
            }
    }

    public function xacNhanDonHang(Request $req, $id = null)
    {
        $donhang = DonDatHang::where(['MaDDH'=>$id])->first();
        $sp_dh = array();
        $count = 0;
        $tongtien = 0;

        $ct_ddh = DB::table('ChiTietDDH')->select('MaSP','SoLuong')->where('MaDDH',$id)->get();
        foreach($ct_ddh as $item)
        {
            $sl = $item->SoLuong;
            $sp = DB::table('SanPham')->select('*')->where('MaSP',$item->MaSP)->get();
            foreach($sp as $sp_item)
            {
                //$array = Arr::add([$sp_item],'price', 100);
                $sp_item->sl_dh = $sl;
                $sp_dh[$count++] = $sp_item;
                $tongtien += $sp_item->DonGia*$sl;
                // echo "<pre>"; print_r($spx);
            }
        }

        if($req->isMethod('POST')){
           
            
            $hoadon = new HoaDon();
            $hoadon->MaDDH=$donhang->MaDDH;
            
            $hoadon->MaKH=$donhang->MaKH;
            
            $hoadon->save();

            $ma_hd = DB::getPdo()->lastInsertId();
            
            foreach($sp_dh as $hd_item)
            {
                ChiTietHD::insert(
                    ['MaHD' => $ma_hd, 'MaSP' =>  $hd_item->MaSP, 'SoLuong' => $hd_item->sl_dh]
                );
                SanPham::where('MaSP',$hd_item->MaSP)->update(['SoLuong' => $hd_item->SoLuong-$hd_item->sl_dh,'SoLuongBan' => $hd_item->SoLuongBan+$hd_item->sl_dh]);
            }
            DonDatHang::where('MaDDH',$donhang->MaDDH)->update(['TtrangDH' => '2']);
        
            return redirect()->action('App\Http\Controllers\AdminController@xuLyDonHang')->with('thanhcong','Duyệt đơn hàng thành công');
        }
        
            //echo "<pre>"; print_r($sp_dh);die();
            $kh = KhachHang::where(['MaKH'=>$donhang->MaKH])->first();
            $donhang->MaKH = $kh->id." - ".$kh->TenKH." - ".$kh->email;
            $nhanvien = NhanVien::all();
            //echo "<pre>"; print_r($nhanvien);die();
            //dd($nhanvien);

        return view('admin.donhang.xulydonhang')->with(compact('donhang','tongtien','sp_dh', 'nhanvien'));
    }

    public function xoaDonHang($id = null){
        if(!empty($id)){
            ChiTietDDH::where(['MaDDH'=>$id])->delete();
            DonDatHang::where(['MaDDH'=>$id])->delete();
            return redirect()->action('AdminController@xuLyDonHang')->with('thanhcong','Xóa đơn đặt hàng thành công');
        }
    }

    public function xemTinhTrangDonHangDaDuyet(){
        $donhang = DB::table('DonDatHang')->select('*')->where('TtrangDH', '2')->orderBy('MaDDH', 'desc')->get();
        $tt = 0;
        foreach($donhang as $key =>$val){
            $khachhang = KhachHang::where(['MaKH'=>$val->MaKH])->first();
            $donhang[$key]->TenKH = $khachhang->TenKH;
        }

        foreach($donhang as $key =>$val){
            //$ct_ddh = ChiTietDDH::where(['MaDDH'=>$val->MaDDH])->get();
            $ct_ddh = DB::table('ChiTietDDH')->select('*')->where('MaDDH',$val->MaDDH)->get();
            
            foreach($ct_ddh as $item)
            {
                // print_r($item->MaSP);
                // die();
                //$sp = SanPham::where(['MaSP'=>$item->MaSP])->get();
                $sl = $item->SoLuong;
                $sp = DB::table('SanPham')->select('DonGia')->where('MaSP',$item->MaSP)->get();
                foreach($sp as $sp_item)
                {
                    $tt = 0;
                    $tt += $sp_item->DonGia*$sl;
                }                
            }
            $donhang[$key]->TongTien = $tt;
        }
        foreach($donhang as $key =>$val){
            $hoadon = HoaDon::where(['MaDDH' => $val->MaDDH])->first();
            //dd($hoadon);
           // $nv_bh = NhanVien::where('MaNV',$hoadon->MaNV)->first();
            $nv_gh = NhanVien::where('MaNV', $hoadon->MaNV)->first();
            
            //$donhang[$key]->nv_giaohang = $nv_bh->TenNV;
            $donhang[$key]->MaNV = $nv_gh->TenNV;
            $donhang[$key]->TinhTrangHD = $hoadon->TtThanhToan;
        }

        return view('admin.donhang.xemtatcadonhang',compact('donhang'));

    }

    public function xacNhanDonhang2(Request $req, $id = null)
    {
        $donhang = DonDatHang::where(['MaDDH'=>$id])->first();
        $sp_dh = array();
        $count = 0;
        $tongtien = 0;

        $ct_ddh = DB::table('ChiTietDDH')->select('MaSP','SoLuong')->where('MaDDH',$id)->get();
        foreach($ct_ddh as $item)
        {
            $sl = $item->SoLuong;
            $sp = DB::table('SanPham')->select('*')->where('MaSP',$item->MaSP)->get();
            foreach($sp as $sp_item)
            {
                //$array = Arr::add([$sp_item],'price', 100);
                $sp_item->sl_dh = $sl;
                $sp_dh[$count++] = $sp_item;
                $tongtien += $sp_item->DonGia*$sl;
                // echo "<pre>"; print_r($spx);
            }
        }

        $hoadon = HoaDon::where(['MaDDH'=>$donhang->MaDDH])->first();
        // $nv_bh = NhanVien::where('MaNV',$hoadon->MaNV)->first();
        $nv_gh = NhanVien::where('MaNV',$hoadon->MaNV)->first();

        // $nv_banhang = $nv_bh->TenNV ." - ". $nv_bh->id;
        $nv_giaohang = $nv_gh->TenNV ." - ". $nv_gh->id;
        $tt_hoadon = $hoadon->TtThanhToan;

        if($req->isMethod('POST')){
            $this->validate($req,
            [
                'tt_donhang'=>'required',
            ],
            [
                'tt_donhang.required'=>'Vui lòng chọn tình trạng đơn hàng',
            ]
            );
            
            if($tt_hoadon!=$req->tt_donhang)
            {
                HoaDon::where('MaDDH',$donhang->MaDDH)->update(['TtThanhToan' => $req->tt_donhang]);
            }
            else
            {
                return redirect()->back()->with('error','Vui lòng chọn lại tình trạng đơn hàng!');
            }

            return redirect()->action('AdminController@xemTinhTrangDonHangDaDuyet')->with('thanhcong','Duyệt đơn hàng thành công');
        }
        
            //echo "<pre>"; print_r($sp_dh);die();
            $kh = KhachHang::where(['MaKH'=>$donhang->MaKH])->first();
            $donhang->MaKH = $kh->id." - ".$kh->TenKH." - ".$kh->email;
            $nhanvien = NhanVien::where(['Quyen'=>'4'])->get();
            //echo "<pre>"; print_r($nhanvien);die();

            // echo "<pre>"; print_r($donhang->MaDDH);
            // die();
            
        return view('admin.donhang.xacnhandonhang')->with(compact('donhang','tongtien','sp_dh','nhanvien','nv_giaohang','tt_hoadon'));
    }

       
}