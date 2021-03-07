<!-- ****** Cart Area Start ****** -->
<div class="cart_area section_padding_100 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Số tiền</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="list-cart">
                                <?php
                                    $i = 0;
                                    foreach($_SESSION["cart"] as $cart) {
                                ?>
                                    <tr id="cart-id<?php echo $i;?>">
                                        <td class="cart_product_img d-flex align-items-center">
                                            <a href="#"><img src=<?php echo 'admin/'._DIR_['IMG']['ADMINS'].'product/'.$cart["image"];?> alt="Product"></a>
                                            <h6><?php echo $cart["name"]?></h6>
                                        </td>
                                        <td class="price"><span><?php echo $cart["price"]?></span></td>
                                        <td class="qty">
                                            <div class="quantity">
                                                <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                <input type="number" class="qty-text" id="qty<?php echo $i;?>" step="1" min="1" max="99" name="quantity" value="<?php echo $cart["count"]?>">
                                                <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                            </div>
                                        </td>
                                        <td class="total_price"><span><?php echo $cart["money"]?></span></td>
                                        <td>
                                            <button data-id="<?php echo $i;?>" class="sua-pt-gio-hang btn btn-primary">Sửa</button>  
                                            <button data-id="<?php echo $i;?>" class="xoa-pt-gio-hang btn btn-danger">Xoá</button>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="cart-footer d-flex mt-30">
                            <div class="back-to-shop w-50">
                                <a href="index.php">Tiếp tục mua sắm</a>
                            </div>
                            <div class="update-checkout w-50 text-right">
                                <form action="<?php echo htmlspecialchars("user_cart_cancel.php");?>" method="post">
                                    <button class="btn btn-danger" type="submit" id="btn-cart-cancel">Huỷ giỏ hàng</button>
                                </form> 
                            </div>
                            <div class="update-checkout w-50 text-right">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                <input type="hidden" name="bill" value="1">
                                <button type="submit" class="btn btn-success">Thanh toán đơn hàng</a>
                            </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- ****** Cart Area End ****** -->