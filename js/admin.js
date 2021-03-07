$(document).ready(function(event){

    // kích hoạt datepicker của jquery ui
    $( "#ngay_sinh_admin" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
    // reset lỗi cập nhật thông tin
    $(document).on('click','#btn-cap-nhat-admin,#btn-doi-mat-khau-admin',function(event){
        // cap nhat mat khau
        $("#old_pass_err").text("");
        $("#new_pass_err").text("");
        $("#confirm_pass_err").text("");

        // cap nhat thong tin
        $("#name_err").text("");
        $("#phone_err").text("");
        $("#birth_err").text("");
        $("#address_err").text("");


    })
    // cập nhật thông tin admin
    $(document).on('click','#btn-cap-nhat-admin',function(event){
        event.preventDefault();
        let name = $('input[name=name]').val();
        let old_pass = $('input[name=old_pass]').val();
        let email = $('input[name=email]').val();
        let phone = $('input[name=phone]').val();
        let birth = $('input[name=birth]').val();
        let address = $('input[name=address]').val();
        let img = $('#display-image').attr('data-img');

        if(old_pass == ""){
            alert("Vui lòng không để trống mật khẩu xác thực.");
            return;
        } 

        var formData = new FormData($('#form-admin')[0]);
       

        // xu ly du lieu
        formData.append('name',name);
        formData.append('email',email);
        formData.append('phone',phone);
        formData.append('birth',birth);
        formData.append('address',address);
        formData.append('old_pass',old_pass);

        let url = window.location.href;

        // xu ly anh
        let file = $('input[name=img_admin_file]')[0].files;
        if(file.length == 0){
        formData.append('img_admin',img);
        } else {
        formData.append('img_admin_file',file[0]);
        }
        // xử lý ajax
        $.ajax({
            url:url,
            type:"POST",
            cache:false,
            dataType:"json",
            contentType: false,
            processData: false,
            data:formData,
            success:function(res_json){
                if(res_json.statusCode == 200){
                    alert("Cập nhật dữ liệu thành công.");
                } else if(res_json.statusCode == 201){
                    alert("Đã xảy ra lỗi, vui lòng reload lại trang web");
                } else if(res_json.statusCode == 202) {
                    $("#name_err").text(res_json.name_err);
                    $("#old_pass_err").text(res_json.old_pass_err);
                    $("#phone_err").text(res_json.phone_err);
                    $("#birth_err").text(res_json.birth_err);
                    $("#address_err").text(res_json.address_err);
                    $("#email_err").text(res_json.email_err);
                    $("#image_err").text(res_json.image_err);
                } else {
                    alert(res_json.auth);
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    // cập nhật mật khẩu admin
    $(document).on('click','#btn-doi-mat-khau-admin',function(event){
        event.preventDefault();

        let old_pass = $('input[name=old_pass]').val();
        let new_pass = $('input[name=new_pass]').val();
        let confirm_new_pass = $('input[name=confirm_new_pass]').val();
        let url = "admin_change_pass.php";

        $.ajax({
            url:url,
            type:"POST",
            data:{
                old_pass: old_pass,
                new_pass: new_pass,
                confirm_new_pass: confirm_new_pass,
            },
            success:function(res_json){
                res_json = JSON.parse(res_json);
                if(res_json.statusCode == 200){
                    alert("Cập nhật dữ liệu thành công.");
                } else if(res_json.statusCode == 201){
                    alert("Đã xảy ra lỗi, vui lòng reload lại trang web");
                } else if(res_json.statusCode == 202) {
                    $("#old_pass_err").text(res_json.old_pass_err);
                    $("#new_pass_err").text(res_json.new_pass_err);
                    $("#confirm_new_pass_err").text(res_json.confirm_new_pass_err);
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    /* -1: xem chi tiết hoá đơn
     * 0: xem thông tin người dùng
     * 1: cập nhật trạng thái đã thanh toán.
     */
    // hiển thị thông tin chi tiết đơn hàng khi admin click vào button "Xem chi tiết đơn hàng."
    $(document).on('click','.btn-xem-chi-tiet-hoa-don',function(event){
        let func = -1;
        let id = $(this).attr('data-bill_id');
        let url = window.location.href;
        $.ajax({
            url:url,
            type:"POST",
            data: {
                id: id,
                func: func,
            },
            success:function(data){
                data = JSON.parse(data);
                let len = data.length;

                $('#modal-xl').modal('show');
                $('.modal-title').text("Thông tin hoá đơn");
                if($('th').parents('#t_head').length > 0) {
                    $('#t_head').empty();
                }
                if($('tr > td').parents('#t_body').length > 0) {
                    $('#t_body').empty();
                }
                $('#t_head').append('<th>Tên sản phẩm</th>');
                $('#t_head').append('<th>Hình ảnh</th>');
                $('#t_head').append('<th>Đơn giá</th>');
                $('#t_head').append('<th>Số lượng</th>');
                $('#t_head').append('<th>Số tiền</th>');
                let tr = "";
                for(let i = 0 ; i < len ; i++) {
                    tr = "<tr id='cthd"+i+"'>";
                    $('#t_body').append(tr);
                    $('#t_body > #cthd' + i).append('<td>' + data[i].name + '</td>');
                    $('#t_body > #cthd' + i).append('<td><img width="120" height="120" src="../img/img-admin/product/' + data[i].image + '"></td>');
                    $('#t_body > #cthd' + i).append('<td>' + data[i].price + '</td>');
                    $('#t_body > #cthd' + i).append('<td>' + data[i].count + '</td>');
                    let total = data[i].count * data[i].price;
                    $('#t_body > #cthd' + i).append('<td>' + total+ '</td>');
                    $('#t_body').append("</tr>");
                }

            },
            error:function(data){
                console.log('Error:', data);
            }
        })
    })


    // hiển thị thông tin người dùng đặt hàng khi admin click vào button "Xem thông tin người dùng."
    $(document).on('click','.btn-xem-thong-tin-nguoi-dung',function(event){
        let func = 0;
        let id = $(this).attr('data-user_id');
        let url = window.location.href;
        $.ajax({
            url:url,
            type:"POST",
            data:{
               id: id, 
               func: func,
            },
            success:function(data){
                data = JSON.parse(data);
                $('#modal-xl').modal('show');
                $('.modal-title').text("Thông tin người dùng");
                if($('th').parents('#t_head').length > 0) {
                    $('#t_head').empty();
                }
                if($('tr > td').parents('#t_body').length > 0) {
                    $('#t_body').empty();
                }
                $('#t_head').append('<th>Tên</th>');
                $('#t_head').append('<th>Ảnh đại diện</th>');
                $('#t_head').append('<th>Email</th>');
                $('#t_head').append('<th>Ngày sinh</th>');
                $('#t_head').append('<th>Số điện thoại</th>');
                $('#t_head').append('<th>Địa chỉ</th>');
                $('#t_body').append("<tr>");
                $('#t_body > tr').append('<td>' + data.name + '</td>');
                $('#t_body > tr').append('<td><img width="120" height="120" src="../img/img-user/info/' + data.image + '"></td>');
                $('#t_body > tr').append('<td>' + data.email + '</td>');
                $('#t_body > tr').append('<td>' + data.birth + '</td>');
                $('#t_body > tr').append('<td>' + data.phone+ '</td>');
                $('#t_body > tr').append('<td>' + data.address+ '</td>');
                $('#t_body').append("</tr>");
            },
            error:function(data){
                console.log('Error:', data);
            }
        })
    })

    /*
     *
     */
    // Cập nhật trạng thái đã thanh toán khi admin click vào button "Cập nhật đã thanh toán hoá đơn."
    $(document).on('click','.btn-cap-nhat-thanh-toan',function(event){
        let func = 1;
        let id = $(this).attr('data-id');
        let pos = $(this).attr('data-pos');
        let url = window.location.href;
        $.ajax({
            url:url,
            type:"POST",
            data: {
                func: func,
                id: id,
            },
            success:function(data){
                data = JSON.parse(data);
                if(data.statusCode == 200) {
                    alert("Cập nhật dữ liệu thành công.");
                    $("#status-payment"+pos).text("Đã thanh toán");

                } else {
                    alert("Đã có lỗi xảy ra.");
                }
            },
            error:function(data){
                console.log('Error:', data);
            }
        })
    })
});