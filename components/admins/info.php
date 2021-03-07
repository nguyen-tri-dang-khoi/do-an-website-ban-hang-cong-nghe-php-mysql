<?php
    $admin_info = DP::run_query("select * from admins where id = ?",[(int)$_SESSION["id"]],2);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Hồ sơ</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Thông tin admin</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div style="display:block;" class="tab-pane" id="settings">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" id="form-admin" method="post" class="form-horizontal" enctype='multipart/form-data'>
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Họ tên</label>
                        <div class="col-sm-10">
                          <input name="name" type="text" class="form-control" value=<?=$admin_info[0]["name"];?>>
                        </div>
                        <!-- loi ho ten -->
                        <div id="name_err" class="text-danger"></div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input name="email" type="email" class="form-control" value=<?=$admin_info[0]["email"];?>>
                        </div>
                        <!-- loi email -->
                        <div id="email_err" class="text-danger"></div>
                      </div>
                      <div class="form-group row">
                        <label for="pass" class="col-sm-2 col-form-label">Mật khẩu xác thực</label>
                        <div class="col-sm-10">
                          <input name="old_pass" type="password" class="form-control" required>
                        </div>
                        <!-- loi mat khau -->
                        <div id="pass_err" class="text-danger"></div>
                      </div>

                      <div class="form-group row">
                        <label for="birth" class="col-sm-2 col-form-label">Ngày sinh</label>
                        <div class="col-sm-10">
                          <input name="birth" type="text" class="form-control" id="ngay_sinh_admin" value=<?=$admin_info[0]["birth"];?>>
                        </div>
                        <!-- loi ngay sinh -->
                        <div id="birth_err" class="text-danger"></div>
                      </div>


                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Ngày tạo tài khoản</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" value=<?=$admin_info[0]["ngay_tao_tai_khoan"];?> readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Số điện thoại</label>
                        <div class="col-sm-10">
                          <input name="phone" type="text" class="form-control" value=<?=$admin_info[0]["phone"];?> >
                        </div>
                        <!-- loi so dien thoai -->
                        <div id="phone_err" class="text-danger"></div>
                      </div>
                      <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Địa chỉ</label>
                        <div class="col-sm-10">
                          <input name="address" type="text" class="form-control" value="<?=$admin_info[0]["address"];?>">
                        </div>
                        <!-- loi dia chi -->
                        <div id="address_err" class="text-danger"></div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputFile" class="col-sm-2 col-form-label">Ảnh đại diện</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input id="fileInput" name="img_admin_file" type="file" accept="image/*" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Upload ảnh đại diện</label>
                            </div>
                        </div>
                        <?php
                          if($admin_info[0]["photo"] == "image.jpg") {
                        ?>
                            <div class="img-fluid" id="where-replace">
                                <span></span>
                            </div>
                        <?php
                          } else {
                        ?>
                            <img width="200" height="200" src="../img/img-admin/info/<?=$admin_info[0]["photo"]?>" data-img='<?=$admin_info[0]["photo"]?>' class='img-fluid' id='display-image'/>
                        <?php
                          }
                        ?>
                        <!-- loi hinh anh -->
                        <div id="image_err" class="text-danger"></div>
                    </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button id="btn-cap-nhat-admin" type="submit" class="btn btn-danger">Cập nhật</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->