<?php
     include_once('config_admin.php');
     session_start();
     if(!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true){
        header("location:admin_login.php");
        exit();
     }
     $msg_success = "";
     $name = $name_desc = $image = $price = $count = $name_type = "";
     $name_err = $name_desc_err = $image_err = $price_err = $count_err = $name_type_err = "";
     $id = "";
     $thao_tac = "";
     if($_SERVER["REQUEST_METHOD"]=="POST"){
        $thao_tac = trim($_POST["thao_tac"]);
        if(!empty($_POST["id"])){
            $id = trim($_POST["id"]);
            if($thao_tac == "Xoá"){
                // Xoá sản phẩm
               $delete = DP::run_query("Update sanphams set da_xoa = 1 where id = ?",[$id],1);
               if($delete){
                  $msg_success = "Xoá dữ liệu thành công.";
                  echo json_encode(array("statusCode"=>200,"id"=>$id,));
                  exit();
               } else {
                  echo json_encode(array("statusCode"=>201));
                  exit();
               }
            }
        }
        if(empty(trim($_POST["name"]))){
         $name_err = "Vui lòng không để trống tên sản phẩm";
        } else {
            $name = trim($_POST["name"]);
        }

        if(empty(trim($_POST["count"]))){
            $count_err = "Vui lòng không để trống số lượng sản phẩm";
        } else {
           $count = trim($_POST["count"]);
        }


        if(empty(trim($_POST["name_desc"]))){
         $name_desc_err = "Vui lòng không để trống mô tả sản phẩm";
        } else {
            $name_desc = trim($_POST["name_desc"]);
        }

        if(empty(trim($_POST["name_type"]))){
         $name_type_err = "Vui lòng không để trống id loại sản phẩm";
        } else {
            $name_type = trim($_POST["name_type"]);
        }

        if(empty(trim($_POST["price"]))){
         $price_err = "Vui lòng không để trống đơn giá sản phẩm";
        } else {
            $price = trim($_POST["price"]);
        }

        // Xử lý ảnh
      $valid_extension = array('jpeg','jpg','png','JPG','PNG','JPEG');
      if(!isset($_POST["image_url"]) || empty($_POST["image_url"])){
         if ( $_FILES['image']['size'] == 0 && $_FILES['image']['error'] == 0 ) {
            $image_err = 'Error: ' . $_FILES['image']['error'] . '<br>';
         } else {
            $code=md5(mt_rand(10,1000));
            $size= $_FILES['image']['size'];
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            
            if($size > 2097152) /*2 mb 1024*1024 bytes*/
            {
               $image_err = "Kích thước tập tin ảnh phải nhỏ hơn hoặc bằng 2mb.";
            }
            else if(!in_array($ext, $valid_extension)) {
               $image_err = "Đuôi tệp không hợp lệ.";
            }
            else{
               $old_image = DP::run_query("select hinh_anh from sanphams where id = ?",[(int)$id],2);
               if(count($old_image) > 0) {
                  if(file_exists("../img/img-admin/product/".$old_image[0]['hinh_anh'])) {
                     $bool = unlink('../img/img-admin/product/'.$old_image[0]['hinh_anh']);
                     // var_dump($bool);
                  }
               }
               $result = move_uploaded_file($_FILES['image']['tmp_name'], '../img/img-admin/product/' . $code.'.'.$ext);
               $image = $code.'.'.$ext;
            }
         }
      } else {
         $image = trim($_POST["image_url"]);
      }
      

      if(empty($name_err) && empty($name_desc_err) && empty($price_err) && empty($count_err) && empty($image_err) && empty($name_type_err)){
         $isExist = DP::run_query("Select id from sanphams where ten_san_pham = ?",[$name],2);
         if(count($isExist) > 0) {
            $name_err = "Tên loại sản phẩm này đã tồn tại.";
         } else {
            
            // Thêm loại sản phẩm
            if($thao_tac == "Thêm"){
               $insert = DP::run_query("Insert into sanphams(ten_san_pham,admin_id,loai_san_pham_id,mo_ta_san_pham,so_luong,don_gia,hinh_anh) values(?,?,?,?,?,?,?)",[$name,(int)$_SESSION["id"],(int)$name_type,$name_desc,(int)$count,(int)$price,$image],3);
               if($insert > 0){
                  $query = "select ten_loai_san_pham";
                  $query.= " from sanphams, loaisanphams";
                  $query.= " where sanphams.loai_san_pham_id = loaisanphams.id and sanphams.da_xoa = 0 and sanphams.id = ?";
                  $ten_loai_san_phams = DP::run_query($query,[$insert],2);
                  $ten = $ten_loai_san_phams[0]["ten_loai_san_pham"];
                  $msg_success = "Thêm dữ liệu thành công.";
                  echo json_encode(array(
                     "statusCode"=>200,
                     "id"=>$insert,
                     "name"=>$name,
                     "name_desc"=>$name_desc,
                     "name_type"=>$ten,
                     "image"=>$image,
                     "price"=>$price,
                     "count"=>$count,
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
            $update = DP::run_query("Update sanphams 
            set ten_san_pham = ?,admin_id = ?,
            loai_san_pham_id = ?,mo_ta_san_pham = ?, 
            so_luong = ?,don_gia = ?, hinh_anh = ?
            where id = ?",[$name,(int)$_SESSION["id"],(int)$name_type,$name_desc,(int)$count,(int)$price,$image,(int)$id],1);
            if($update){
               $msg_success = "Sửa dữ liệu thành công.";
               echo json_encode(array(
                  "statusCode"=>200,
                  "id"=>$id,
                  "name"=>$name,
                  "name_desc"=>$name_desc,
                  "name_type"=>$name_type,
                  "image"=>$image,
                  "price"=>$price,
                  "count"=>$count,
                  "created_at"=>date('Y-m-d H-i-s',time()),
               ));
               exit();
            } else {
               echo json_encode(array("statusCode"=>201));
               exit();
            }
         }

         
      } else {
         // return json thong bao loi
         // $name_err = $name_desc_err = $image_err = $price_err = $count_err = $name_type_err = "";
         echo json_encode(array(
            "statusCode"=>202,
            "name_err"=>$name_err,
            "name_desc_err"=>$name_desc_err,
            "image_err"=>$image_err,
            "price_err"=>$price_err,
            "count_err"=>$count_err,
            "name_type_err"=>$name_type_err,
         ));
         exit();
      }
   }
   $_isSanPham = true;
   include_once($level_config_layout.'layout.php');
?>