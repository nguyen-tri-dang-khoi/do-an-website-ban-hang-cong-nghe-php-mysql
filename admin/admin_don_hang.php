<?php
     include_once('config_admin.php');

     session_start();
     if(!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true){
        header("location:admin_login.php");
        exit();
     }
     $id = "";
     $id_err = "";
     if($_SERVER["REQUEST_METHOD"] == "POST") {
      if($_POST["func"] == "1") {
         if(empty(trim($_POST["id"]))){
            $id_err = "Error! Not empty id.";
         } else {
            $id = (int)$_POST["id"];
         }

         if(empty($id_err)) {
            $cap_nhat_tinh_trang_thanh_toan = DP::run_query("update hoadons set tinh_trang_thanh_toan = 1 where id = ?",[$id],1);
            if($cap_nhat_tinh_trang_thanh_toan) {
               echo json_encode(array("statusCode"=>200));
               exit();
            }
         }
         $id_err = "";
      } elseif($_POST["func"] == "-1") {
         if(empty(trim($_POST["id"]))){
            $id_err = "Error! Not empty id.";
         } else {
            $id = (int)$_POST["id"];
         }

         if(empty($id_err)) {
            $chi_tiet_hoa_dons = DP::run_query("select ten_san_pham as 'name', hinh_anh as 'image', chitiethoadons.so_luong as 'count',chitiethoadons.don_gia as 'price' from chitiethoadons,sanphams where chitiethoadons.hoa_don_id = ? and chitiethoadons.san_pham_id = sanphams.id",[(int)$id],2);
            $arr = array();
            if(count($chi_tiet_hoa_dons)) {
               foreach($chi_tiet_hoa_dons as $cthd) {
                  array_push($arr,
                     [
                        "name"=>$cthd["name"],
                        "count"=>$cthd["count"],
                        "price"=>$cthd["price"],
                        "image"=>$cthd["image"],
                     ]
                  );
               }
               echo json_encode($arr);
               exit();
            }
         }
         $id_err = "";
      } elseif($_POST["func"] == "0") {
         if(empty(trim($_POST["id"]))){
            $id_err = "Error! Not empty id.";
         } else {
            $id = (int)$_POST["id"];
         }

         if(empty($id_err)) {
            $thong_tin_nguoi_dung = DP::run_query("select name,email,birth,phone,address,photo from users where id = ?",[$id],2);
            if(count($thong_tin_nguoi_dung)) {
               echo json_encode(array(
                  "statusCode"=>200,
                  "name"=>$thong_tin_nguoi_dung[0]["name"],
                  "email"=>$thong_tin_nguoi_dung[0]["email"],
                  "birth"=>$thong_tin_nguoi_dung[0]["birth"],
                  "phone"=>$thong_tin_nguoi_dung[0]["phone"],
                  "address"=>$thong_tin_nguoi_dung[0]["address"],
                  "image"=>$thong_tin_nguoi_dung[0]["photo"],
               ));
               exit();
            }
         }
         $id_err = "";
      } else {
         $id_err = "";
      }
     }
     $_isBillPage = true;
     include_once($level_config_layout.'layout.php');
?>