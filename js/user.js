$(document).ready(function(event){
    // kich hoat jquery ui datepicker cho input co id="ngay_sinh_user"
    $( "#ngay_sinh_user" ).datepicker({
        // thay doi thang
        changeMonth: true,
        // thay doi name
        changeYear: true,
        // dinh dang dau vao de khop voi truong du lieu trong csdl ten laravel trong hqtcsdl mysql
        dateFormat: 'yy-mm-dd'
    });

    // reset thong bao loi 
    $(document).on('click','#btn-cap-nhat-user,#btn-doi-mat-khau-user,.btn-gui-binh-luan',function(event){
        // reset loi cap nhat thong tin user
        $("#name_err").text("");
        $("#phone_err").text("");
        $("#email_err").text("");
        $("#address_err").text("");
        $("#birth_err").text("");
        $("#pass_auth_err").text("");

        // reset loi doi mat khau user
        $('#old_pass_err').text("");
        $('#new_pass_err').text("");
        $('#confirm_new_pass_err').text("");

        // reset loi gui binh luan
        $('.send_comment_err').text("");
    });

    // cập nhật thông tin user
    $(document).on('click','#btn-cap-nhat-user',function(event){
        event.preventDefault();
        let func = 1;
        let name = $('input[name=name]').val();
        let email = $('input[name=email]').val();
        let pass = $('input[name=pass]').val();
        let phone = $('input[name=phone]').val();
        let birth = $('input[name=birth]').val();
        let address = $('input[name=address]').val();
        let img = $('#display-image').attr('data-img');

        if(pass == ""){
            alert("Vui lòng nhập mật khẩu.");
            return;
        } 
        // su dung formData de gui tap tin qua ajax
        var formData = new FormData($('#form-user')[0]);
       

        // xu ly du lieu
        formData.append('func',func);
        formData.append('name',name);
        formData.append('email',email);
        formData.append('phone',phone);
        formData.append('birth',birth);
        formData.append('address',address);
        formData.append('pass',pass);

        let url = window.location.href;

        // xu ly anh
        let file = $('input[name=img_user]')[0].files;
        if(file.length == 0){
        formData.append('img_user',img);
        } else {
        formData.append('img_user_file',file[0]);
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
                // neu xu ly xac thuc mat khau thanh cong va cap nhat du lieu thanh cong
                if(res_json.statusCode == 200 && res_json.authenticate == 1){
                    alert("Cập nhật dữ liệu thành công.");
                } else if(res_json.authenticate == -1){   // neu mat khau xac thuc khong chinh xac
                    alert("Bạn nhập mật khẩu xác thực không chính xác.");
                } else if(res_json.statusCode == 202){  // neu bi loi rang buoc dau vao du lieu thi tra thong bao loi ben phia client
                    $("#name_err").text(res_json.name_err);
                    $("#phone_err").text(res_json.phone_err);
                    $("#email_err").text(res_json.email_err);
                    $("#address_err").text(res_json.address_err);
                    $("#image_err").text(res_json.image_err);
                    $("#birth_err").text(res_json.birth_err);
                } else if(res_json.statusCode == 201){ // neu bi loi khong xac dinh ( lien quan den may chu hoac ben may khach hang )
                    alert("Đã xảy ra lỗi, vui lòng reload lại trang.");
                } 
            },
            // debug loi xu ly ajax
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    
    // đổi mật khẩu user
    $(document).on('click','#btn-doi-mat-khau-user',function(event){
        let old_pass = $("input[name=old_pass]").val();
        let new_pass = $("input[name=new_pass]").val();
        let confirm_new_pass = $("input[name=confirm_new_pass]").val();
        let url = window.location.href;
        let func = 0;
        if(new_pass != confirm_new_pass) {
            alert("Bạn xác nhận mật khẩu mới không khớp với mật khẩu mới bạn nhập.");
            return;
        }
        $.ajax({
            url:url,
            type:"POST",
            data: {
                func: func,
                old_pass: old_pass,
                new_pass: new_pass,
                confirm_new_pass: confirm_new_pass,
            },
            success:function(data){
                data = JSON.parse(data);
                if(data.statusCode == 200 && data.authenticate == 1) {
                    alert("Bạn đã thay đổi mật khẩu thành công.");
                } else if(data.authenticate == -1){
                    alert("Mật khẩu cũ bạn nhập không chính xác.");
                } else if(data.statusCode == 202){
                    $('#old_pass_err').text(data.old_pass_err);
                    $('#new_pass_err').text(data.new_pass_err);
                    $('#confirm_new_pass_err').text(data.confirm_new_pass_err);
                } else if(data.statusCode == 201){
                    alert("Đã có lỗi xảy ra. Vui lòng reload lại trang.");
                } else {
                    alert(data.error);
                }
            },
            error:function(data){
                console.log('Error:', data);
            }
        }) 
    });
    
    // xem chi tiết hoá đơn user
    $(document).on('click','.btn-xem-chi-tiet-hoa-don',function(event){
        let id = $(this).attr('data-bill_id');
        let func = -1;
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
                    $('#t_body > #cthd' + i).append('<td><img width="120" height="120" src="img/img-admin/product/' + data[i].image + '"></td>');
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
    });

    // hiển thị thông tin chi tiết sản phẩm và bình luận sản phẩm khi người dùng click vào button dấu +
    $(document).on('click','.btn-xem-chi-tiet-sp',function(event){
        event.preventDefault();

        let id = $(event.currentTarget).attr('data-id');
        let name = $(event.currentTarget).attr('data-name');
        let price = $(event.currentTarget).attr('data-price');
        let count = $(event.currentTarget).attr('data-count');
        let img = $(event.currentTarget).attr('data-img');
        let desc = $('#mo-ta-sp'+id).html();
        let url = "load_comment.php";

        $('#quickview').modal('show');
        

        $('#mo-ta').html(desc);
        $('#ten').text(name);
        $('#gia').text(price);
        $('#so-luong').attr('max',count);
        $('#sl').text(count);
        $('#anh-san-pham').attr('src','img/img-admin/product/'+img);
        $('input[name=san_pham_id]').val(id);

        $.ajax({
            url: url,
            type:"POST",
            data: {
                id: id,
            },
            success:function(data){
                if($('div.card-comment').parents('#list-comment').length > 0){
                    $('#list-comment').empty();
                }
                if(data == "") {
                    $('#title-comment').text("Bình luận (0)");
                    return;
                }
                data = JSON.parse(data);
                let element = "";
                let len = data.length;
                $('#title-comment').text("Bình luận (" + len + ")");
                    
                for(let i = 0 ; i < len ; i++) {
                    element = "";
                    element += "<div class='card-comment' id='user-comment" + data[i].id + "'>";
                    element +=    "<img class='img-circle img-sm' src='img/img-user/info/" + data[i].photo + "'>"
                    element +=    "<div class='comment-text card-footer'>";
                    element +=     "<span class='username'>" + data[i].name;
                    element +=       "<span class='text-muted float-right'>" + data[i].time + "</span>"
                    element +=     "</span>"
                    element +=          data[i].comment;
                    element +=   "</div>"
                    $('#list-comment').append(element);
                }
            },
            error: function(data){
                console.log("Error",data);
            }
            
        })
        
    });
    
    // Chức năng thêm bình luận của user
    $(document).on('click','.btn-gui-binh-luan',function(event){
        event.preventDefault();
        let id = $('input[name=san_pham_id]').val();
        let comment = $('input[name=comment]').val();
        $('input[name=comment]').val("");
        let url = window.location.href;
        $.ajax({
            url: url,
            type:"POST",
            data: {
               san_pham_id:id,
               comment: comment,
            },
            success: function(data){
                data = JSON.parse(data);
                let element = "";
                element += "<div class='card-comment' id='user-comment" + data.id + "'>";
                element +=    "<img class='img-circle img-sm' src='img/img-user/info/" + data.photo + "'>"
                element +=    "<div class='comment-text card-footer'>";
                element +=     "<span class='username'>" + data.name;
                element +=       "<span class='text-muted float-right'>" + data.time + "</span>"
                element +=     "</span>"
                element +=          data.comment;
                element +=   "</div>"
                $('#list-comment').append(element);
                
            },
            error: function(data){
                console.log("Error",data);
            }
        });
    });

    // Chức năng huỷ đơn hàng
    $(document).on('click','.btn-order-cancel',function(event){
        if(confirm("Bạn có chắc chắn muốn huỷ đơn hàng này")) {
            let hoa_don_id = $(this).attr("data-bill_id");
            let url = "user_order_cancel.php";
            
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    hoa_don_id: hoa_don_id,
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if(data.statusCode == 200) {
                        alert(data.msg);
                        $("#hoa-don-"+hoa_don_id).remove();
                    } else {
                        alert(data.msg);
                    }
                },
                error: function(data){
                    console.log("Error: ",data);
                },
            });
        }
    }); 

    // Chức năng huỷ giỏ hàng
    $(document).on('click','#btn-cart-cancel',function(event){
        event.preventDefault();
        if(confirm("Bạn có chắc chắn muốn huỷ giỏ hàng.")){
            let url = "user_cart_cancel.php";
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    url: url,
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if(data.statusCode == 200) {
                        alert(data.msg);
                        $("#list-cart").empty();
                    } else {
                        alert("Đã có lỗi xảy ra, vui lòng reload lại trang");
                    }
                },
                error: function(data){
                    console.log("Error: ",data);
                },
            });
        }
    });

});