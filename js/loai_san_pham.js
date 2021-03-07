$(document).ready(function(){
    // reset lỗi 
    $(document).on('click','#btn-them-loai-san-pham,#btn-sua-loai-san-pham,#btn-xoa-loai-san-pham',function(event){
        $('#form-loai-san-pham').trigger('reset');
        $('#ten_loai_san_pham_err').text("");
    });

    // thêm loại sản phẩm
    $(document).on('click','#btn-them-loai-san-pham',function(event){
        $('#btn-luu-loai-san-pham').text('Thêm');
        $('#form-loai-san-pham').trigger('reset');
        $('#modal-xl').modal('show');

    });

    // sửa loại sản phẩm
    $(document).on('click','.btn-sua-loai-san-pham',function(event){
        let id = $(event.currentTarget).attr('data-id');
        let ten_loai_san_pham = $(event.currentTarget).attr('data-name');

        $('#btn-luu-loai-san-pham').text('Sửa');
        $('#form-loai-san-pham').trigger('reset');
        $('#modal-xl').modal('show');

        
        $('input[name=id]').val(id);
        $('input[name=ten_loai_san_pham]').val(ten_loai_san_pham);
    });

    // xoá loại sản phẩm
    $(document).on('click','.btn-xoa-loai-san-pham',function(event){
        let id = $(event.currentTarget).attr('data-id');
        let ten_loai_san_pham = $(event.currentTarget).attr('data-name');

        $('#btn-luu-loai-san-pham').text('Xoá');
        $('#modal-xl').modal('show');

        $('input[name=id]').val(id);
        $('input[name=ten_loai_san_pham]').val(ten_loai_san_pham);
    });

    // xử lý thao tác thêm xoá sửa
    $(document).on('click','#btn-luu-loai-san-pham',function(event){
        event.preventDefault();
        let id = $('input[name=id]').val();
        let ten_loai_san_pham = $('input[name=ten_loai_san_pham]').val();
        let thao_tac = $('#btn-luu-loai-san-pham').text();
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
            data:{
                name:ten_loai_san_pham,
                thao_tac: thao_tac,
            },
            success:function(res){
                let res_json = JSON.parse(res);
                if(res_json.statusCode == 200){
                    let record = "<tr id='loai-san-pham" + res_json.id + "'>" ;
                    record += "<td>" + res_json.id + "</td>";
                    record += "<td>" + res_json.ten_loai_san_pham + "</td>";
                    record += "<td>" + res_json.created_at + "</td>";
                    record += "<td>"
                    record += "<button class='btn-sua-loai-san-pham btn btn-primary' ";
                    record +=   "data-name='" + res_json.ten_loai_san_pham + "' data-id='" + res_json.id + "'>";
                    record +=      "Sửa"
                    record +  "</button>";
                    record += "<button class='btn-xoa-loai-san-pham btn btn-danger' data-name='" + res_json.ten_loai_san_pham+ "' ";
                    record +=   "data-id='" + res_json.id + "'>";
                    record +=      "Xoá"
                    record += "</button>";
                    record += "</td>"
                    record +=    "</tr>";
                    if(thao_tac == "Thêm"){
                        $('#list-loai-san-pham').append(record);
                    } else if(thao_tac == "Sửa") {
                        $('#loai-san-pham' + res_json.id).replaceWith(record);
                    } else if(thao_tac == "Xoá") {
                        $('#loai-san-pham' + res_json.id).remove();
                    }
                    $('#form-loai-san-pham').trigger('reset');
                    $('#modal-xl').modal('hide');

                } else if(res_json.statusCode == 201){
                    alert("Đã xảy ra lỗi");
                } else if(res_json.statusCode == 202){
                    $("#ten_loai_san_pham_err").text(res_json.ten_loai_san_pham_err);
                }
            }
        });
    });
});