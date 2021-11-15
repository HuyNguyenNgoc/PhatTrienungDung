@extends('admin.master')
@section('title','Chi tiết đơn hàng')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Chi tiết đơn hàng</h1>
    <hr class="sidebar-divider">
    @if(count($errors)>0)
        @foreach ($errors->all() as $err)
            <div class="alert alert-danger">{{$err}}</div>
            @break;
        @endforeach
    @endif

    @if(Session::has('thanhcong'))  
      <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
    @endif

    <form enctype="multipart/form-data" action="{{ url('/admin/donhang/xacnhandonhang/'.$donhang->MaDDH) }}" method="POST">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mã đơn đặt hàng</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="maddh" value="#{{$donhang->MaDDH}}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Khách hàng</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="tenkhachhang" value="{{$donhang->MaKH}}" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tên người nhận</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="tennguoinhan" value="{{$donhang->TenNguoiNhan}}" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">SĐT người nhận</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="tensanpham" value="{{$donhang->sdt}}" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Thời gian giao hàng</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="tg_giaohang" value="{{$donhang->ThoiGianGiaoHang}}" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Thời gian đặt hàng</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="tg_dathang" value="{{$donhang->created_at}}" readonly>
            </div>
        </div>

        <div class="form-group row">
                <label class="col-sm-2 col-form-label">Địa chỉ giao hàng</label>
                <div class="col-sm-4">
                    <textarea type="text" class="form-control" name="diachi_giaohang" readonly>{{$donhang->DiaChiGiaoHang}}</textarea>
                </div>
            </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Ghi chú</label>
            <div class="col-sm-4">
                <textarea type="text" class="form-control" name="ghichu" readonly>{{$donhang->GhiChu}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Sản phẩm</label>
            <div class="col-sm-4">
                @foreach ($sp_dh as $sp)
                <li>{{$sp->TenSP}} x{{$sp->sl_dh}}</li>
                @endforeach
                
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tổng tiền</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="tongtien" value="{{number_format($tongtien)}}đ" placeholder="Đơn giá" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Chọn nhân viên giao hàng</label>
            <div class="col-sm-3">
                <select class="form-control" name="nv_giaohang">
                    @foreach ($nhanvien as $nv)
                    <option value="{{$nv->id}}">{{$nv->TenNV}}</option>
                    @endforeach
                </select>
            </div>  
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-success">Duyệt</button>
                <a style="color: #fff" href="#deleteDonHangModal" data-toggle="modal" class="btn btn-danger">Xóa</a>
            </div>
        </div>
    </form>

    <div class="modal fade" id="deleteDonHangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Thông báo!</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Bạn muốn xóa đơn hàng #{{$donhang->MaDDH}}?</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
              <a class="btn btn-danger" href="admin/xoadonhang/{{$donhang->MaDDH}}">Xóa</a>
            </div>
          </div>
        </div>
      </div>

</div>

@endsection