<?php
    include_once('config_admin.php');

    $user_err = $pass_err = $confirm_pass_err = $email_err = "";
    $user = $pass = $confirm_pass = $email = "";
    $register_err = "";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        // kiem tra username
        if(empty(trim($_POST["username"]))){
            $user_err = "Vui lòng không để trống tên đăng nhập.";
        } else {
            $user = trim($_POST["username"]);
        }

        // kiem tra password
        if(empty(trim($_POST["password"]))){
            $pass_err = "Vui lòng không để trống mật khẩu.";
        } elseif(strlen(trim($_POST["password"])) < 6) {
            $pass_err = "Mật khẩu bạn nhập bắt buộc phải có 6 ký tự trở lên.";
        } else {
            $pass = trim($_POST["password"]);
        }

        // kiem tra xac nhan mat khau
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_pass_err = "Vui lòng không để trống xác nhận mật khẩu.";
        } elseif(empty($pass_err) && ($pass != trim($_POST["password"]))){
            $confirm_pass_err = "Bạn xác nhận mật khẩu không đúng với mật khẩu bạn nhập.";
        }


        // kiem tra email
        if(empty(trim($_POST["email"]))){
            $email_err = "Vui lòng không để trống email";
        } elseif(!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)){
            $email_err = "Vui lòng nhập đúng định dạng email (bao gồm @).";
        } else {
            $email = trim($_POST["email"]);
        }

        if(empty($user_err) && empty($pass_err) && empty($email_err) && empty($confirm_pass_err)){
            $isExist = DP::run_query("select id from admins where name = ?",[$user],2);
            $register_err = "";
            if(count($isExist) > 0){
                $register_err = "Tên đăng nhập hoặc email này đã tồn tại.";
            }
            if(empty($register_err))
            {
                $password = password_hash($pass,PASSWORD_DEFAULT);
                $isInsert = DP::run_query("Insert into admins(name,email,password) value(?,?,?)",[$user,$email,$password],1);
                if($isInsert)
                {
                    header("location:index.php");
                    $_SESSION["isLoggedIn"] = true;
                    $_SESSION["username"] = $username;
                    $_SESSION["email"] = $email;
                }
            }
        }
    }
    include_once('config_admin.php');
    $_isRegisterPage = true;
    include_once($level_config_layout.'layout.php');
?>