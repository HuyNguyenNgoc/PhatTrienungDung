@extends('master')
@section('title',$title)
@section('content')
<!--================End Main Header Area =================-->
<section class="banner_area">
    <div class="container">
        <div class="banner_text">
            <h3>Sản phẩm</h3>
            <ul>
                <li><a href="{{route('trang-chu')}}">Trang chủ</a></li>
                <li><a href="" onclick="window.location.reload(true);">{{$title}}</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Main Header Area =================-->
<!--================Product Area =================-->
<section class="product_area p_100">
    <div class="container">
        <div class="row product_inner_row">
            <div class="col-lg-9">
                <div class="row m0 product_task_bar">
                    <div class="product_task_inner">
                        <div class="float-left">
                            <a class="active"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                            @if(isset($key))
                            <span>Có {{count($sp_load)}} sản phẩm cho '{{$key}}'</span>
                            @else
                            <span>Có {{count($sp_load)}} sản phẩm {{$title}}</span>
                            @endif
                        </div>
                        <div class="float-right">
                            <h4>Sort by :</h4>
                            <select class="short">
                                <option data-display="Default">Default</option>
                                <option value="1">Default</option>
                                <option value="2">Default</option>
                                <option value="4">Default</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row product_item_inner">
                    @foreach ($sp_load as $sp)                                    
                    <div class="col-lg-4 col-md-4 col-6">
                        <a href="{{route('chitiet-sanpham',$sp->MaSP)}}">
                            <div class="cake_feature_item">
                                <div class="cake_img">
                                <img src="images/img-SanPham/small/{{$sp->Image}}" alt="">
                                @if($sp->sp_moi)
                                <span class="product-new-label">New</span>
                                @endif
                                </div>
                                <div class="cake_text">
                                    <h4>{{number_format($sp->DonGia)}}đ</h4>
                                    {{-- <h5 style="padding-top: 30px"></h5> --}}
                                    <h3>{{$sp->TenSP}}</h3>
                                    @if($sp->SoLuong<=0)
                                    <a style="background: #f2b3b3" class="pest_btn">Hết hàng</a>
                                    @else
                                    <a class="pest_btn" href="{{route('themgiohang',$sp->MaSP)}}"><i class="lnr lnr-cart"></i> Thêm</a>
                                    @endif
                                </div>
                                
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="product_pagination">
                    <div class="middle_list">
                        {{$sp_load->links()}}
                    </div>
                </div>
          

            </div>
            <div class="col-lg-3">
                <div class="product_left_sidebar">
                    <aside class="left_sidebar search_widget">
                        <div class="input-group">
                            <form action="{{ url('/tim-kiem') }}" method="get">
                                <input type="text" class="form-control" name="key" placeholder="Nhập từ khóa" value="{{isset($key) ? $key : null}}">
                                <div class="input-group-append">
                                    <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </aside>
                    <aside class="left_sidebar p_catgories_widget">
                        <div class="p_w_title">
                            <h3>Loại sản phẩm</h3>
                        </div>
                        <ul class="list_style">
                            @foreach ($loaisp as $lsp)  
                            <li class="{{ Request::is('loai-san-pham/'.$lsp->MaLoaiSP) ? 'active' : null}}"><a href="{{route('loai-san-pham', $lsp->MaLoaiSP)}}">{{$lsp->TenLoaiSP}}</a></li>
                            @endforeach
                        </ul>
                    </aside>
                    
                    <aside class="left_sidebar p_price_widget">
                        <div class="p_w_title">
                            <h3>Filter By Price</h3>
                        </div>
                        <div class="filter_price">
                            <div id="slider-range"></div>
                            <label for="amount">Price range:</label>
                            <input type="text" id="amount" readonly />
                            <a class="pest_btn" href="#">Xem</a>
                        </div>
                    </aside>
                    <aside class="left_sidebar p_sale_widget">
                        <div class="p_w_title">
                            <h3>Top Sale Products</h3>
                        </div>
                        <div class="media">
                            <div class="d-flex">
                                <img src="source/img/product/sale-product/s-product-1.jpg" alt="">
                            </div>
                            <div class="media-body">
                                <a href="#">
                                    <h4>Brown Cake</h4>
                                </a>
                                <ul class="list_style">
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                </ul>
                                <h5>$29</h5>
                            </div>
                        </div>
                        <div class="media">
                            <div class="d-flex">
                                <img src="source/img/product/sale-product/s-product-2.jpg" alt="">
                            </div>
                            <div class="media-body">
                                <a href="#">
                                    <h4>Brown Cake</h4>
                                </a>
                                <ul class="list_style">
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                </ul>
                                <h5>$29</h5>
                            </div>
                        </div>
                        <div class="media">
                            <div class="d-flex">
                                <img src="source/img/product/sale-product/s-product-3.jpg" alt="">
                            </div>
                            <div class="media-body">
                                <a href="#">
                                    <h4>Brown Cake</h4>
                                </a>
                                <ul class="list_style">
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                </ul>
                                <h5>$29</h5>
                            </div>
                        </div>
                        <div class="media">
                            <div class="d-flex">
                                <img src="source/img/product/sale-product/s-product-4.jpg" alt="">
                            </div>
                            <div class="media-body">
                                <a href="#">
                                    <h4>Brown Cake</h4>
                                </a>
                                <ul class="list_style">
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                </ul>
                                <h5>$29</h5>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Product Area =================-->

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