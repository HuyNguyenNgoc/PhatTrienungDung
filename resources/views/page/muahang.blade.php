@extends('master')
@section('title','Mua hàng')
@section('content')

<!--================End Main Header Area =================-->
<section class="banner_area">
    <div class="container">
        <div class="banner_text">
            <h3>Đặt hàng</h3>
            <ul>
                <li><a href="index.html">Trang chu</a></li>
                <li><a href="checkout.html">Chekout</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Main Header Area =================-->

<!--================Billing Details Area =================-->    
<section class="billing_details_area p_100">
    <div class="container">
            @if(count($errors)>0)
                @foreach ($errors->all() as $err)
                    <div class="alert alert-danger">{{$err}}</div>
                    @break;
                @endforeach
            @endif
        <div class="row">
            <div class="col-lg-7">
                   <div class="main_title">
                       <h2>Thông tin nhận hàng</h2>
                   </div>
                <div class="billing_form_area">
                    <form class="billing_form row" action="{{route('muaHang')}}" method="POST">
                    @csrf    
                        <div class="form-group col-md-6">
                            <label for="first">Họ tên người nhận *</label>
                            <input type="text" class="form-control" id="hoten" name="hoten" value="{{$chiTiet_khachHang->TenKH}}" placeholder="Họ và tên">
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="company">Số điện thoại nhận hàng *</label>
                            <input type="tel" class="form-control" id="sdt" name="sdt" value="{{$chiTiet_khachHang->SDT}}"  placeholder="Số điện thoại">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="company">Thời gian nhận hàng *</label>
                            <div class='input-group date' id="datetimepicker1">
                                <input type='text' name="thoigian" class="form-control"/>                                
                            </div>
                        </div>

                        <div class="form-group col-md-10">
                            <label for="address">Địa chỉ nhận hàng *</label>
                            @if(isset($diaChi))
                                <span>{{$diaChi}}</span>
                                <a style="font-style: italic; color: #2f8ffe;margin-left: 5px;float: right" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">thay đổi</a>
                            @else
                            <br>
                            <label>* Nhập đầy đủ: Số nhà - Tên đường - Phường - Quận</label>
                            <input type="text" class="form-control" id="address" name="diachi1" placeholder="Nhập địa chỉ">
                            @endif
                            <div class="collapse" id="collapseExample">
                                <br>
                                <label>* Nhập đầy đủ: Số nhà - Tên đường - Phường - Quận</label>
                                    <input type="text" class="form-control" id="address" name="diachi2" placeholder="Nhập địa chỉ">
                                
                            </div>
                            </div>
                        
                        <div class="form-group col-md-10">
                            <label for="phone">Ghi chú</label>
                            <textarea class="form-control" name="ghichu" id="ghichu" rows="1" placeholder="Yêu cầu sản phẩm, thông tin giao hàng..."></textarea>
                        </div>
                    
                </div>
            </div>
            <div class="col-lg-5">
                    <div class="main_title">
                        <h2>Danh sách sản phẩm</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng cộng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(Session::has('cart'))
                                
                                    @foreach($sanpham_cart as $spcart)
                                    <tr>
                                        <td><img src="{{ asset('/images/img-SanPham/small/'.$spcart['item']['Image'])}}" alt="" style="width:50px"></a></td>
                                        <td>{{$spcart['item']['TenSP']}}</td>
                                        <td>{{number_format($spcart['item']['DonGia'])}}đ</td>
                                        <td>{{$spcart['qty']}}</td>
                                        <td>{{number_format($spcart['price'])}}đ</td>
                                    </tr>
                                    @endforeach
        
                            </tbody>
                        </table>
                    </div>
                    <a value="submit" class="btn pink_more" href="giohang"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a>
                                    @else
                                    </tbody>
                                    </table>
                                    </div>
                                    <h3>Giỏ hàng trống</h3>
                                    <a value="submit" class="btn pest_btn" href="giohang"><i class="fa fa-shopping-cart"></i> Tiếp tục mua</a>
                                @endif
                @if(Session::has('cart'))    
                <div class="order_box_price">
                    <div class="main_title">
                        <br>
                        <h2>Thanh toán</h2>
                    </div>
                    <div class="payment_list">
                        <div class="price_single_cost">
                            
                            <h5>Tạm tính ({{(Session('cart')->tongSo)}} sản phẩm) <span>{{number_format(Session('cart')->tongTien)}}đ</span></h5>
                            {{-- <h4>Subtotal <span>$65.00</span></h4> --}}
                            <h5>Phí giao hàng<span class="text_f">20,000đ</span></h5>
                            <h5>Mã giảm giá <span><input type="text"><a class="btn btn-success" style="line-height: .95rem;margin-left:5px" href="giohang">Áp dụng</a></span></h5>
                            <h3>Tổng cộng <span>{{number_format(Session('cart')->tongTien+20000)}}đ</span></h3>
                        </div>
                        <div id="accordion" class="accordion_area">
                            
                            <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <input type="checkbox" class="btn btn-link collapsed" name="pt_thanhtoan" value="1" data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            <label style="font-size: 15px;font-family: 'Open Sans', sans-serif;font-weight: 600;">Thanh toán khi nhận hàng</label>
                                            
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                                Bạn có thể thanh toán bằng tiền mặt khi nhận hàng tại nhà
                                        </div>
                                    </div>
                                </div>

                            
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <input type="checkbox" class="btn btn-link collapsed" name="pt_thanhtoan" value="2" data-toggle="collapse" href="#collapseThree" role="button"  aria-expanded="false" aria-controls="collapseThree">
                                               
                                        <label style="font-size: 15px;font-family: 'Open Sans', sans-serif;font-weight: 600;">Thanh toán trực tuyến</label>
                                            
                                        
                                        <img style="margin-left: 20px;" src="source/img/checkout-card.png" alt="">
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                            Bạn có thể thanh toán bằng:<br>

                                            1. Thẻ ATM<br>
                                            
                                            2. Ví điện tử: MoMo, ZaloPay...<br>
                                            
                                            3. Paypal
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" value="submit" class="btn pest_btn">Thanh toán</button>
                    </div>
                </div>
                @endif
            </form>
            </div>
        </div>
    </div>
</section>
<!--================End Billing Details Area =================-->   
@endsection