@extends('admin.master')
@section('title','Xem sản phẩm')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Xem sản phẩm</h1>
    <hr class="sidebar-divider">
    <!-- DataTales Example -->

    @if(Session::has('thanhcong'))  
      <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
    @endif
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
            <thead>
              <tr>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Loại sản phẩm</th>
                <th>Đơn vị tính</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Tình trạng</th>
                <th>Hình ảnh</th>
                <th>Thao tác</th>
                {{-- <th>xxx</th> --}}
              </tr>
            </thead>

            <tbody>
                @foreach ($sanpham as $sp)
                <tr>
                    <td>{{$sp->MaSP}}</td>
                    <td>{{$sp->TenSP}}</td>
                    <td>{{$sp->TenLoaiSP}}</td>
                    <td>{{$sp->DonViTinh}}</td> 
                    <td>{{$sp->SoLuong}}</td>
                    <td>{{number_format($sp->DonGia)}}đ</td>
                    <td style="width:100px;text-align: center;">
                        @if($sp->sp_moi)
                          <span class="badge badge-pill badge-success">Mới</span>
                        @else
                          <span class="badge badge-pill badge-danger">Mới</span>
                        @endif
                        @if($sp->hien_thi==1)
                          <span class="badge badge-info">Hiện</span>
                        @else
                          <span class="badge badge-danger">Hiện</span>
                        @endif
                    <td>
                        @if(!empty($sp->Image))
                        <img src="{{ asset('/images/img-SanPham/small/'.$sp->Image)}}" style="width:60px;height:40px">
                        @endif
                    </td>
                    <td style="width:135px; text-align: center;"><a href="#chiTetSPModal{{$sp->MaSP}}" data-toggle="modal" class="btn btn-success btn-sm">Xem</a><a href="{{ route('admin.suasanpham',$sp->MaSP) }}" class="btn btn-info btn-sm" style="margin:2px">Sửa</a><a href="#deleteSanPhamModal{{$sp->MaSP}}" data-toggle="modal" class="btn btn-danger btn-sm">Xóa</a></td>
                    {{-- <td style="width:100px;text-align: center"><a href="#chiTetSPModal{{$sp->MaSP}}" class="btn btn-success btn-xs">Hien thi</a>
                      <a href="{{ route('admin.suasanpham',$sp->MaSP) }}" class="btn btn-primary btn-xs"  style="margin:2px;">Hot</a></td> --}}
                
                      {{-- <td class="text-center"><a href="{{ route('admin.sualoaisp',$sp->MaSP) }}" class="btn btn-primary btn-sm">Sửa</a> | 
                  <a href="{{ route('admin.xoaloaisp',$sp->MaSP) }}" class="btn btn-danger btn-sm">Xóa</a></td>
                </tr>  --}}

                <!-- chitiet sanpham Modal-->
                <div class="modal fade" id="chiTetSPModal{{$sp->MaSP}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">{{$sp->TenSP}}</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>  
                      <div class="modal-body">
                        
                        <div class="form-group">
                          <p style="margin-botton:5px;display:inline" class="font-weight-bold">Mã sản phẩm: </p>
                          <p style="display:inline">{{$sp->MaSP}}</p>
                        </div>
                        
                        <div class="form-group">
                          <p style="margin-botton:5px;display:inline" class="font-weight-bold">Loại sản phẩm: </p>
                          <p style="display:inline">{{$sp->TenLoaiSP}}</p>
                        </div>

                        <div class="form-group">
                          <p style="margin-botton:5px;display:inline" class="font-weight-bold">Đơn vị tính: </p>
                          <p style="display:inline">{{$sp->DonViTinh}}</p>
                        </div>

                        <div class="form-group">
                          <p style="margin-botton:5px;display:inline" class="font-weight-bold">Số lượng: </p>
                          <p style="display:inline">{{$sp->SoLuong}}</p>
                        </div>

                        <div class="form-group">
                          <p style="margin-botton:5px;display:inline" class="font-weight-bold">Đơn giá: </p>
                          <p style="display:inline">{{$sp->DonGia}}đ</p>
                        </div>

                        <div class="form-group">
                          <p style="margin-botton:5px;display:inline" class="font-weight-bold">Mô tả: </p>
                          <textarea style="height: 300px" type="text" id="mota" class="form-control" name="mota">{{$sp->MoTa}}</textarea>
                        </div>

                        <div class="form-group">
                          <p style="margin-botton:5px;display:inline" class="font-weight-bold">Hình ảnh: </p>
                          <img src="{{ asset('/images/img-SanPham/small/'.$sp->Image)}}">
                        </div>
                        
                        
                      </div>
                      
                    </div>
                  </div>
                </div>

                <!-- Delete sanpham Modal-->
                <div class="modal fade" id="deleteSanPhamModal{{$sp->MaSP}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thông báo!</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">Bạn muốn xóa "{{$sp->TenSP}}"?</div>
                      <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                        <a class="btn btn-danger" href="{{route('admin.xoasanpham',$sp->MaSP)}}">Xóa</a>
                      </div>
                    </div>
                  </div>
                </div>

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
        CKEDITOR.replace( 'mota' );
    </script>
@endsection