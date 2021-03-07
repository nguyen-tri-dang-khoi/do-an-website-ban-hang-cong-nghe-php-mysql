    
    <?php
        if(!empty($login_err)){
    ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $login_err; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    <?php
        $login_err = "";
        }
    ?>
    <div class="wrapper bg-white">

        <div class="h2 text-center">Website bán hàng</div>
        <div class="h4 text-muted text-center pt-2">Đăng nhập</div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ;?>" class="pt-3">
            <div class="form-group py-2 <?php echo (!empty($email_err)) ? 'has-error' : '' ;?>">
                <div class="input-field"> 
                    <span class="far fa-user p-2"></span> 
                    <input name="email" type="text" placeholder="Email..." > 
                </div>
                <div class="text-danger"><?php echo $email_err;?></div>
            </div>
            <div class="form-group py-1 pb-2 <?php echo (!empty($email_err)) ? 'has-error' : '' ;?>">
                <div class="input-field"> 
                    <span class="fas fa-lock p-2"></span> 
                    <input name="pass" type="password" placeholder="Nhập mật khẩu..." > 
                    <button class="btn bg-white text-muted"> 
                        <span class="far fa-eye-slash"></span> 
                    </button> 
                   
                </div>
                <div class="text-danger"><?php echo $pass_err;?></div>
            </div>
            <div class="d-flex align-items-start">
                <div class="ml-auto"> <a href="#" id="forgot">Quên mật khẩu ?</a> </div>
            </div> <button class="btn btn-block text-center my-3">Đăng nhập</button>
            <div class="text-center pt-3 text-muted">Chưa có tài khoản ?<a href="user_register.php">Đăng ký</a></div>
        </form>
    </div>
