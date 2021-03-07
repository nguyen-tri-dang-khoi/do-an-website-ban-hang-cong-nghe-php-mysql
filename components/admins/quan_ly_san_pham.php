<!-- Main content -->

<section class="content">
      <div class="container" style="margin-left:250px;">
        <div class="row" >
          
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Quản lý sản phẩm</h3>
                <div class="card-tools">
                  <div class="input-group" style="width: 300px;">
                    <div class="input-group-append">
                      <button id="btn-them-san-pham" class="btn btn-success">
                        Thêm sản phẩm
                      </button>
                    </div>
                  </div>
                </div>
            </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Tên sản phẩm</th>
                    <th>Mô tả sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Phân loại sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Ngày đăng</th>
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
                    $query = "select sanphams.id, ten_san_pham, ten_loai_san_pham,loai_san_pham_id, mo_ta_san_pham, don_gia, so_luong, hinh_anh, ngay_dang";
                    $query.= " from sanphams, loaisanphams";
                    $query.= " where sanphams.loai_san_pham_id = loaisanphams.id and sanphams.da_xoa = 0 limit ?,?";
                    $sanphams = DP::run_query($query,[$min - 1,$num_row],2);
                    foreach($sanphams as $sanpham) {
                  ?>
                    <tr id="san-pham<?=$sanpham["id"];?>">
                        <td><?=$sanpham['ten_san_pham']?></td>
                        <td>...</td>
                        <td id="mo_ta_sp<?=$sanpham["id"];?>" style="display:none;"><?=$sanpham['mo_ta_san_pham']?></td>
                        <td><?=$sanpham['so_luong']?></td>
                        <td><?=$sanpham['don_gia']?></td>
                        <td><?=$sanpham['ten_loai_san_pham']?></td>
                        <td><img width="100" height="100" src="<?php echo _DIR_["IMG"]["ADMINS"].'product/'.$sanpham['hinh_anh']?>" alt=""></td>
                        <td><?=$sanpham['ngay_dang']?></td>
                        <td>
                            <button class="btn-sua-san-pham btn btn-primary"
                            data-name="<?=$sanpham["ten_san_pham"];?>"
                            data-id="<?=$sanpham["id"];?>" 
                            data-count="<?=$sanpham["so_luong"];?>"
                            data-price="<?=$sanpham["don_gia"];?>"
                            data-name_type="<?=$sanpham["loai_san_pham_id"];?>"
                            data-image="<?=$sanpham["hinh_anh"];?>">
                            Sửa
                            </button>
                            <button class="btn-xoa-san-pham btn btn-danger" data-name="<?=$sanpham["ten_san_pham"];?>" data-id="<?=$sanpham["id"];?>">
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
                                <a href="admin_san_pham.php?page=<?php echo $i;?>" aria-controls="example1" data-dt-idx="<?php echo $i;?>" tabindex="0" class="page-link"><?php echo $i;?></a>
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
              <h4 id="msg-del" class="modal-title">Thông tin sản phẩm</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              
            </div>
            <div class="modal-body">
               <form id="form-san-pham" method="post" enctype='multipart/form-data'>
        <div class="card-body">
            <div class="form-group">
                <label for="ten_san_pham">Tên sản phẩm</label>
                <input type="text" name="ten_san_pham" class="form-control" placeholder="Nhập tên sản phẩm...">
                <div id="name_err" class="text-danger"></div>
            </div>
            <div class="form-group">
                <label>Chọn loại sản phẩm</label>
                <select name="phan_loai_san_pham" class="form-control">
                    <?php
                      $loaisanphams = DP::run_query('select id,ten_loai_san_pham from loaisanphams where da_xoa=0',[],2);
                      foreach($loaisanphams as $loaisanpham) {
                    ?>
                        <option value="<?=$loaisanpham["id"];?>"><?=$loaisanpham["ten_loai_san_pham"]?></option>
                    <?php
                      }
                    ?>
                </select>
                <div id="name_type_err" class="text-danger"></div>
            </div>
            <div class="form-group">
                <label for="so_luong">Số lượng</label>
                <input type="number" name="so_luong" min="1" class="form-control" placeholder="Nhập số lượng">
                <div id="count_err" class="text-danger"></div>
            </div>

            <div class="form-group">
                <label for="don_gia">Đơn giá</label>
                <input type="number" name="don_gia" min="1" max="100000000000" class="form-control" placeholder="Nhập đơn giá">
                <div id="price_err" class="text-danger"></div>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Tải ảnh sản phẩm lên</label>
                <div class="input-group">
                  <div class="custom-file">
                      <input id="fileInput" name="hinh_anh" type="file" accept="image/*" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Chọn ảnh</label>
                  </div>
                </div>
                <div class="img-fluid" id="where-replace">
                    <span></span>
                </div>
                <div id="image_err" class="text-danger"></div>
            </div>
            <div class="form-group">
                <label for="mo_ta_san_pham">Mô tả sản phẩm</label>
                <textarea name="mo_ta_san_pham" id="summernote">
                    Place <em>some</em> <u>text</u> <strong>here</strong>
                </textarea>
                <div id="name_desc_err" class="text-danger"></div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button id="btn-luu-san-pham" type="submit" class="btn btn-primary">Đăng sản phẩm lên</button>
            <input type="hidden" name="id" value="">      
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