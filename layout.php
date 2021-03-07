<?php
    
    /** admin **/
    // cau hinh trang admin_index
    if($_isIndexPage == true) {
        $dir_admin_index = _DIR_['COMPONENTS']['ADMINS'];
        include($dir_admin_index.'head.php');
        include($dir_admin_index.'navigation_bar.php');
        include($dir_admin_index.'sider_bar.php');
        include($dir_admin_index.'content.php');
        include($dir_admin_index.'footer.php');
        include($dir_admin_index.'script.php');
    }
    // cau hinh trang admin_login
    if($_isLoginPage == true) {
        $dir_admin_login = _DIR_['COMPONENTS']['ADMINS'];
        include($dir_admin_login.'head.php');
        include($dir_admin_login.'login.php');
        include($dir_admin_login.'script.php');
    }
    // cau hinh trang admin_register
    if($_isRegisterPage == true) {
        $dir_admin_register = _DIR_['COMPONENTS']['ADMINS'];
        include($dir_admin_register.'head.php');
        include($dir_admin_register.'register.php');
        include($dir_admin_register.'script.php');
    }
    // cau hinh trang admin_loai_san_pham.php
    if($_isLoaiSanPham == true) {
        $dir_admin_loai_san_pham = _DIR_['COMPONENTS']['ADMINS'];
        include($dir_admin_loai_san_pham.'head.php');
        include($dir_admin_loai_san_pham.'navigation_bar.php');
        include($dir_admin_loai_san_pham.'sider_bar.php');
        include($dir_admin_loai_san_pham.'quan_ly_loai_san_pham.php');
        include($dir_admin_loai_san_pham.'footer.php');
        include($dir_admin_loai_san_pham.'script.php');
    }
    // cau hinh trang admin_san_pham.php
    if($_isSanPham == true) {
        $dir_admin_san_pham = _DIR_['COMPONENTS']['ADMINS'];
        include($dir_admin_san_pham.'head.php');
        include($dir_admin_san_pham.'navigation_bar.php');
        include($dir_admin_san_pham.'sider_bar.php');
        include($dir_admin_san_pham.'quan_ly_san_pham.php');
        include($dir_admin_san_pham.'footer.php');
        include($dir_admin_san_pham.'script.php');
    }
    // cau hinh trang admin_info.php
    if($_isProfilePage == true) {
        $dir_admin_profile = _DIR_['COMPONENTS']['ADMINS'];
        include($dir_admin_profile.'head.php');
        include($dir_admin_profile.'sider_bar.php');
        include($dir_admin_profile.'info.php');
        include($dir_admin_profile.'script.php');
    }
    // cau hinh trang admin_don_hang.php
    if($_isBillPage == true) {
        $dir_admin_bill = _DIR_['COMPONENTS']['ADMINS'];
        include($dir_admin_bill.'head.php');
        include($dir_admin_bill.'sider_bar.php');
        include($dir_admin_bill.'quan_ly_don_hang.php');
        include($dir_admin_bill.'script.php');
    }

    // cau hinh trang admin_change_pass.php
    if($_isChangePassPage == true){
        $dir_admin_index = _DIR_['COMPONENTS']['ADMINS'];
        include($dir_admin_index.'head.php');
        include($dir_admin_index.'navigation_bar.php');
        include($dir_admin_index.'sider_bar.php');
        include($dir_admin_index.'change_pass.php');
        include($dir_admin_index.'footer.php');
        include($dir_admin_index.'script.php');
    }

    /** admin **/





    /** user **/
    // cau hinh trang index cho user
    if($_isUserIndexPage == true) {
        $dir_user_index = _DIR_['COMPONENTS']['USERS'];
        include($dir_user_index.'head.php');
        include($dir_user_index.'category_side_menu.php');
        include($dir_user_index.'header.php');
        include($dir_user_index.'top_discount.php');
        include($dir_user_index.'welcome_slide.php');
        include($dir_user_index.'top_category.php');
        include($dir_user_index.'quick_view_modal.php');
        include($dir_user_index.'news.php');
        include($dir_user_index.'offer.php');
        include($dir_user_index.'footer.php');
        include($dir_user_index.'script_index.php');
    }
    // cau hinh trang register cho user
    if($_isUserRegisterPage == true) {
        $dir_user_register = _DIR_['COMPONENTS']['USERS'];
        include($dir_user_register.'head.php');
        include($dir_user_register.'register.php');
        include($dir_user_register.'script.php');
    }
    if($_isUserLoginPage == true) {
        $dir_login = _DIR_['COMPONENTS']['USERS'];
        include($dir_login.'head_login.php');
        include($dir_login.'login.php');
        include($dir_login.'script.php');
    }
    if($_isUserProductDetailPage == true) {
        $dir_product_detail = _DIR_['COMPONENTS']['USERS'];
        include($dir_product_detail.'head.php');
        include($dir_product_detail.'category_side_menu.php');
        include($dir_product_detail.'header.php');
        include($dir_product_detail.'product_details.php');
        include($dir_product_detail.'quick_view_modal.php');
        include($dir_product_detail.'footer.php');
        include($dir_product_detail.'script.php');
    }

    if($_isUserCartPage == true) {
        $dir_cart = _DIR_['COMPONENTS']['USERS'];
        include($dir_cart.'head.php');
        include($dir_cart.'category_side_menu.php');
        include($dir_cart.'header.php');
        include($dir_cart.'top_discount.php');
        include($dir_cart.'cart.php');
        include($dir_cart.'footer.php');
        include($dir_cart.'script.php');
    }
    if($_isUserProfilePage == true) {
        $dir_info = _DIR_['COMPONENTS']['USERS'];
        include($dir_info.'head_info.php');
        include($dir_info.'info.php');
        include($dir_info.'script.php');
    }
    if($_isUserBillPage == true) {
        $dir_info = _DIR_['COMPONENTS']['USERS'];
        include($dir_info.'head_info.php');
        include($dir_info.'script.php');
    }
    /** user **/
?>