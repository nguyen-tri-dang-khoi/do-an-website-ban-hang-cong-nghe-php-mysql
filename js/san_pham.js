$(document).ready(function(){
    // reset thong bao loi
    $(document).on('click','#btn-them-san-pham,#btn-sua-san-pham,#btn-xoa-san-pham',function(event){
        $('#form-san-pham').trigger('reset');
        $("#name_err").text("");
        $("#name_type_err").text("");
        $("#name_desc_err").text("");
        $("#count_err").text("");
        $("#price_err").text("");
        $("#image_err").text("");
    });

    // thêm loại sản phẩm
    
    $(document).on('click','#btn-them-san-pham',function(event){
        $('#btn-luu-san-pham').text('Thêm');
        $('#form-san-pham').trigger('reset');
        $('#summernote').summernote('code',"");
        if($('#display-image').length){
            $('#display-image').replaceWith('<div data-img="" class="img-fluid" id="where-replace">' + "<span></span>" + "</div>");
        }
        $('#modal-xl').modal('show');

    });

    // sửa loại sản phẩm
    $(document).on('click','.btn-sua-san-pham',function(event){
        let id = $(event.currentTarget).attr('data-id');
        let ten_san_pham = $(event.currentTarget).attr('data-name');
        let so_luong = $(event.currentTarget).attr('data-count');
        let don_gia = $(event.currentTarget).attr('data-price');
        let mo_ta_san_pham = $('#mo_ta_sp'+id).html();
        let phan_loai_san_pham = $(event.currentTarget).attr('data-name_type');
        let hinh_anh = $(event.currentTarget).attr('data-image');

        $('#btn-luu-san-pham').text('Sửa');
        $('#form-san-pham').trigger('reset');
        $('#modal-xl').modal('show');


        
        $('input[name=id]').val(id);
        $('input[name=ten_san_pham]').val(ten_san_pham);
        $('input[name=so_luong]').val(so_luong);
        $('input[name=don_gia]').val(don_gia);
        $('#summernote').summernote('code',mo_ta_san_pham);

        $("option").removeAttr('selected');
        $("option[value=" + phan_loai_san_pham + "]" ).attr('selected',true);
        $("#where-replace > span").replaceWith( "<img class='img-fluid' id='display-image'/>" );
        $("#display-image").attr('src',"../img/img-admin/product/" + hinh_anh);
        $("#display-image").attr('data-img',hinh_anh);
    });

    // xoá sản phẩm
    $(document).on('click','.btn-xoa-san-pham',function(event){
        let id = $(event.currentTarget).attr('data-id');
        let ten_san_pham = $(event.currentTarget).attr('data-name');
        

        $('#btn-luu-san-pham').text('Xoá');
        $('#form-san-pham').trigger('reset');
        $('#modal-xl').modal('show');

        $('input[name=id]').val(id);

    });

    // xử lý thao tác thêm xoá sửa
    $(document).on('click','#btn-luu-san-pham',function(event){
        event.preventDefault();
        let id = $('input[name=id]').val();
        let ten_san_pham = $('input[name=ten_san_pham]').val();
        let thao_tac = $('#btn-luu-san-pham').text();

        let so_luong = $('input[name=so_luong]').val();
        let don_gia = $('input[name=don_gia]').val();
        let hinh_anh = $("#display-image").attr('data-img');


        // xu ly sumernote (lay du lieu mo ta)
        let mo_ta_san_pham = $('#summernote').summernote('code');

        // xu ly phan loai san pham
        let phan_loai_san_pham = $('select[name=phan_loai_san_pham] > option:selected').val();


        var formData = new FormData($('#form-san-pham')[0]);
       

        // xu ly du lieu
        formData.append('id',id);
        formData.append('name',ten_san_pham);
        formData.append('name_desc',mo_ta_san_pham);
        formData.append('count',so_luong);
        formData.append('price',don_gia);
        formData.append('name_type',phan_loai_san_pham);
        formData.append('thao_tac',thao_tac);
         // xu ly anh
         let file = $('input[name=hinh_anh]')[0].files;
         if(file.length == 0){
             formData.append('image_url',hinh_anh);
         } else {
            formData.append('image',file[0]);
         }


        let url = "";
        if(thao_tac == "Thêm"){
            url = window.location.href;
        } else if(thao_tac == "Sửa") {
            url = window.location.href + "?id=" + id;
        } else if(thao_tac == "Xoá") {
            url = window.location.href + "?id=" + id;
        } else {
            location.replace("error.php");
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
                    let record = "<tr id='san-pham" + res_json.id + "'>";
                    record += "<td>" + res_json.name + "</td>";
                    record += "<td>...</td>";
                    record += "<td id='mo_ta_sp" + res_json.id +  "' style='display:none;'>" + res_json.name_desc + "</td>";
                    record += "<td>" + res_json.count+ "</td>";
                    record += "<td>" + res_json.price + "</td>";
                    record += "<td>" + res_json.name_type + "</td>";
                    record += "<td><img width='100' height='100' src='../img/img-admin/product/" + res_json.image + "'>" + "</td>";
                    record += "<td>" + res_json.created_at + "</td>";
                    record += "<td>"
                    record += "<button class='btn-sua-san-pham btn btn-primary' ";
                    record +=   "data-name='" + res_json.name + "'" + " data-count='" +res_json.count + "'";
                    record +=   " data-price='" + res_json.price + "' data-name_type='" + res_json.name_type + "' " + " data-image='" +res_json.image + "'";    
                    record += " data-id='" + res_json.id;
                    record += "'>";
                    record +=      "Sửa"
                    record +  "</button>";
                    record += "<button class='btn-xoa-san-pham btn btn-danger' ";
                    record +=   "data-id='" + res_json.id + "'>";
                    record +=      "Xoá"
                    record += "</button>";
                    record += "</td>"
                    record +=    "</tr>";
                    let msg ="";
                    if(thao_tac == "Thêm"){
                        $('#list-san-pham').append(record);
                        msg = "Thêm dữ liệu thành công.";
                        alert(msg);
                        if($('#display-image').length){
                            $('#display-image').replaceWith('<div data-img="" class="img-fluid" id="where-replace">' + "<span></span>" + "</div>");
                        }
                    } else if(thao_tac == "Sửa") {
                        msg = "Sửa dữ liệu thành công.";
                        alert(msg);
                        $('#san-pham' + res_json.id).replaceWith(record);
                        $('#display-image').replaceWith('<div data-img="" class="img-fluid" id="where-replace">' + "<span></span>" + "</div>");
                       
                    } else if(thao_tac == "Xoá") {
                        msg = "Xoá dữ liệu thành công.";
                        alert(msg);
                        $('#san-pham' + res_json.id).remove();
                        $('#display-image').replaceWith('<div data-img="" class="img-fluid" id="where-replace">' + "<span></span>" + "</div>");
                    }
                    $('#form-san-pham').trigger('reset');
                    $("#msg_style").removeAttr('style');
                    $("#msg").text(msg);
                    $('#modal-xl').modal('hide');

                } else if(res_json.statusCode == 202) {
                    $("#name_err").text(res_json.name_err);
                    $("#name_type_err").text(res_json.name_type_err);
                    $("#name_desc_err").text(res_json.name_desc_err);
                    $("#count_err").text(res_json.count_err);
                    $("#price_err").text(res_json.price_err);
                    $("#image_err").text(res_json.image_err);
                } else if(res_json.statusCode == 201){
                    alert("Đã xảy ra lỗi");
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});