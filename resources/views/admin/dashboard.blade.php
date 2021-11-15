@extends('admin.master')
@section('title','Dashboard')
@section('content')


<div class="container-fluid">

  <!-- Charting library -->
  <script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
  <!-- Chartisan -->
  <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
  <!-- Your application script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  


  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>
  <!-- Content Row -->
  <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              @foreach ($data['total'] as $t)
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tổng Doanh Thu</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($t )}} VND</div>
              @endforeach
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- loại sản phẩm -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              @foreach ($data['loaisp'] as $lsp)
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Loại sản Phẩm</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($lsp )}} loại sản phẩm</div>
              @endforeach
            </div>
            <div class="col-auto">
              <i class="fas fa-box-open fa-2x text-gray-300"></i> <i class=""></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- sản phẩm -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              @foreach ($data['products'] as $pd)
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tổng Sản Phẩm</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($pd )}} sản phẩm</div>
              @endforeach
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- tổng khách hàng -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              @foreach ($data['khdk'] as $kh)
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Đăng ký</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($kh )}} khách hàng</div>
              @endforeach
            </div>
            <div class="col-auto">
              <i class="fas fa-registered fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div style="width: 520px !important; height: 350px !important; float: left"> <b style="color:blue; font-size: 150%">Doanh thu tháng</b><canvas id="doanhthuchart" style="height: 200px !important"></canvas> </div>

  <div style="width: 520px !important; height: 350px ; float: left !important;"> <b style="color:green; font-size: 150%">Tổng số đơn đặt hàng theo tháng</b><canvas id="orderchart" style="height: 500px;"></canvas> </div>

  <div style="width: 450px !important; height: 350px !important;  float:left"> <b style="color:purple; font-size: 150%">Tổng số khách hàng theo tháng</b> <canvas id="userchart" style="height: 500px;"></canvas> </div>

  <div style="width: 450px; height: 400px !important; float:right"> <b style="color:brown; font-size: 150%">Tổng số sản phẩm bán theo tháng</b> <canvas id="spbc" style="height: 500px;"></canvas> </div>



  <script>
    var ctx = document.getElementById('userchart').getContext('2d');
    var data = <?= json_encode($data['users']); ?>;

    var myChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
        datasets: [{
          label: 'Khách hàng đăng ký',
          data: data,
          backgroundColor: [
            'rgba(127,255,212, 0.5)',
            'rgba(54, 162, 235, 0.5)',
            'rgba(255, 206, 86, 0.5)',
            'rgba(138,43,226, 0.5)',
            'rgba(153, 102, 255, 0.5)',
            'rgba(220,20,60, 0.5)',
            'rgba(139,69,19, 0.5)',
            'rgba(0,0,128, 0.5)',
            'rgba(139,0,139, 0.5)',
            'rgba(32,178,170, 0.5)',
            'rgba(220,220,220, 0.5)',
            'rgba(240,128,128, 0.5)'
          ],
          borderColor: [
            'Green'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

  <script>
    var ctx = document.getElementById('orderchart').getContext('2d');
    var data = <?= json_encode($data['orders']) ?>;
    var data1 = <?= json_encode($data['users']) ?>;
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
        datasets: [{
          label: 'Đơn đặt hàng',
          data: data,
          data1,
          options: {
            responsive: true,
            plugins: {
              legend: {
                position: 'top',
              },
              title: {
                display: true,
                text: 'Chart.js Bar Chart'
              }
            }
          },
          backgroundColor: [
            'rgba(255, 206, 86, 0.5)',
          ],
          borderColor: [
            'Pink'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>


  <script>
    var ctx = document.getElementById('spbc').getContext('2d');
    var data = <?= json_encode($data['spbc']); ?>;
    var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
        datasets: [{
          label: 'Tổng số lượng bán',
          data: data,
          backgroundColor: [
            'rgba(127,255,212, 0.5)',
            'rgba(54, 162, 235, 0.5)',
            'rgba(255, 206, 86, 0.5)',
            'rgba(138,43,226, 0.5)',
            'rgba(153, 102, 255, 0.5)',
            'rgba(220,20,60, 0.5)',
            'rgba(139,69,19, 0.5)',
            'rgba(0,0,128, 0.5)',
            'rgba(139,0,139, 0.5)',
            'rgba(32,178,170, 0.5)',
            'rgba(220,220,220, 0.5)',
            'rgba(240,128,128, 0.5)'
          ],
          borderColor: [
            'Yellow'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

  <script>
    var ctx = document.getElementById('doanhthuchart').getContext('2d');
    var data = <?= json_encode($data['doanhthu']); ?>;
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
        datasets: [{
          label: 'Doanh thu hàng tháng',
          data: data,
          backgroundColor: [
            'rgba(240,128,128)'
          ],
          borderColor: [
            'Aqua'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
</div>

@endsection