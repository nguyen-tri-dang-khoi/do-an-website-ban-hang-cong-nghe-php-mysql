<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Đổi mật khẩu</h1>
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
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Đổi mật khẩu</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div style="display:block;" class="tab-pane" id="settings">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" id="form-admin" method="post" class="form-horizontal" enctype='multipart/form-data'>
                      <div class="form-group row">
                        <label for="old_pass" class="col-sm-2 col-form-label">Mật khẩu xác thực</label>
                        <div class="col-sm-10">
                          <input name="old_pass" type="password" class="form-control" required>
                        </div>
                        <!-- loi mat khau -->
                        <div id="old_pass_err" class="text-danger"></div>
                      </div>
                      <div class="form-group row">
                        <label for="new_pass" class="col-sm-2 col-form-label">Mật khẩu mới</label>
                        <div class="col-sm-10">
                          <input name="new_pass" type="password" class="form-control" required>
                        </div>
                        <!-- loi mat khau -->
                        <div id="new_pass_err" class="text-danger"></div>
                      </div>
                      <div class="form-group row">
                        <label for="confirm_new_pass" class="col-sm-2 col-form-label">Xác nhận mật khẩu mới</label>
                        <div class="col-sm-10">
                          <input name="confirm_new_pass" type="password" class="form-control" required>
                        </div>
                        <!-- loi xac nhan mat khau -->
                        <div id="confirm_new_pass_err" class="text-danger"></div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button id="btn-doi-mat-khau-admin" type="submit" class="btn btn-danger">Cập nhật</button>
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