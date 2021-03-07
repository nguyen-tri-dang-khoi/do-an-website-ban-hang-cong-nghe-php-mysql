<?php
    include_once('config_admin.php');
    session_start();
    if(!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] !== true){
       header("location:admin_login.php");
       exit();
    }
    $name_duplicate = $email_duplicate = $phone_duplicate = "";
    $name = $email = $phone = $birth = $address = $img_admin_file = $img_admin = "";
    $name_err = $email_err  = $phone_err = $birth_err = $address_err = $image_err = "";
    $pass = "123456";
    $old_pass = $old_pass_err = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
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
        if(!isset($_POST["img_admin"]) || empty($_POST["img_admin"])){
            if ( $_FILES['img_admin_file']['size'] == 0 && $_FILES['img_admin_file']['error'] == 0 ) {
                $image_err = 'Error: ' . $_FILES['image']['error'] . '<br>';
            } else {
                $code=md5(mt_rand(10,1000));
                $size= $_FILES['img_admin_file']['size'];
                $ext = strtolower(pathinfo($_FILES['img_admin_file']['name'], PATHINFO_EXTENSION));
                
                if($size > 2097152) /*2 mb 1024*1024 bytes*/
                {
                $image_err = "Kích thước tập tin ảnh phải nhỏ hơn hoặc bằng 2mb.";
                }
                else if(!in_array($ext, $valid_extension)) {
                $image_err = "Đuôi tệp không hợp lệ.";
                }
                else{
                    $old_image = DP::run_query("select photo from admins where id = ?",[(int)$_SESSION['id']],2);
                    if(count($old_image) > 0){
                        if($old_image[0]['photo'] == "image.jpg"){
                            $result = move_uploaded_file($_FILES['img_admin_file']['tmp_name'], '../img/img-admin/info/' . $code.'.'.$ext);
                        } else {
                            if(file_exists('../img/img-admin/info/'.$old_image[0]['photo'])){
                                unlink('../img/img-admin/info/'.$old_image[0]['photo']);
                                $result = move_uploaded_file($_FILES['img_admin_file']['tmp_name'], '../img/img-admin/info/' . $code.'.'.$ext);
                            }
                        }
                        $img_admin = $code.'.'.$ext;
                    }
                   
                }
            }
        } else {
            $img_admin = trim($_POST["img_admin"]);
        }

        // kiểm tra mật khẩu xác thực (mật khẩu cũ)
        if(empty($_POST["old_pass"])){
            $old_pass_err = "Vui lòng không để trống mật khẩu.";
        } else {
            $old_pass = $_POST["old_pass"];
        }
        
        if(empty($name_err) && empty($email_err) && empty($old_pass_err) && empty($phone_err) && empty($birth_err) && empty($img_admin_err) && empty($address_err) ){
            $conf = DP::run_query("select password from admins where id = ?",[(int)$_SESSION["id"]],2);
            if(password_verify($old_pass,$conf[0]["password"])){
                $update = DP::run_query("Update admins set name = ?, email = ?, birth = ?, phone = ?, address = ?,photo = ? where id = ?",[$name,$email,$birth,$phone,$address,$img_admin,(int)$_SESSION["id"]],1);
                if($update){
                    $_SESSION["photo"] = $img_admin;
                    echo json_encode(array("statusCode"=>200));
                    exit();
                } else {
                    echo json_encode(array("statusCode"=>201));
                    exit();
                }
            } else {
                echo json_encode(array(
                    "statusCode"=>203,
                    "auth"=>"Mật khẩu xác thực bạn nhập không chính xác."));
                exit();
            }
        } else {
            echo json_encode(array(
                "statusCode"=>202,
                "name_err"=>$name_err,
                "phone_err"=>$phone_err,
                "old_pass_err"=>$old_pass_err,
                "address_err"=>$address_err,
                "email_err"=>$email_err,
                "birth_err"=>$birth_err,
                "image_err"=>$image_err,
            ));
            exit();
        }
    }
    $_isProfilePage = true;
    include_once($level_config_layout.'layout.php');

?>