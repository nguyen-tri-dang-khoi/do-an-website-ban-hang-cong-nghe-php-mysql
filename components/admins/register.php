

<body class="hold-transition register-page">
    <?php
        if(!empty($register_err)){
    ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $register_err; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    <?php
        }
    ?>
    <div class="register-box">
        <div class="register-logo">
            <b>Website bán hàng</b> 
        </div>

        <div class="card">
            <div class="card-body register-card-body">
            <p class="login-box-msg">Hãy đăng ký ngay để trở thành admin</p>
            <!--Register form-->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                <!--Username-->
                <div class="input-group mb-3 <?php echo (!empty($user_err)) ? 'has-error' : '' ;?>">
                   
                    <div class="input-group">
                        <input type="text" name="username" class="form-control" placeholder="Username...">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <div class="text-danger"><?php echo $user_err; ?></div>
                </div>
                <!--Email-->
                <div class="input-group mb-3">
                    <div class="input-group">
                        <input type="email" name="email" class="form-control <?php empty($email_err) ? 'has-error' :'' ;?>" placeholder="Email...">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <div class="text-danger"><?php echo $email_err; ?></div>
                </div>
                <!--Password-->
                <div class="input-group mb-3">
                    <div class="input-group">
                        <input type="password" name="password" class="form-control <?php empty($pass_err) ? 'has-error' : '' ;?>" placeholder="Password...">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <div class="text-danger"><?php echo $pass_err; ?></div>
                </div>
                <!--Confirm password-->
                <div class="input-group mb-3">
                    <div class="input-group">
                        <input type="password" name="confirm_password" class="form-control <?php empty($confirm_pass_err) ? 'has-error' : '' ;?>" placeholder="Confirm password...">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <div class="text-danger"><?php echo $confirm_pass_err; ?></div>
                </div>
                <div class="row">
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
                </div>
            </form>

            <a href="admin_login.php" class="text-center">Tôi là admin</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>