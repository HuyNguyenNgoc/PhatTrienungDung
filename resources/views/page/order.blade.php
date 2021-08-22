@extends('master')
@section('title','Xác nhận mua hàng')
@section('content')

<!--================End Main Header Area =================-->
<section class="banner_area">
    <div class="container">
        <div class="banner_text">
            <h3>Xác nhận mua hàng</h3>
            <ul>
                <li><a href="{{route('trang-chu')}}">Home</a></li>
                <li><a href="{{route('giohang')}}">Mua hàng</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Main Header Area =================-->

<!--================Cart Table Area =================-->
<section class="cart_table_area p_100">
    <div class="container">
            <div class="main_title">
                    <h2>Danh sách sản phẩm</h2>
                </div>
        <div class="table-responsive">
        @if(Session::has('cart'))
            @if(Session::has('thanhcong'))  
                <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Đơn giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Tổng cộng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sanpham_cart as $spcart)
                    <tr>        
                        <td>
                            <img src="{{ asset('/images/img-SanPham/small/'.$spcart['item']['Image'])}}" alt="" style="width:100px"></a>
                        </td>
                        <td>{{$spcart['item']['TenSP']}}</td>
                        <td>{{number_format($spcart['item']['DonGia'])}}đ</td>
                        <td>
                            {{$spcart['qty']}}
                        </td>
                        <td>{{number_format($spcart['price'])}}đ</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
           <div class="row cart_total_inner">
            <div class="col-lg-7" >
                <div class="cart_total_text">
                    <div class="cart_head">
                        <i class="fa fa-truck"></i> Thông tin thanh toán
                    </div>
                    <div class="sub_total">
                        <h5>Người nhận <span>{{$hoten}}</span></h5>
                    </div>
                    <div class="sub_total">
                        <h5>Số điện thoại <span>{{$sdt}}</span></h5>
                    </div>
                    <div class="sub_total">
                        <h5>Thời gian nhận hàng <span>{{$thoigian}}</span></h5>
                    </div>
                    <div class="sub_total">
                        <h5>Địa chỉ nhận hàng <span>{{$diachi}}</span></h5>
                    </div>
                    @if($ghichu!='')
                        <div class="sub_total">
                            <h5>Ghi chú <span>{{$ghichu}}</span></h5>
                        </div>
                    @endif    
                    <div class="sub_total">
                        <h5>Phương thức thanh toán
                            @if($pt_thanhtoan==1)
                                <span>Thanh toán trực tiếp khi nhận hàng</span>
                            @else
                            <span>Thanh toán trực tuyến bằng ATM, ví điện tử, paypal...</span>
                            @endif
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="cart_total_text">
                    <div class="cart_head">
                        <i class="fa fa-dollar"></i> Tổng tiền
                    </div>
                    <div class="sub_total">
                        <h5>Tạm tính ({{(Session('cart')->tongSo)}} sản phẩm) <span>{{number_format(Session('cart')->tongTien)}}đ</span></h5>
                    </div>
                    <div class="sub_total">
                        <h5>Phí giao hàng <span>20,000đ</span></h5>
                    </div>
                    <div class="total">
                        <h4>Tổng cộng <span>{{number_format(Session('cart')->tongTien+20000)}}đ</span></h4>
                    </div>
                    <div class="cart_footer">
                        <form action="{{route('order')}}" method="POST">
                        @csrf
                            <input type="hidden" name="hoten" value="{{$hoten}}">
                            <input type="hidden" name="sdt" value="{{$sdt}}">
                            <input type="hidden" name="thoigian" value="{{$thoigian}}">
                            <input type="hidden" name="diachi" value="{{$diachi}}">
                            <input type="hidden" name="ghichu" value="{{$ghichu}}">
                            <input type="hidden" name="pt_thanhtoan" value="{{$pt_thanhtoan}}">
                            
                            <button class="pink_more" type="submit" value="Thanh toán">Thanh toán</button>
                        </form>
                        <a class="pest_btn" href="mua-hang"><< Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="d-flex p-2">
                    <h1 style="text-align: center;width: 100%">Không có sản phẩm</h1>
            </div>
            
        @endif
    </div>
</section>
<!--================End Cart Table Area =================-->
@endsection