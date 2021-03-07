<!-- Main content -->
<section class="content">
      
      <div class="container" style="margin-left:250px;">
        <div class="row" >
          
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Quản lý đơn hàng</h3>
               </div>
            </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Mã hoá đơn</th>
                    <th>Mã người dùng</th>
                    <th>Địa chỉ nhận hàng</th>
                    <th>Tổng tiền</th>
                    <th>Tình trạng thanh toán</th>
                    <th>Ngày tạo kiện hàng</th>
                    <th>Thao tác</th>
                  </tr>
                  </thead>
                  <tbody id="list-san-pham">
                  <?php
                     $page = 1;
                     $num_row = 5;
                     $max = 5;
                     $min = 1;
 
                     $count = DP::run_query("select count(*) as 'count' from sanphams",[],2);
                     $len = $count[0]['count'];
                     $paginate = ceil($len / $num_row) + 1;
                     
                     
                     if(isset($_GET["page"])) {
                       $page = (int)$_GET["page"];
                       // xu ly pagination
                       $max = $page * $num_row;
                       $min = $max - ($num_row - 1);
 
                     }

                    $query = "select hoadons.id as 'id_hoa_don', users.id as 'id_nguoi_dung', dia_chi_nhan_hang,sum(chitiethoadons.so_luong * chitiethoadons.don_gia) as tong_tien ,tinh_trang_thanh_toan, ngay_tao";
                    $query.= " from hoadons,chitiethoadons,users";
                    $query.= " where chitiethoadons.hoa_don_id = hoadons.id and hoadons.user_id = users.id";
                    $query.= " group by chitiethoadons.hoa_don_id limit ?,?";
                    $hoadons = DP::run_query($query,[$min - 1,$num_row],2);
                    $i = 0;
                    foreach($hoadons as $hoadon) {
                  ?>
                    <tr>
                        <td><?=$hoadon['id_hoa_don']?></td>
                        <td><?=$hoadon['id_nguoi_dung']?></td>
                        <td><?=$hoadon['dia_chi_nhan_hang']?></td>
                        <td><?=$hoadon['tong_tien']?></td>
                        <?php
                          if($hoadon['tinh_trang_thanh_toan'] == 1) {
                        ?>
                            <td id="status-payment<?php echo $i;?>">Đã thanh toán</td>
                        <?php 
                           } else {
                        ?>
                            <td id="status-payment<?php echo $i;?>">Chưa thanh toán</td>
                        <?php 
                          }
                        ?>
                        <td><?=$hoadon['ngay_tao']?></td>
                        <td>
                            <button class="btn btn-secondary btn-xem-chi-tiet-hoa-don"
                            data-bill_id="<?=$hoadon["id_hoa_don"];?>"
                            data-sum="<?=$hoadon["tong_tien"];?>"
                            data-pay-status="<?=$hoadon["tinh_trang_thanh_toan"];?>"
                            >
                            Xem chi tiết hoá đơn
                            </button><br>
                            <button class="btn btn-info btn-xem-thong-tin-nguoi-dung" data-user_id="<?=$hoadon["id_nguoi_dung"];?>" data-id="<?=$hoadon["id_hoa_don"];?>">
                            Xem thông tin người dùng
                            </button><br>
                            <button class="btn btn-success btn-cap-nhat-thanh-toan" data-pos="<?php echo $i;?>" data-user_id="<?=$hoadon["id_nguoi_dung"];?>" data-id="<?=$hoadon["id_hoa_don"];?>">
                            Cập nhật đã thanh toán
                            </button>
                      </td>
                    </tr>
                  <?php
                      $i++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                Hiển thị <?php echo $num_row;?> dòng (từ dòng <?php echo $min." - ".$max;?>)
                </div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                    <ul class="pagination">
                        <?php
                          for($i = 1 ; $i < $paginate ; $i++) {
                        ?>
                            <li class="paginate_button page-item 
                              <?php
                                if($i == $page) {
                                  echo 'active';
                                }
                              ?>
                            ">
                                <a href="admin_don_hang.php?page=<?php echo $i;?>" aria-controls="example1" data-dt-idx="<?php echo $i;?>" tabindex="0" class="page-link"><?php echo $i;?></a>
                            </li>
                        <?php
                          }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- /.modal -->
<div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Extra Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover">
                  <thead id="t_head">
                  </thead>
                  <tbody id="t_body">
                  </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->