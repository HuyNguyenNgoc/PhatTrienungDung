@extends('admin.master')
@section('title','Quản lý đơn đặt hàng')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 id="test" class="h3 mb-2 text-gray-800">Xử lý đơn đặt hàng</h1>
    <hr class="sidebar-divider">
    <!-- DataTales Example -->

    @if(Session::has('thanhcong'))  
      <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
    @endif
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive" id="load_donhang">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Stt</th>
                <th>Khách hàng</th>
                <th>Thời gian đặt</th>
                <th>Tổng tiền</th>
                <th>Thời gian giao hàng</th>
                <th>Địa chỉ giao hàng</th>
                <th>Tình trạng</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
                <?php $stt = 1; ?>
                @foreach ($donhang as $dh)
                <tr>
                    <input type="hidden" id="maddh" name="hoten" value="{{$dh->MaDDH}}">
                    <td>{!! $stt; !!}</td>
                    <td>{{$dh->TenKH}}</td>
                    <td>{{$dh->created_at}}</td>
                    <td>{{number_format($dh->TongTien)}}đ</td>
                    <td>{{$dh->ThoiGianGiaoHang}}</td>
                    <td>{{$dh->DiaChiGiaoHang}}</td>
                    <td>
                    @if($dh->TtThanhToan=="1")
                        <span class="badge badge-danger">Chưa thanh toán</span>
                    @else
                        <span class="badge badge-success">Đã thanh toán</span>
                    @endif
                      <span class="badge badge-warning">Chưa xử lý</span> 
                    </td>
                    <td><a href="{{URL::to('donhang/xac-nhan-don-hang/'.$dh->MaDDH)}}" id="xuly_dh" class="btn btn-success btn-sm">Xem</a></td>
                </tr>
                <?php $stt++; ?>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

@endsection

@section('script')
    <script>
        // $(document).ready(function(){
        //     setInterval(function(){
        //         $.ajax({
        //             url: "admin/don-hang/load-don-hang"
        //            });
        //         $('#load_donhang').load('admin/don-hang/load-don-hang').fadeIn('slow');
        //     },1500);
        // });

        // $( "#xuly_dh" ).click(function() {
        //   $.get('admin/don-hang/xac-nhan-don-hang/11', function(data){
        //     alert(number); 
        //   });
        // });  
        // $("#xuly_dh").click(function () {
        //   var number=document.getElementById("maddh").value; 
        //   window.location.href = "<?php echo URL::to('admin/donhang/xac-nhan-don-hang/"+number"/'); ?>";
        // });
        // function getcube(){  
        //   var number=document.getElementById("maddh").value; 
        //   //alert(number); 
        //   $.get('admin/don-hang/xac-nhan-don-hang/'+number, function(dâta){
        //   }); 
        // }
        $("#xuly_dh").click(function () {
          window.location.href = $(this).data('href');
        });

    </script>
@endsection