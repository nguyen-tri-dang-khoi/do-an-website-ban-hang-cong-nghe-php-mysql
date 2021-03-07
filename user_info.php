<?php
    include_once('config_user.php');
    session_start();

    if(!isset($_SESSION["isUserLoggedIn"]) || $_SESSION["isUserLoggedIn"] !== true){
        header("location:user_login.php");
        exit();
     }

     // xác thực đó có phải admin
    $auth = -1;
    $name_duplicate = $email_duplicate = $phone_duplicate = "";
    // thông tin 
    $name = $email = $pass = $confirm_pass = $phone = $birth = $address = $img_user_file = $img_user = "";
    // lỗi
    $name_err = $email_err = $pass_err = $confirm_pass_err = $phone_err = $birth_err = $address_err = $img_user_err = "";
    $id = "";
    $id_err = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $auth = -1;
        // chức năng xem chi tiết hoá đơn.
        if($_POST["func"] == "-1"){
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
        }

        // chức năng cập nhật mật khẩu và cập nhật thông tin user
        if(!empty($_POST["pass"]) || !empty($_POST["old_pass"]) ) {
            $conf = DP::run_query("select password from users where id = ?",[(int)$_SESSION["id"]],2);
            if($_POST["func"] == "1")
            {
                if(password_verify($_POST["pass"],$conf[0]["password"])) {
                    $auth = 1;
                    if(empty(trim($_POST["name"]))){
                        $name_err = "Vui lòng không để trống tên.";
                    } else {
                        $name = trim($_POST["name"]);
                    }
                    
                    if(empty(trim($_POST["email"]))){
                        $email_err = "Vui lòng không để trống email.";
                    } else {
                        $email = trim($_POST["email"]);
                    }
            
                    if(empty(trim($_POST["phone"]))){
                        $phone_err = "Vui lòng không để trống số điện thoại.";
                    } else {
                        $phone = trim($_POST["phone"]);
                    }
            
                    if(empty(trim($_POST["birth"]))){
                        $birth_err = "Vui lòng không để trống ngày sinh.";
                    } else {
                        $birth = trim($_POST["birth"]);
                    }
            
                    if(empty(trim($_POST["address"]))){
                        $address_err = "Vui lòng không để trống địa chỉ.";
                    } else {
                        $address = trim($_POST["address"]);
                    }
            
                    // Xử lý ảnh
                    $valid_extension = array('jpeg','jpg','png','JPG','PNG','JPEG');
                    if(!isset($_POST["img_user"]) || empty($_POST["img_user"])){
                        if ( $_FILES['img_user_file']['size'] == 0 && $_FILES['img_user_file']['error'] == 0 ) {
                            $image_err = 'Error: ' . $_FILES['image']['error'] . '<br>';
                        } else {
                            $code=md5(mt_rand(10,1000));
                            $size= $_FILES['img_user_file']['size'];
                            $ext = strtolower(pathinfo($_FILES['img_user_file']['name'], PATHINFO_EXTENSION));
                            
                            if($size > 2097152) /*2 mb 1024*1024 bytes*/
                            {
                            $image_err = "Kích thước tập tin ảnh phải nhỏ hơn hoặc bằng 2mb.";
                            }
                            else if(!in_array($ext, $valid_extension)) {
                            $image_err = "Đuôi tệp không hợp lệ.";
                            }
                            else{
                                $old_image = DP::run_query("select photo from users where id = ?",[(int)$_SESSION['id']],2);
                                if(count($old_image) > 0) {
                                    if($old_image[0]['photo'] == "image.jpg"){
                                        $result = move_uploaded_file($_FILES['img_user_file']['tmp_name'], 'img/img-user/info/' . $code.'.'.$ext);
                                    } else {
                                        if(file_exists('img/img-user/info/'.$old_image[0]['photo'])){
                                            unlink('img/img-user/info/'.$old_image[0]['photo']);
                                        }
                                        $result = move_uploaded_file($_FILES['img_user_file']['tmp_name'], 'img/img-user/info/' . $code.'.'.$ext);
                                    } 
                                }
                                $img_user = $code.'.'.$ext;
                            }
                        }
                    } else {
                        $img_user = trim($_POST["img_user"]);
                    }
                    
                    if(empty($name_err) && empty($email_err) && empty($phone_err) && empty($birth_err) && empty($img_user_err) && empty($address_err) ){
                        $update = DP::run_query("Update users set name = ?, email = ?, birth = ?, phone = ?, address = ?,photo = ? where id = ?",[$name,$email,$birth,$phone,$address,$img_user,(int)$_SESSION["id"]],1);
                        if($update){
                            $_SESSION["photo"] = $img_user;
                            $_SESSION["address"] = $address;
                            echo json_encode(array("statusCode"=>200,"authenticate"=>$auth));
                            exit();
                        } else {
                            // tra ve loi he thong khong xac dinh va yeu cau user load lai trang
                            echo json_encode(array("statusCode"=>201));
                            exit();
                        }
                    } else {
                        // tra ve chuoi json thong bao loi 
                        echo json_encode(array(
                            "statusCode"=>202,
                            "name_err"=>$name_err,
                            "phone_err"=>$phone_err,
                            "address_err"=>$address_err,
                            "birth_err"=>$birth_err,
                            "email_err"=>$email_err,
                        ));
                        exit();
                    }
                }
                else {
                    echo json_encode(array("authenticate"=>$auth));
                    exit();
                }
            } elseif($_POST["func"] == "0"){
                $old_pass = $new_pass = $confirm_new_pass = "";
                $old_pass_err = $new_pass_err = $confirm_new_pass_err = "";

                // rang buoc mat khau cu
                if(empty($_POST["old_pass"])) {
                    $old_pass_err = "Vui lòng không để trống mật khẩu cũ";
                } else {
                    $old_pass = $_POST["old_pass"];
                }

                // rang buoc mat khau moi
                if(empty($_POST["new_pass"])) {
                    $new_pass_err = "Vui lòng không để trống mật khẩu mới";
                } elseif(strlen($_POST["new_pass"]) < 6) {
                    $new_pass_err = "Mật khẩu bạn cập nhật phải có 6 ký tự trở lên";
                } else {
                    $new_pass = $_POST["new_pass"];
                }

                // rang buoc xac nhan mat khau moi
                // var_dump($_POST["confirm_new_pass"]);
                if(empty($_POST["confirm_new_pass"])) {
                    $confirm_new_pass_err = "Vui lòng không để trống ô xác nhận mật khẩu.";
                } elseif(!empty($new_pass_err) || ($_POST["confirm_new_pass"] != $new_pass)) {
                    if(!empty($new_pass_err)) {
                        $confirm_new_pass_err = $new_pass_err;
                    } elseif($_POST["confirm_new_pass"] != $new_pass) {
                        $confirm_new_pass_err = "Bạn xác nhận mật khẩu không khớp với mật khẩu bạn nhập.";
                    }
                }

                if(empty($old_pass_err) && empty($new_pass_err) && empty($confirm_new_pass_err)) {
                    if(password_verify($old_pass,$conf[0]["password"])) {
                        $auth = 1;
                        $new_pass = password_hash(trim($_POST["new_pass"]),PASSWORD_DEFAULT);
                        $update = DP::run_query("update users set password = ? where id = ?",[$new_pass,(int)$_SESSION["id"]],1);
                        if($update) {
                            echo json_encode(array("statusCode"=>200,"authenticate"=>$auth));
                            exit();
                        } else {
                            echo json_encode(array("statusCode"=>201));
                            exit();
                        }
                    } else {
                        echo json_encode(array("authenticate"=>$auth));
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
        } else {
            echo json_encode(array("error"=>"Bạn chưa nhập mật khẩu xác thực."));
            exit();
        }
        
    } 

    $_isUserProfilePage = true;
    include_once($level_config_layout.'layout.php');
?>