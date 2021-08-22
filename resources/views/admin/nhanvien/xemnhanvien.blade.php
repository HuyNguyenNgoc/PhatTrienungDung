@extends('admin.master')
@section('title','Quản lý nhân viên')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý nhân viên</h1>
    <hr class="sidebar-divider">
    <!-- DataTales Example -->

    @if(Session::has('thanhcong'))  
      <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
    @endif
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Mã nhân viên</th>
                <th>Tên nhân viên</th>
                <th>Username</th>
                <th>Chức vụ</th>
                <th>Thao tác</th>
              </tr>
            </thead>

            <tbody>
                @foreach ($nhanvien as $nv)
                <tr>
                    <td>{{$nv->id}}</td>
                    
                    <td>{{$nv->TenNV}}</td>
                    <td><p class="text-primary">{{$nv->username}}</p></td>
                    @if($nv->Quyen==1)
                      <td>Admin</td>
                      @elseif($nv->Quyen==2)
                      <td>NV bán hàng</td>
                      @else
                      <td>NV kho</td>
                    @endif
                    
                    <td style="width:145px; text-align: center;"><a href="#chiTetSPModal{{$nv->id}}" data-toggle="modal" class="btn btn-success btn-sm">Xem</a><a href="{{ url('/admin/suasanpham/'.$nv->id) }}" class="btn btn-primary btn-sm" style="margin:2px">Sửa</a><a href="#deleteSanPhamModal{{$nv->id}}" data-toggle="modal" class="btn btn-danger btn-sm">Xóa</a></td>
                    
                
                <!-- Delete loaisp Modal-->
                {{-- <div class="modal fade" id="deleteLoaiModal{{$nv->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thông báo!</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">Bạn muốn xóa "{{$lsp->TenLoaiSP}}"?</div>
                      <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                        <a class="btn btn-danger" href="admin/xoaloai/{{$lsp->MaLoaiSP}}">Xóa</a>
                      </div>
                    </div>
                  </div>
                </div> --}}
                @endforeach
              
              
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

@endsection