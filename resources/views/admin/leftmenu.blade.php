<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin">
      <div class="sidebar-brand-icon">
        <i class="fas fa-birthday-cake"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Cake</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('admin') ? 'active' : null}}">
      <a class="nav-link" href="admin">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Quản lý cửa hàng.</span></a>
    </li>


    <!-- Heading -->
    <div class="sidebar-heading">
      Thao tác
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Trang</span>
      </a>
      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Login Screens:</h6>
          <a class="collapse-item" href="admin/admin-login">Login</a>
          <a class="collapse-item" href="admin/admin_dangky">Register</a>
          <a class="collapse-item" href="forgot-password.html">Forgot Password</a>

    <!-- Nav Item - Loại sản phẩm Menu -->
    <li class="nav-item {{ Request::is(('admin/loaisp/*')) ? 'active' : null}}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLoaiSP" aria-expanded="true" aria-controls="collapseLoaiSP">
        <i class="fas fa-bread-slice"></i>
        <span>Loại sản phẩm</span>
      </a>
      <div id="collapseLoaiSP" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item {{ Request::is('loaisp/themloaisp') ? 'active' : null}}" href="admin/loaisp/themloaisp">Thêm loại sản phẩm</a>
          <a class="collapse-item {{ Request::is('loaisp/xemloaisp') ? 'active' : null}}" href="admin/loaisp/xemloaisp">Xem loại sản phẩm</a>  
        </div>
      </div>
    </li>

    <!-- Nav Item - Sản phẩm Menu -->
    <li class="nav-item  {{ Request::is(('sanpham/*')) ? 'active' : null}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSanPham" aria-expanded="true" aria-controls="collapseSanPham">
          <i class="fas fa-hamburger"></i>
          <span>Sản phẩm</span>
        </a>
        <div id="collapseSanPham" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{Request::is(('admin/sanpham/themsanpham')) ? 'active' : null}}" href="admin/sanpham/themsanpham">Thêm sản phẩm</a>
            <a class="collapse-item {{ Request::is('admin/sanpham/xemsanpham') ? 'active' : null}}" href="admin/sanpham/xemsanpham">Xem sản phẩm</a>  
          </div>
        </div>
      </li>

    <!-- Nav Item - Đơn đặt hàng -->
    <li class="nav-item  {{ Request::is(('donhang/*')) ? 'active' : null}}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDonHang" aria-expanded="true" aria-controls="collapseDonHang">
        <i class="fas fa-hamburger"></i>
        <span>Đơn hàng</span>
      </a>
      <div id="collapseDonHang" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item {{Request::is(('admin/donhang/xulydonhang')) ? 'active' : null}}" href="admin/donhang/xulydonhang">Xử lý đơn đặt hàng</a>
          <a class="collapse-item {{ Request::is('admin/donhang/xemdonhangdaduyet') ? 'active' : null}}" href="admin/donhang/xemdonhangdaduyet">Xem đơn hàng</a>  
          
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>