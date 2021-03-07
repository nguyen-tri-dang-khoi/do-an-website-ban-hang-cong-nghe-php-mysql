

<body class="hold-transition login-page">
    
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
        }
    ?>
    <div class="login-box">
        <div class="login-logo">
            <a href="index.php"><b>Website bán hàng</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
            <p class="login-box-msg">Đăng nhập</p>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                <div class="input-group mb-3">
                    <div class="input-group">
                        <input type="email" name="email" class="form-control  <?php empty($email_err) ? 'has-error' :'' ;?>" placeholder="Email">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <div class="text-danger"><?php echo $email_err?></div>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group">
                        <input type="password" name="password" class="form-control <?php empty($pass_err) ? 'has-error' :'' ;?>" placeholder="Password">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <div class="text-danger"><?php echo $pass_err?></div>
                </div>
                <div class="row">
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                </div>
                <!-- /.col -->
                </div>
            </form>
            <!-- /.social-auth-links -->
            <!-- /.login-card-body -->
        </div>
    </div>
