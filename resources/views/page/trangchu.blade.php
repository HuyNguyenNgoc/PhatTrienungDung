
@extends('master')
@section('title','Trang chủ')
@section('content')
<!--================Slider Area =================-->
<section class="main_slider_area">
	<div id="main_slider5" class="rev_slider" data-version="5.3.1.6">
		<ul>
			@foreach($slide as $sl)
			<li data-index="source/img/home-slider/{{$sl->IDSlide}}" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="400"  data-thumb="source/img/home-slider/{{$sl->Image}}"  data-rotate="0"  data-saveperformance="off"  data-title="Creative" data-param1="01" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
			<!-- MAIN IMAGE -->
			<img src="source/img/home-slider/{{$sl->Image}}"  alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>

				<!-- LAYER NR. 1 -->
				<div class="slider_text_box">
					
					<div class="tp-caption tp-resizeme first_text" 
					data-x="['right','right','left','15','15','15']" data-hoffset="['-150','0','15','15','15','0']" 
					data-y="['top','top','top','top']" 
					data-voffset="['155','155','155','155','235','230']" 
					data-fontsize="['60','60','60','40','30']"
					data-lineheight="['76','76','76','50','40']"
					data-width="['780','740','780','780','700','400']"
					data-height="none"
					data-whitespace="normal"
					data-type="text" 
					data-responsive_offset="on" 
					data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:0px;s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
					data-textAlign="['left','left','left','left']">{!!$sl->TenSP!!}</div>
					
					<div class="tp-caption tp-resizeme secand_text" 
						data-x="['right','right','left','15','15','15']" 
						data-hoffset="['0','110','15','15','15','0']" 
						data-y="['top','top','top','top']" data-voffset="['316','316','316','270','330','320']"  
						data-fontsize="['20','20','20','20','16']"
						data-lineheight="['28','28','28','28']"
						data-width="['620','620','620','620','500','380']"
						data-height="none"
						data-whitespace="normal"
						data-type="text" 
						data-responsive_offset="on"
						data-transform_idle="o:1;"
						data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:[100%];s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]">{{$sl->MoTa}}
						
					</div>
					
					<div class="tp-caption tp-resizeme slider_button" 
						data-x="['right','right','left','15','15','15']" data-hoffset="['0','0','15','0','0','0']" 
						data-y="['top','top','top','top']" data-voffset="['405','405','405','355','400','415']" 
						data-fontsize="['14','14','14','14']"
						data-lineheight="['46','46','46','46']"
						data-width="['620','740','620','620','300']"
						data-height="none"
						data-whitespace="normal"
						data-type="text" 
						data-responsive_offset="on" 
						data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:[100%];s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]">
						<a class="main_btn" href="{{route('chitiet-sanpham',$sl->MaSP)}}">Xem ngay</a>
					</div>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</section>
<!--================End Slider Area =================-->

<!--================Service We offer Area =================-->
<section class="service_we_offer_area gray_service white_bg p_100">
        	<div class="container">
        		<div class="single_b_title">
        			<h2>Dịch vụ của chúng tôi</h2>
        		</div>
        		<div class="row we_offer_inner">
        			<div class="col-lg-4">
        				<div class="s_we_item gray_s_item">
        					<div class="media">
        						<div class="d-flex">
        							<i class="flaticon-food-6"></i>
        						</div>
        						<div class="media-body">
        							<a href="#"><h4>Bánh Chất Lượng Nhất</h4></a>
        							<p>Chúng tôi mang đến các loại bánh chất hàng đầu thế giới cho các bạn chọn lựa.</p>
        						</div>
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-4">
        				<div class="s_we_item gray_s_item">
        					<div class="media">
        						<div class="d-flex">
        							<i class="flaticon-food-5"></i>
        						</div>
        						<div class="media-body">
        							<a href="#"><h4>Bánh Teabreak</h4></a>
        							<p>Các loại bánh ăn sáng đơn giản nhưng rất ngon miệng để dễ dàng mang đi.</p>
        						</div>
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-4">
        				<div class="s_we_item gray_s_item">
        					<div class="media">
        						<div class="d-flex">
        							<i class="flaticon-food-3"></i>
        						</div>
        						<div class="media-body">
        							<a href="#"><h4>Đám Cưới, sinh nhật</h4></a>
        							<p>Các đầu bếp giỏi nhất với những chiếc bánh kem đặc biết nhất trong ngày vui của các bạn.</p>
        						</div>
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-4">
        				<div class="s_we_item gray_s_item">
        					<div class="media">
        						<div class="d-flex">
        							<i class="flaticon-book"></i>
        						</div>
        						<div class="media-body">
        							<a href="#"><h4>Công Thức Tuyệt Vời</h4></a>
        							<p>Chúng tôi luôn mang đến cho khách hàng sự bất ngờ với những công thức đa dạng và ngon nhất.</p>
        						</div>
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-4">
        				<div class="s_we_item gray_s_item">
        					<div class="media">
        						<div class="d-flex">
        							<i class="flaticon-food-4"></i>
        						</div>
        						<div class="media-body">
        							<a href="#"><h4>Menu Đa Dạng</h4></a>
        							<p>Các bạn sẽ thoải mái lựa chọn với danh sách sản phẩm phong phú và đa dạng nhất.</p>
        						</div>
        					</div>
        				</div>
        			</div>
        			<div class="col-lg-4">
        				<div class="s_we_item gray_s_item">
        					<div class="media">
        						<div class="d-flex">
        							<i class="flaticon-transport"></i>
        						</div>
        						<div class="media-body">
        							<a href="#"><h4>Giao Hàng Tận Nhà</h4></a>
        							<p>Đội ngũ giao hàng nhanh chóng và chuyên nghiệp nhất nếu bạn có yêu cầu.</p>
        						</div>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
<!--================End Service We offer Area =================-->

<!--================Welcome Area =================-->
<section class="welcome_bakery_area pink_cake_feature">
        	<div class="container">
        		<div class="cake_feature_inner">
      				<div class="title_view_all">
						<div class="float-left">
							<div class="main_w_title">
								<h2>Sản phẩm mới</h2>
							</div>
						</div>
						<div class="float-right">
							<a class="pest_btn" href="#">Xem tất cả sản phẩm</a>
						</div>
					</div>
       				<div class="cake_feature_slider owl-carousel">
						@foreach ($spmoi as $spm)
						<div class="item">
							<a href="{{route('chitiet-sanpham',$spm->MaSP)}}">
							<div class="cake_feature_item">
								<div class="cake_img">
									<img src="images/img-SanPham/small/{{$spm->Image}}" alt="">
								</div>
								<div class="cake_text">
									<h4>{{number_format($spm->DonGia)}}VND</h4>
									<h3>{{$spm->TenSP}}</h3>
									<a class="pest_btn" href="{{route('themgiohang',$spm->MaSP)}}"><i class="lnr lnr-cart"></i> Thêm</a>
								</div>
							</div>
							</a>
						</div>
						@endforeach
       				</div>

        		</div>

        	</div>
    </section>
<!--================End Welcome Area =================-->



 @endsection