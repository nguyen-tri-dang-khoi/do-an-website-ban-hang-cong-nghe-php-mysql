 <?php
    $level_sidebar = '';
 ?> 
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src=<?php echo $level_sidebar._DIR_['IMG']['ADMINS'].'user8-128x128.jpg'?> alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div style="min-height:1200px;" class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <?php
          if($_SESSION["photo"] == "image.jpg") {
        ?>
            <img src=<?php echo $level_sidebar._DIR_['IMG']['ADMINS'].'user2-160x160.jpg'?> class="img-circle elevation-2" alt="User Image">
        <?php
          } else {
        ?>
            <img src=<?php echo $level_sidebar._DIR_['IMG']['ADMINS']."info/".$_SESSION["photo"]?> class="img-circle elevation-2" alt="User Image">
        <?php
          }
        ?>
          </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["username"];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="admin_info.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Thông tin tài khoản
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin_loai_san_pham.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Quản lý loại sản phẩm
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin_san_pham.php" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Quản lý sản phẩm
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin_don_hang.php" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Quản lý đơn hàng
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin_change_pass.php" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
              Đổi mật khẩu
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin_logout.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
              Đăng xuất
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>