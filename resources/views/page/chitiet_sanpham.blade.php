@extends('master')
@section('title','Chi Tiết sản phẩm')
@section('content')
<!--================End Main Header Area =================-->
<section class="banner_area">
    <div class="container">
        <div class="banner_text">
            <h3>Product Details</h3>
            <ul>
                <li><a href="{{route('trang-chu')}}">Trang chủ</a></li>
                <li><a href="../public/chitiet-sanpham/{{$sanpham->MaSP}}">{{$sanpham->TenSP}}</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Main Header Area =================-->

<!--================Product Details Area =================-->
<section class="product_details_area p_100">
    <div class="container">
        <div class="row product_d_price">
            <div class="col-lg-6">
                <div class="product_img"><img class="img-fluid" src="images/img-SanPham/large/{{$sanpham->Image}}" alt=""></div>
            </div>
            
            <div class="col-lg-6">
                <div class="product_details_text">
                    <h4>{{$sanpham->TenSP}}</h4>
                    {!!$sanpham->MoTa!!}
                    <h5>Giá :<span>{{number_format($sanpham->DonGia) }}VNĐ</span></h5>
                    <div class="quantity_box">
                        <label for="quantity">Số lượng :</label>
                        <form>
                        <input type="number" name="soluong" placeholder="1" id="soluong" min="1" style="width:60px">
                    </div>
                    @if($sanpham->SoLuong<=0)
                    <a class="pink_more">Hết hàng</a>
                    @else
                    <a class="pest_btn" href="{{route('themgiohang',$sanpham->MaSP)}}" style="line-height: 54px;"><i class="lnr lnr-cart"></i> Thêm</a>
                    <a class="pink_more" href="">Mua</a>
                    @endif
                    
                </form>
                </div>
            </div>
        
        </div>
        <div class="product_tab_area">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Nguyên liệu</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Specification</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Review (0)</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    {!!$sanpham->nguyen_lieu!!}
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Product Details Area =================-->

<!--================Similar Product Area =================-->
<section class="welcome_bakery_area pink_cake_feature" >
        	<div class="container">
        		<div class="cake_feature_inner">
      				<div class="title_view_all">
						<div class="float-left">
							<div class="main_w_title">
								<h2>Sản phẩm cùng loại</h2>
							</div>
						</div>
					</div>
       				<div class="cake_feature_slider owl-carousel">
						@foreach ($sp_cungloai as $spcl)
						<div class="item">
							<a href="{{route('chitiet-sanpham',$spcl->MaSP)}}">
							<div class="cake_feature_item">
								<div class="cake_img">
									<img src="images/img-SanPham/small/{{$spcl->Image}}" alt="">
								</div>
								<div class="cake_text">
									<h4>{{number_format($spcl->DonGia)}}VND</h4>
									<h3>{{$spcl->TenSP}}</h3>
									<a class="pest_btn" href="{{route('themgiohang',$spcl->MaSP)}}"><i class="lnr lnr-cart"></i> Thêm</a>
								</div>
							</div>
							</a>
						</div>
						@endforeach
       				</div>

        		</div>

        	</div>
    </section>
<!--================End Similar Product Area =================-->

<!--================Newsletter Area =================-->
<section class="newsletter_area">
    <div class="container">
        <div class="row newsletter_inner">
            <div class="col-lg-6">
                <div class="news_left_text">
                    <h4>Join our Newsletter list to get all the latest offers, discounts and other benefits</h4>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="newsletter_form">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter your email address">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">Subscribe Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Newsletter Area =================-->
@endsection