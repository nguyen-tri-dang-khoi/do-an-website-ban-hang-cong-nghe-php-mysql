<?php
    include_once('config_user.php');
    $_isUserIndexPage = true;
    session_start();
    
    $id = $name = $price = $count = $money = $image = "";

    // bình luận
    $comment = "";
    $comment_err = "";
    $id_err = $name_err = $price_err = $count_err = $money_err = $image_err = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // tính năng thêm giỏ hàng
        if(!isset($_POST["comment"])) {
            if(empty(trim($_POST["id_san_pham"]))){
                $id_err = "Vui lòng không để trống id sản phẩm.";
            } else {
                $id = trim($_POST["id_san_pham"]);
            }
    
            if(empty(trim($_POST["name"]))){
                $name_err = "Vui lòng không để trống tên sản phẩm.";
            } else {
                $name = trim($_POST["name"]);
            }
    
            if(empty($_POST["count"])){
                $count_err = "Vui lòng không để trống số lượng sản phẩm.";
            } else {
                $count = (int)$_POST["count"];
            }
    
            if(empty(trim($_POST["price"]))){
                $price_err = "Vui lòng không để trống đơn giá sản phẩm.";
            } else {
                $price = (int)trim($_POST["price"]);
            }
    
            if(empty(trim($_POST["image"]))){
                $image_err = "Vui lòng không để trống tên file hình ảnh.";
            } else {
                $image = trim($_POST["image"]);
            }
            if(empty($name_err) && empty($count_err) && empty($price_err) && empty($image_err)){
                $money = $count * $price;
                $val = array(
                    "id_san_pham"=>$id,
                    "name" =>$name,
                    "price"=>$price,
                    "count"=>$count,
                    "money"=>$money,
                    "image"=>$image
                );
                $test = false;
                $i = 0;
                foreach($_SESSION["cart"] as $cart) {
                    if($val["name"] == $cart["name"]) {
                        $test = true;
                        $cart["count"] = $cart["count"] + $val["count"];
                        $cart["money"] = $cart["count"] * $cart["price"];
                        $_SESSION["cart"][$i]["count"] = $cart["count"];
                        $_SESSION["cart"][$i]["money"] = $cart["money"];
                        break; 
                    }
                    $i++;
                }
                if($test == false) {
                    array_push($_SESSION["cart"],$val);
                   
                }
                echo json_encode(array("statusCode"=>200,));
                exit();
            } else {
                echo json_encode(array("statusCode"=>201,));
                exit();
            }
        }

        // tính năng bình luận
        else {
            $id = -1;
            if(empty(trim($_POST["comment"]))) {
                $comment_err = "Vui lòng nhập nội dung bình luận.";
            } else {
                $id = (int)$_POST["san_pham_id"];
                $comment = trim($_POST["comment"]);
                if(empty($comment_err)) {
                    $comment = trim($_POST["comment"]);
                    $insert_comment = DP::run_query("insert into binhluans(user_id,san_pham_id,noi_dung_binh_luan) values(?,?,?)",[(int)$_SESSION["id"],$id,$comment],3);
                    if($insert_comment) {
                        $comment = DP::run_query("select binhluans.id as 'id',name,photo,noi_dung_binh_luan as 'comment' from users,binhluans where binhluans.id = ? and binhluans.user_id = users.id",[$insert_comment],2);
                        echo json_encode(array(
                            "id"=>$comment[0]["id"],
                            "name"=>$comment[0]["name"],
                            "photo"=>$comment[0]["photo"],
                            "comment"=>$comment[0]["comment"],
                            "time"=>date('Y-m-d H-i-s',time()),));
                        exit();
                    }
                }
            }
        }
        
    }
    include_once($level_config_layout.'layout.php');
?>