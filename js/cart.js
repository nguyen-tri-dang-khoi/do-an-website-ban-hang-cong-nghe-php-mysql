$(document).ready(function(){
    // thêm phần tử giỏ hàng
    $(document).on('click','.them-pt-gio-hang',function(event){
        event.preventDefault();
        let thao_tac = "Thêm";
        let id = $(this).attr('data-id');
        let form = "#form-sp-"+id;
        let name = $(form + ' > input[name=name]').val();
        let url = window.location.href;
        let count = $(form + ' input[name=count]').val();
        let price = $(form + ' > input[name=price]').val();
        let id_san_pham = $(form + ' > input[name=id_san_pham]').val();
        let image = $(form + ' > input[name=image]').val();
        $.ajax({
            url: url,
            type: "POST",
            data: {
                thao_tac: thao_tac,
                name:name,
                count:count,
                price:price,
                id_san_pham:id_san_pham,
                image: image,
            },
            success:function(data){
                data = JSON.parse(data);
                if(data.statusCode == 200) {
                    alert("Bạn đã thêm sản phẩm vào giỏ hàng thành công.");
                } else if(data.statusCode == 201) {
                    alert("Đã có lỗi xảy ra. Vui lòng reload lại trang web.");
                }
            },
            error: function(data){
                console.log("Error: ",data);
            }
        });
    });

    // sửa phần tử giỏ hàng
    $(document).on('click','.sua-pt-gio-hang',function(event){
        event.preventDefault();
        let thao_tac = "Sửa";
        let url = window.location.href;
        let position = $(this).attr("data-id");
        let count = $('#qty'+position).val();
        $.ajax({
            url:url,
            type:"POST",
            cache:false,
            data:{
                thao_tac: thao_tac,
                position: position,
                count: count,
            },
            success:function(res) {
                res = JSON.parse(res);
                alert("Bạn đã cập nhật giỏ hàng thành công.");
                $("#cart-id" + position +" .qty-text").val(res.count);
                $("#cart-id" + position +" .total_price").html("<span>" + res.money + "</span>");
                
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    // xoá phần tử giỏ hàng
    $(document).on('click','.xoa-pt-gio-hang',function(event){
        event.preventDefault();
        let thao_tac = "Xoá";
        let position = $(this).attr("data-id");
        let count = $('#qty'+position).val();
        let url = window.location.href;
        $.ajax({
            url:url,
            type:"POST",
            dataType:"json",
            data:{
                thao_tac: thao_tac,
                position: position,
                count: count
            },
            success:function(res) {
                alert("Bạn đã xoá sản phẩm trong giỏ hàng thành công.");
                $("#cart-id"+position).remove();
                
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});