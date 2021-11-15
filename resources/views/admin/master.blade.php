<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title')</title>
  <base href="{{asset('')}}">
  <link rel="icon" href="source/img/fav-icon.png" type="image/x-icon" />
  <!-- Custom fonts for this template-->
  <link href="admin-source/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="admin-source/css/sb-admin-2.min.css" rel="stylesheet">


  <!-- Custom styles for this page -->
  <link href="admin-source/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>


</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('admin.leftmenu')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('admin.topmenu')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @yield('content')
        
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      @include('admin.footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thông báo!</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Bạn có muốn đăng xuất?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="admin/logout">Logout</a>
        </div>
      </div>
    </div>
  </div>


  <!-- Bootstrap core JavaScript-->
  <script src="admin-source/vendor/jquery/jquery.min.js"></script>
  <script src="admin-source/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="admin-source/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="admin-source/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="admin-source/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="admin-source/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="admin-source/js/demo/datatables-demo.js"></script>

  <!-- Page level plugins -->
  <script src="admin-source/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="admin-source/js/demo/chart-area-demo.js"></script>
  <script src="admin-source/js/demo/chart-pie-demo.js"></script>
  {{-- Ckeditor --}}
  <script src="vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>



  <script>
    $("#xuly_dh").click(function() {
      window.location.href = $(this).data('href');
    });
  </script>

  @yield('script')
</body>

</html>