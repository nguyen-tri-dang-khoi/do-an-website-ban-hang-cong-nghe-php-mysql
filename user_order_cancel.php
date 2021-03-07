<?php
    include_once "config_user.php";
    $hoa_don_id = -1;
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["hoa_don_id"]) && is_numeric($_POST["hoa_don_id"])) {
            $hoa_don_id = (int)$_POST["hoa_don_id"];
            if($hoa_don_id > 0) {
                $xoa_cthd = DP::run_query("Delete from chitiethoadons where hoa_don_id = ?",[$hoa_don_id],1);
                if($xoa_cthd) {
                    $xoa_hd = DP::run_query("Delete from hoadons where id = ?",[$hoa_don_id],1);
                    if($xoa_hd){
                        echo json_encode(array(
                            "statusCode"=>200,
                            "msg"=>"Bạn đã huỷ đơn hàng thành công"
                        ));
                        exit();
                    } else {
                        echo json_encode(array(
                            "statusCode"=>202,
                            "msg"=>"Đã có lỗi xảy ra, vui lòng reload lại trang.",
                        ));
                        exit();
                    }
                } else {
                    echo json_encode(array(
                        "statusCode"=>202,
                        "msg"=>"Đã có lỗi xảy ra, vui lòng reload lại trang.",
                    ));
                    exit();
                }
            } else {
                echo json_encode(array(
                    "statusCode"=>201,
                    "msg"=>"Dữ liệu id hoá đơn không hợp lệ.",
                ));
                exit();
            }
        } else {
            echo json_encode(array(
                "statusCode"=>201,
                "msg"=>"Dữ liệu id hoá đơn không hợp lệ.",
            ));
            exit();
        }
    }
?>