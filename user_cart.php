<?php
    include_once('config_user.php');
    $_isUserCartPage = true;

    session_start();

    if(!isset($_SESSION["isUserLoggedIn"]) || $_SESSION["isUserLoggedIn"] !== true){
        header("location:user_login.php");
        exit();
    } 
    $thao_tac =""; 
    $count = $position = 0;
    $thao_tac_err = $count_err = $position_err ="";
    // chức năng xoá sửa giỏ hàng.
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(!isset($_POST["bill"]) || $_POST["bill"] !== "1")
        {
            
            if(empty(trim($_POST["thao_tac"]))){
                $thao_tac_err = "Vui lòng không để trống thao tác";
            } else {
                $thao_tac = trim($_POST["thao_tac"]);
            }
    
            if(empty(trim($_POST["count"]))){
                $count_err = "Vui lòng không để trống số lượng";
            } else {
                $count = (int)trim($_POST["count"]);
            }
    
            if(empty(trim($_POST["position"])) && $_POST["position"] != '0'){
                $position_err = "Vui lòng không để trống vị trí.";
            } else {
                $position = trim($_POST["position"]);
               
            }
            
            if(empty($thao_tac_err) && empty($position_err) && empty($count_err)){
                if($thao_tac == "Sửa") {
                    $_SESSION["cart"][$position]["count"] = $count;
                    $_SESSION["cart"][$position]["money"] = $_SESSION["cart"][$position]["count"] * $_SESSION["cart"][$position]["price"];
                    $money = $_SESSION["cart"][$position]["money"];
                    echo json_encode(array(
                        "position"=>$position,
                        "count"=>$count,
                        "money"=>$money,
                    ));
                    exit();
                } elseif($thao_tac == "Xoá") {
                    array_splice($_SESSION["cart"],$position,1);
                    echo json_encode(array(
                        "position"=>$position,
                        "count"=>$count,
                    ));
                    exit();
                }
               
            }
        } else {
            $cart_err = "";  
            if($_SESSION["cart"] == array() || !isset($_SESSION["cart"])){
                $cart_err = "Giỏ hàng của bạn đang trống.";
            } else {
                $insert_bill = DP::run_query("insert into hoadons(user_id,dia_chi_nhan_hang) values(?,?)",[(int)$_SESSION["id"],$_SESSION["address"]],3);
                if($insert_bill > 0) {
                    foreach($_SESSION["cart"] as $cart) {
                        $insert = DP::run_query("insert into chitiethoadons(hoa_don_id,san_pham_id,so_luong,don_gia) values(?,?,?,?)",[$insert_bill,$cart["id_san_pham"],$cart["count"],$cart["price"]],1);
                        $get_count = DP::run_query("select so_luong from sanphams where id = ?",[$cart["id_san_pham"]],2);
                        $update_count = DP::run_query("update sanphams set so_luong = ? where id = ?",[(int)$get_count[0]["so_luong"] - (int)$cart["count"],$cart["id_san_pham"]],1);
                    }
                }
            }
            $_SESSION["cart"] = array();
        }
        
    }

    include_once($level_config_layout.'layout.php');
?>