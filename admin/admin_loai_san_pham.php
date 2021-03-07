<?php
     include_once('config_admin.php');
     session_start();
     if(!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true){
        header("location:admin_login.php");
        exit();
     }
     $ten_loai_san_pham = "";
     $ten_loai_san_pham_err = "";
     $id = "";
     $thao_tac = "";
     if($_SERVER["REQUEST_METHOD"]=="POST"){
        $thao_tac = trim($_POST["thao_tac"]);
        if(!empty($_GET["id"])){
            $id = trim($_GET["id"]);
            if($thao_tac == "Xoá"){
                // Xoá loại sản phẩm
               if(!empty(trim($_POST["name"]))){
                  $ten_loai_san_pham = trim($_POST["name"]);
               }
               $delete = DP::run_query("Update loaisanphams set da_xoa = 1 where id = ?",[$id],1);
               if($delete){
                  echo json_encode(array(
                     "statusCode"=>200,
                     "id"=>$id,
                     "ten_loai_san_pham"=>$ten_loai_san_pham,
                  ));
                  exit();
               } else {
                  echo json_encode(array("statusCode"=>201));
                  exit();
               }
            }
        }
        if(empty(trim($_POST["name"]))){
            $ten_loai_san_pham_err = "Vui lòng không để trống tên loại sản phẩm";
        } else {
           $ten_loai_san_pham = trim($_POST["name"]);
        }

        
         
        if(empty($ten_loai_san_pham_err)){
           $isExist = DP::run_query("Select id from loaisanphams where ten_loai_san_pham = ?",[$ten_loai_san_pham],2);
           if(count($isExist) > 0){
              $ten_loai_san_pham_err = "Tên loại sản phẩm này đã tồn tại.";
           } else {
              // Thêm loại sản phẩm
              if($thao_tac == "Thêm"){
                  $insert = DP::run_query("Insert into loaisanphams(ten_loai_san_pham) values(?)",[$ten_loai_san_pham],3);
                  if($insert > 0){
                     echo json_encode(array(
                        "statusCode"=>200,
                        "id"=>$insert,
                        "ten_loai_san_pham"=>$ten_loai_san_pham,
                        "created_at"=>date('Y-m-d H-i-s',time()),
                     ));
                     exit();
                  } else {
                     echo json_encode(array("statusCode"=>201));
                     exit();
                  }
               }
           }

           // Sửa loại sản phẩm
           if($thao_tac == "Sửa"){
               $update = DP::run_query("Update loaisanphams set ten_loai_san_pham = ? where id = ?",[$ten_loai_san_pham,$id],1);
               if($update){
                  echo json_encode(array(
                     "statusCode"=>200,
                     "id"=>$id,
                     "ten_loai_san_pham"=>$ten_loai_san_pham,
                     "created_at"=>date('Y-m-d H-i-s',time()),
                  ));
                  exit();
               } else {
                  echo json_encode(array("statusCode"=>201));
                  exit();
               }
           }
        } else {
            echo json_encode(array(
               "statusCode"=>202,
               "ten_loai_san_pham_err"=>$ten_loai_san_pham_err,
            ));
            exit();
        }
     }
     $_isLoaiSanPham = true;
     include_once($level_config_layout.'layout.php');
?>