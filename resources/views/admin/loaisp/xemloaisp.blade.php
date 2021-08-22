@extends('admin.master')
@section('title','Xem Loại SP')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Loại sản phẩm</h1>
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
                <th>Mã loại sản phẩm</th>
                <th>Tên loại sản phẩm</th>
                <th>Mô tả</th>
                <th>Thao tác</th>
              </tr>
            </thead>

            <tbody>
                @foreach ($loaisp as $lsp)
                <tr>
                    <td>{{$lsp->MaLoaiSP}}</td>
                    <td>{{$lsp->TenLoaiSP}}</td>
                    <td>{{$lsp->MoTa}}</td>
                <td class="text-center">
                  <a href="{{ route('admin.sualoaisp',$lsp->MaLoaiSP) }}" class="btn btn-primary btn-sm">Sửa</a> | 
                  <a href="#deleteLoaiModal{{$lsp->MaLoaiSP}}" data-toggle="modal" class="btn btn-danger btn-sm">Xóa</a></td>
                </tr>
                
                <!-- Delete loaisp Modal-->
                <div class="modal fade" id="deleteLoaiModal{{$lsp->MaLoaiSP}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <a class="btn btn-danger" href="xoaloaisp/{{$lsp->MaLoaiSP}}">Xóa</a>
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