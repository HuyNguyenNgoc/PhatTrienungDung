@extends('admin.master')
@section('title','Quản lý đơn hàng')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 id="test" class="h3 mb-2 text-gray-800">Quản lý đơn hàng đã duyệt</h1>
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
                <th>Nhân viên bán</th>
                <th>Nhân viên giao</th>
                <th>Thời gian đặt</th>
                <th>Thời gian giao hàng</th>
                <th>Địa chỉ giao hàng</th>
                <th>Tổng tiền</th>
                <th>PT thanh toán</th>
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
                    <td>{{$dh->NVbanHang}}</td>
                    <td>{{$dh->NVgiaoHang}}</td>
                    <td>{{$dh->created_at}}</td>
                    <td>{{$dh->ThoiGianGiaoHang}}</td>
                    <td>{{$dh->DiaChiGiaoHang}}</td>
                    <td>{{number_format($dh->TongTien)}}đ</td>
                    <td>
                    @if($dh->PT_ThanhToan=="1")
                        Trực tiếp
                    @else
                        Online 
                    @endif    
                    </td>
                    <td style="width: 70px">
                    @if($dh->TinhTrangHD=="1")
                      <span class="badge badge-info">Đã xử lý</span> 
                    @elseif($dh->TinhTrangHD=="2")
                      <span class="badge badge-warning">Đang giao hàng</span>   
                    @else
                      <span class="badge badge-success">Hoàn thành</span> 
                    @endif  
                    </td>
                    <td>
                    @if($dh->TinhTrangHD=="3")
                        <a style="color: #fff" id="xuly_dh" class="btn btn-success btn-sm">Xem</a>
                    @else
                        <a href="donhang/xac-nhan-don-hang-2/{{$dh->MaDDH}}" id="xuly_dh" class="btn btn-info btn-sm">Sửa</a>
                    @endif
                    </td>
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
        $("#xuly_dh").click(function () {
          window.location.href = $(this).data('href');
        });

    </script>
@endsection