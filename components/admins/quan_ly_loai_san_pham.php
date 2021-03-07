        <!-- /.row -->
        <section class="content content-wrapper">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Quản lý loại sản phẩm</h3>

                <div class="card-tools">
                  <div class="input-group" style="width: 300px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="card-tools">
                  <div class="input-group" style="width: 300px;">
                    <div class="input-group-append">
                      <button id="btn-them-loai-san-pham" class="btn btn-success">
                        Thêm sản phẩm
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Số thứ tự</th>
                      <th>Tên loại sản phẩm</th>
                      <th>Ngày thêm</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                 
                  <tbody id="list-loai-san-pham">
                  <?php
                    $loaisanphams = DP::run_query("Select * from loaisanphams where da_xoa = 0",[],2);
                    foreach($loaisanphams as $loaisanpham) {
                  ?>
                    <tr id="loai-san-pham<?=$loaisanpham["id"];?>">
                      <td><?php echo $loaisanpham["id"];?></td>
                      <td><?php echo $loaisanpham["ten_loai_san_pham"];?></td>
                      <td><?php echo $loaisanpham["created_at"];?></td>
                      <td>
                        <button class="btn-sua-loai-san-pham btn btn-primary"
                          data-name="<?=$loaisanpham["ten_loai_san_pham"];?>"
                          data-id="<?=$loaisanpham["id"];?>">
                        Sửa
                        </button>
                        <button class="btn-xoa-loai-san-pham btn btn-danger" data-name="<?=$loaisanpham["ten_loai_san_pham"];?>"   data-id="<?=$loaisanpham["id"];?>">
                          Xoá
                        </button>
                      </td>
                    </tr>
                  <?php
                    }
                  ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        </section>
        <!-- /.modal -->
        <div class="modal fade" id="modal-xl">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Thông tin loại sản phẩm</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="form-loai-san-pham" action="" method="post">
                  <div class="card-body">
                      <div class="form-group">
                          <label for="ten_loai_san_pham">Tên loại sản phẩm</label>
                          <input type="text" name="ten_loai_san_pham" class="form-control" placeholder="Nhập tên loại sản phẩm">
                          <input type="hidden" name="id">
                      </div>
                      <div id="ten_loai_san_pham_err" class="text-danger"></div>
                    </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                      <button id="btn-luu-loai-san-pham" type="submit" class="btn btn-primary">Thêm loại sản phẩm</button>
                  </div>
                </form>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->