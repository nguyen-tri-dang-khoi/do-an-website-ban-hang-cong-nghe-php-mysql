<?php
    $user_info = DP::run_query("select * from users where is_lock = 0 and id = ? and is_delete = 0",[(int)$_SESSION["id"]],2);
?>

<div class="container rounded bg-white mt-5">
    <div class="row">
        <div class="col-md-3 border-right">
        <?php
            if($user_info[0]["photo"] == "image.jpg") {
        ?>
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" src="<?php echo _DIR_['IMG']['USERS']."info/image.jpg" ?>" width="90">
                <span class="font-weight-bold"><?php echo $user_info[0]["name"]; ?></span>
                <span class="text-black-50"><?php echo $user_info[0]["email"]; ?></span>
            </div>
        <?php
            } else {
        ?>
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" src="<?php echo _DIR_['IMG']['USERS']."info/".$user_info[0]['photo'] ;?>" width="90">
                <span class="font-weight-bold"><?php echo $user_info[0]["name"]; ?></span>
                <span class="text-black-50"><?php echo $user_info[0]["email"]; ?></span>
            </div>
         <?php
            }
        ?>
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" id="form-user-tab" data-toggle="pill" href="#form-user" role="tab" aria-controls="v-pills-home" aria-selected="true">Hồ sơ</a>
                <a class="nav-link active" id="list-don-hang-tab" data-toggle="pill" href="#list-don-hang" role="tab" aria-controls="v-pills-profile" aria-selected="false">Đơn hàng</a>
                <a class="nav-link" id="form-change-pass-tab" data-toggle="pill" href="#form-change-pass" role="tab" aria-controls="v-pills-messages" aria-selected="false">Đổi mật khẩu</a>
                <a class="nav-link" id="form-change-pass-tab" href="user_logout.php">Đăng xuất</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="p-3 py-5 tab-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="index.php" class="btn btn-primary">Về trang chủ</a>
                    <h6 class="text-right">Thông tin cá nhân</h6>
                </div>
                <form class="tab-pane fade" role="tabpanel" id="form-user" aria-labelledby="form-user-tab" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <!--Tên đăng nhập-->
                    <div class="form-group">
                        <label for="name">Tên tài khoản</label>
                        <div class="col">
                            <input type="text" name="name" class="form-control" placeholder="Họ tên..." value="<?php echo $user_info[0]["name"]; ?>">
                        </div>
                        <!-- loi ten tai khoan -->
                        <div id="name_err" class="text-danger"></div>
                    </div>
                    
                    <!--Email và số điện thoại-->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="col">
                            <input type="email" name="email" class="form-control" placeholder="Email..." value="<?php echo $user_info[0]["email"]; ?>">
                        </div>
                        <!-- Loi email -->
                        <div id="email_err" class="text-danger"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Ngày sinh</label>
                        <div class="col">
                            <input type="text" name="birth" id="ngay_sinh_user" class="form-control" placeholder="Ngày sinh..." value="<?php echo $user_info[0]["birth"]; ?>">
                        </div>
                         <!-- loi ngay sinh -->
                         <div id="birth_err" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <div class="col">
                            <input type="tel" name="phone" class="form-control" placeholder="Số điện thoại..." value="<?php echo $user_info[0]["phone"]; ?>">
                        </div>
                        <!-- loi so dien thoai -->
                        <div id="phone_err" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <div class="col"><input type="text" name="address" class="form-control" placeholder="Địa chỉ..." value="<?php echo $user_info[0]["address"]; ?>"></div>
                        <!-- loi dia chi-->
                        <div id="address_err" class="text-danger"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="image">Ảnh đại diện</label>
                            <div class="custom-file">
                                <input id="fileInput" name="img_user" type="file" accept="image/*" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Upload ảnh đại diện</label>
                            </div>
                        </div>
                        <?php
                            if($user_info[0]["photo"] == "image.jpg") {
                        ?>
                            <div class="img-fluid" id="where-replace">
                                <span></span>
                            </div>
                        <?php
                            } else {
                        ?>
                            <img width="200" height="200" src="img/img-user/info/<?=$user_info[0]["photo"]?>" data-img='<?=$user_info[0]["photo"]?>' class='img-fluid' id='display-image'/>
                        <?php
                            }
                        ?>
                         <!-- loi hinh anh -->
                         <div id="image_err" class="text-danger"></div>
                    </div>
                    <!--Mật khẩu xác thực-->
                    <div class="form-group">
                        <label for="pass">Mật khẩu xác thực</label>
                        <div class="col">
                            <input type="password" name="pass" class="form-control" value="" placeholder="Mật khẩu">
                        </div>
                        <!-- loi hinh anh -->
                        <div id="pass_auth_err" class="text-danger"></div>
                    </div>
                    <div class="mt-5 text-right">
                        <button id="btn-cap-nhat-user" class="btn btn-primary profile-button" type="button">Cập nhật hồ sơ</button>
                    </div>
                     
                </form>

                <!--Phan trang don hang cua user-->
                <div class="tab-pane show active" id="list-don-hang" role="tabpanel" aria-labelledby="list-don-hang-tab">
                    <table class="table table-striped table-dark">
                        <thead>
                            <th>ID Hoá đơn</th>
                            <th>Tổng tiền thanh toán</th>
                            <th>Tình trạng thanh toán</th>
                            <th>Ngày đặt hàng</th>
                            <th>Thao tác</th>
                        </thead>
                        
                        <tbody>
                        <?php
                            $page = 1;
                            // số dòng hiển thị
                            $num_row = 3;
                            // dòng max
                            $max = 3;
                            // dòng min
                            $min = 1;
        
                            $count = DP::run_query("select count(*) as 'count' from hoadons where hoadons.user_id = ?",[(int)$_SESSION["id"]],2);
                            //var_dump($count);
                            $len = $count[0]['count'];
                            if(isset($_GET["page"])) {
                                $page = (int)$_GET["page"];
                                // xu ly pagination
                                $max = $page * $num_row;
                                $min = $max - ($num_row - 1);
                            }
                            // phân trang nếu số ko chia hêts thì làm tròn lên để tạo paginate mới
                            $paginate = ceil($len / $num_row) + 1;
                            //var_dump($paginate);
                            $bills = DP::run_query("select hoadons.id as 'id',tinh_trang_thanh_toan,sum(chitiethoadons.so_luong * chitiethoadons.don_gia) as 'tong_tien',ngay_tao from hoadons,chitiethoadons where hoadons.id = chitiethoadons.hoa_don_id and hoadons.user_id = ? group by chitiethoadons.hoa_don_id limit ?,? ",[(int)$_SESSION["id"],$min - 1,$num_row],2);
                            foreach($bills as $bill) {
                        ?>
                            <tr id="hoa-don-<?php echo $bill["id"]?>">
                                <td><?php echo $bill["id"];?></td>
                                <td><?php echo $bill["tong_tien"];?></td>
                                <?php
                                    if($bill["tinh_trang_thanh_toan"] == "1") {
                                ?>
                                        <td>Đã thanh toán</td>
                                <?php
                                    } else {
                                ?>
                                        <td>Chưa thanh toán</td>
                                <?php
                                    }
                                ?>
                                <td><?php echo $bill["ngay_tao"] ;?></td>
                                <td>
                                    <button data-bill_id="<?php echo $bill["id"];?>" class="btn btn-success btn-xem-chi-tiet-hoa-don">Xem chi tiết hoá đơn</button>
                                    <?php
                                        if($bill["tinh_trang_thanh_toan"] == "0") {
                                    ?>
                                            <button data-bill_id="<?php echo $bill["id"];?>" class="btn btn-danger btn-order-cancel">Huỷ đơn hàng</button>
                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                        <?php
                            for($i = 1 ; $i < $paginate ; $i++) {
                        ?>
                                <li class="page-item <?php echo ($i == $page) ? "active" : "" ;?>">
                                    <a class="page-link" href="user_info.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                        <?php
                            }
                        ?>
                        </ul>
                    </nav>
                </div>
                <form class="tab-pane fade" id="form-change-pass" role="tabpanel" aria-labelledby="form-change-pass-tab" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <!--Mật khẩu cũ, mới và xác nhận mật khẩu mới-->
                    <div class="form-group">
                        <label for="pass">Mật khẩu xác thực (mật khẩu cũ)</label>
                        <div class="col">
                            <input type="password" name="old_pass" class="form-control" value="" placeholder="Mật khẩu xác thực...">
                        </div>
                        <div id="old_pass_err" class="text-danger"></div>
                    </div>
                    <div class="form-group">
                        <label for="pass">Mật khẩu mới</label>
                        <div class="col">
                            <input type="password" name="new_pass" class="form-control" value="" placeholder="Mật khẩu mới...">
                        </div>
                        <div id="new_pass_err" class="text-danger"></div>
                    </div>
                    <div class="form-group">    
                        <label for="pass">Xác nhận mật khẩu mới</label>
                        <div class="col">
                            <input type="password" name="confirm_new_pass" class="form-control" value="" placeholder="Xác nhận mật khẩu...">
                        </div>
                        <div id="confirm_new_pass_err" class="text-danger"></div>
                    </div>
                    <div class="mt-5 text-right">
                        <button id="btn-doi-mat-khau-user" class="btn btn-primary profile-button" type="button">Đổi mật khẩu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-lg">
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