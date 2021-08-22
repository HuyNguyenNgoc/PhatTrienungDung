@extends('master')
@section('title','Giỏ hàng')
@section('content')

<!--================End Main Header Area =================-->
<section class="banner_area">
    <div class="container">
        <div class="banner_text">
            <h3>Giỏ hàng</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="giohang">Giỏ hàng</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Main Header Area =================-->

<!--================Cart Table Area =================-->
<section class="cart_table_area p_100">
    <div class="container">
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
                        <th scope="col"></th>
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
                            <form action="{{ url('/giohang/suasoluong/'.$spcart['item']['MaSP']) }}" method="POST">
                                @csrf
                                
                                <select class="product_select" name="slGioHang">
                                        @for($i=1;$i<=5;$i++)
                                            <option value='{{$i}}' {{($i==$spcart['qty']) ? 'selected' : null}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                    <button type="submit" class="btn" style="margin: 2px 0px 0px 5px ">+</button>
                            </form>
                            
                        </td>
                        <td>{{number_format($spcart['price'])}}đ</td>
                        <td><a class="cart-item-delete" href="{{route('xoagiohang',$spcart['item']['MaSP'])}}"><i class="fa fa-trash" aria-hidden="true" style="color: #797979"></i></i></a></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>
                            <form class="form-inline"> 
                                <div class="form-group"> 
                                    <input type="text" class="form-control" placeholder="Coupon code">
                                </div>
                                <button type="submit" class="btn">Apply Coupon</button>
                            </form>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a class="pest_btn" href="#">Add To Cart</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
           <div class="row cart_total_inner">
            <div class="col-lg-7"></div>
            <div class="col-lg-5">
                <div class="cart_total_text">
                    <div class="cart_head">
                        Cart Total
                    </div>
                    <div class="sub_total">
                        <h5>Tạm tính ({{(Session('cart')->tongSo)}} sản phẩm) <span>{{number_format(Session('cart')->tongTien)}}đ</span></h5>
                    </div>
                    <div class="total">
                        <h4>Tổng cộng <span>{{number_format(Session('cart')->tongTien)}}đ</span></h4>
                    </div>
                    <div class="cart_footer">
                        <a class="pest_btn" href="mua-hang">Thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="d-flex p-2">
                    <h1 style="text-align: center;width: 100%">Giỏ hàng trống</h1>
            </div>
            
        @endif
    </div>
</section>
<!--================End Cart Table Area =================-->
@endsection