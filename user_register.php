<?php

    include_once('config_user.php');

    $name = $email = $phone = $password = $confirm_password = "";
    $name_err = $email_err = $phone_err = $pass_err = $confirm_pass_err = "";
    $register_err = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // kiem tra ten dang nhap
        if(empty(trim($_POST["name"]))){
            $name_err = "Vui lòng không để trống tên.";
        } else {
            $name = trim($_POST["name"]);
        }

        // kiem tra email
        if(empty(trim($_POST["email"]))){
            $email_err = "Vui lòng không để trống email.";
        } elseif(!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)){
            $email_err = "Vui lòng nhập đúng định dạng email.";
        } else {
            $email = trim($_POST["email"]);
        }

        // kiem tra so dien thoai
        if(empty(trim($_POST["phone"]))){
            $phone_err = "Vui lòng không để trống số điện thoại.";
        } else {
            $phone = trim($_POST["phone"]);
        }

        // kiem tra password
        if(empty(trim($_POST["password"]))){
            $pass_err = "Vui lòng không để trống mật khẩu.";
        } elseif(strlen(trim($_POST["password"])) < 6) {
            $pass_err = "Mật khẩu bạn nhập bắt buộc phải có 6 ký tự trở lên.";
        } else {
            $pass = trim($_POST["password"]);
        }

        // kiem tra confirm_password
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_pass_err = "Vui lòng không để trống xác nhận mật khẩu.";
        } elseif(empty($pass_err) && ($pass != trim($_POST["password"]))){
            $confirm_pass_err = "Bạn xác nhận mật khẩu không đúng với mật khẩu bạn nhập.";
        }

        if(empty($email_err) && empty($pass_err) && empty($phone_err) && empty($name_err) && empty($confirm_pass_err)){
            $isExist = DP::run_query("select id from users where name = ? or email = ?",[$name,$email],2);
            if(count($isExist) > 0){
                $register_err = "Tên tài khoản hoặc email này đã tồn tại. Vui lòng đăng ký lại";
            } else {
                $insert = DP::run_query("insert into users(name,email,password,phone) values(?,?,?,?)",[$name,$email,password_hash($pass,PASSWORD_DEFAULT),$phone],3);
                if($insert > 0){
                    header("location: user_login.php");
                }
            }
        }
    }

    $_isUserRegisterPage = true;
    include_once($level_config_layout.'layout.php');
?>