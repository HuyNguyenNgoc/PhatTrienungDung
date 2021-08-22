<?php
    $connect = mysqli_connect("localhost","root","");
    $sql = "SELECT * FORM dbteacake";
    $res mysqli_query($connect, $sql;
    if(mysqli_num_rows($res) > 0)
    {
        while($row = mysqli_fetch_array($res))
        {
            ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Khách hàng</th>
                <th>Sản phẩm</th>
                <th>Tổng tiền</th>
                <th>Ngày đặt</th>
                <th>Địa chỉ giao hàng</th>
                <th>Tình trạng</th>
              </tr>
            </thead>
            <tbody>

            <?php
            $stt = 1;
            
                ?>
                <tr>
                    <td><?php echo $stt; ?></td>
                    <td><?php echo $row['TenKH'] ?></td>
                    <td></td>
                    <td>100</td>
                    <td><?php echo $row['created_at'] ?></td>
                    <td><?php echo $row['DiaChiGiaoHang'] ?></td>
                    <td><a href="" data-toggle="modal" class="btn btn-success btn-sm">Xử lý</a></td>
                </tr>
                <?php $stt++; 
            } ?>
            </tbody>
            </table>
            <?php
        
    }
?>
