<?php
    include_once('config_admin.php');

    session_start();
    if(!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true){
       header("location:admin_login.php");
       exit();
    }
    $old_pass = $new_pass = $confirm_new_pass = "";
    $old_pass_err = $new_pass_err = $confirm_new_pass_err = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty($_POST["old_pass"])){
            $old_pass_err = "Vui lòng không để trống ô nhập mật khẩu cũ";
        } else {
            $old_pass = $_POST["old_pass"];
        }

        if(empty(trim($_POST["new_pass"]))){
            $new_pass_err = "Vui lòng không để trống ô mật khẩu mới";
        } elseif(strlen(trim($_POST["new_pass"])) < 6) {
            $new_pass_err = "Mật khẩu mới phải từ 6 ký tự trở lên";
        } else {
            $new_pass = $_POST["new_pass"];
        }

        if(empty($_POST["confirm_new_pass"])){
            $confirm_new_pass_err = "Vui lòng không để trống ô xác nhận mật khẩu.";
        } elseif(!empty($new_pass_err) || ($_POST["confirm_new_pass"] != $new_pass)) {
            if(!empty($new_pass_err)) {
                $confirm_new_pass_err = $new_pass_err;
            } elseif($_POST["confirm_new_pass"] != $new_pass) {
                $confirm_new_pass_err = "Bạn xác nhận mật khẩu không khớp với mật khẩu bạn nhập.";
            }
        }

        if(empty($old_pass_err) && empty($new_pass_err) && empty($confirm_new_pass_err)){
            $auth = DP::run_query("select password from admins where id = ?",[$_SESSION["id"]],2);
            if(password_verify($old_pass,$auth[0]["password"])){
                $new_pass = password_hash($new_pass,PASSWORD_DEFAULT);
                $update_new_pass = DP::run_query("Update admins set password = ? where id = ?",[$new_pass,$_SESSION["id"]],1);
                if($update_new_pass){
                    echo json_encode(array(
                        "statusCode"=>200,
                    ));
                    exit();
                } else {
                    echo json_encode(array(
                        "statusCode"=>201,
                    ));
                    exit();
                }
            } else {
                echo json_encode(array(
                    "auth"=>"Bạn nhập mật khẩu cũ không chính xác",
                    "statusCode"=>203,
                ));
                exit();
            }
        } else {
            echo json_encode(array(
                "statusCode"=>202,
                "old_pass_err"=>$old_pass_err,
                "new_pass_err"=>$new_pass_err,
                "confirm_new_pass_err"=>$confirm_new_pass_err,
            ));
            exit();
        }
    }
    $_isChangePassPage = true;
    include_once($level_config_layout.'layout.php');
?>