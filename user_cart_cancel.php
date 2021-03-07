<?php
    include_once 'config_user.php';
    session_start();
    if(!isset($_SESSION["isUserLoggedIn"]) || $_SESSION["isUserLoggedIn"] !== true){
        header("location:user_login.php");
        exit();
    }
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION["cart"] = array();
        echo json_encode(
            array(
                "statusCode"=>200,
                "msg"=>"Bạn đã huỷ giỏ hàng thành công.",
            ));
        exit();
    }
?>