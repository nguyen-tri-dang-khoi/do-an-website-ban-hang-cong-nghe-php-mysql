
<div class="container">
    <?php
        if(!empty($register_err)){
    ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $login_err; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    <?php
        $register_err = "";
        }
    ?>
    <div class="card bg-light">
        <article class="card-body mx-auto" style="width:50%;">
            <h4 class="card-title mt-3 text-center">Đăng ký tài khoản</h4>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                <div class="form-group input-group">
                    <div class="input-group">
                        <input name="name" class="form-control" placeholder="Tên đầy đủ..." type="text">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    
                    <div class="text-danger help-block"><?php echo $name_err; ?></div>
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group">
                        <input name="email" class="form-control" placeholder="Email..." type="email">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    
                    <div class="text-danger"><?php echo $email_err; ?></div>
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group">
                        <input name="phone" class="form-control" placeholder="Số điện thoại..." type="text">
                        <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                    </div>
                    
                    <div class="text-danger"><?php echo $phone_err; ?></div>
                </div>

                <div class="form-group input-group">
                    <div class="input-group">
                        <input name="password" class="form-control" placeholder="Nhập mật khẩu" type="password">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                   
                    <div class="text-danger"><?php echo $pass_err; ?></div>
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group">
                    <input name="confirm_password" class="form-control" placeholder="Xác nhận mật khẩu" type="password">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <div class="text-danger"><?php echo $confirm_pass_err; ?></div>
                </div> <!-- form-group// -->                                      
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
                </div> <!-- form-group// -->      
                <p class="text-center">Bạn đã có tài khoản ? <a href="user_login.php">Đăng nhập</a> </p>                                                                 
            </form>
        </article>
    </div> <!-- card.// -->
</div> 
<!--container end.//-->