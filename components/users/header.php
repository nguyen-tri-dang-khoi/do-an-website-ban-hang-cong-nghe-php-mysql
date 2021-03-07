<div id="wrapper">
 <!-- ****** Header Area Start ****** -->
 <header class="header_area bg-img background-overlay-white" style="background-image: url(<?php echo _DIR_['IMG']['USERS'].'bg-img/'.'bg-1.jpg';?>)">
            <!-- Top Header Area Start -->
            <div class="top_header_area">
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-end">

                        <div class="col-12 col-lg-7">
                            <div class="top_single_area d-flex align-items-center">
                                <!-- Logo Area -->
                                <div class="top_logo">
                                    <a href="#"><img width="150" height="150" src=<?php echo _DIR_['IMG']['USERS'].'core-img/'.'logo-2.jpg';?> alt=""></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Top Header Area End -->
            <div class="main_header_area">
                <div class="container h-100">
                    <div class="row h-100">
                        <div class="col-12 d-md-flex justify-content-between">
                            <!-- Menu Area -->
                            <div class="main-menu-area">
                                <nav class="navbar navbar-expand-lg align-items-start">

                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#karl-navbar" aria-controls="karl-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"><i class="ti-menu"></i></span></button>

                                    <div class="collapse navbar-collapse align-items-start collapse" id="karl-navbar">
                                        <ul class="navbar-nav animated" id="nav">
                                            <li class="nav-item active"><a class="nav-link" href="index.php">Trang chủ</a></li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="karlDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mục chọn</a>
                                                <div class="dropdown-menu" aria-labelledby="karlDropdown">
                                                    <a class="dropdown-item" href="index.php">Menu</a>
                                                    <a class="dropdown-item" href="user_info.php">Thông tin cá nhân</a>
                                                    <a class="dropdown-item" href="user_cart.php">Giỏ hàng</a>
                                                    <a class="dropdown-item" href="user_logout.php">Đăng xuất</a>
                                                </div>
                                            </li>
                                            <li class="nav-item"><a class="nav-link" href="user_cart.php">Giỏ hàng của bạn</a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <div class="main-menu-area">
                                <nav class="navbar navbar-expand-lg align-items-start">

                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#karl-navbar" aria-controls="karl-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"><i class="ti-menu"></i></span></button>

                                    <div class="collapse navbar-collapse align-items-start collapse" id="karl-navbar">
                                        <ul class="navbar-nav animated" id="nav">
                                            
                                            <?php
                                                if(!isset($_SESSION["isUserLoggedIn"]) || $_SESSION["isUserLoggedIn"] === false ){
                                            ?>      
                                                <li class="nav-item">
                                                    <a class="nav-link" href="user_login.php">Đăng nhập</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="user_register.php">Đăng ký</a>
                                                </li>
                                            <?php
                                                } else {

                                            ?>
                                                <li class="nav-item">
                                                    <a class="btn btn-info nav-link" href="user_info.php">
                                                        Xin chào: 
                                                        <?php
                                                            if($_SESSION["photo"] == "image.jpg") {
                                                        ?>
                                                                <img width="50" height="50" class="rounded-circle" src=<?php echo _DIR_['IMG']['USERS'].'info/image.jpg';?> alt="">
                                                        <?php
                                                            } else {
                                                        ?>
                                                                <img width="50" height="50" class="rounded-circle" src=<?php echo _DIR_['IMG']['USERS'].'info/'.$_SESSION["photo"];?> alt="">
                                                        <?php
                                                            }
                                                        ?>
                                                        <?php echo $_SESSION["name"];?>    
                                                    </a>
                                                </li>
                                            <?php
                                                }
                                            ?>
                                           
                                           
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ****** Header Area End ****** -->
        