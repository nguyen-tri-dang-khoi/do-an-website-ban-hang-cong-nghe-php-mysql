<!-- ****** New Arrivals Area Start ****** -->
<section class="new_arrivals_area section_padding_100_0 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section_heading text-center">
                            <h2>Danh Mục</h2>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $loaisanphams = DP::run_query("select * from loaisanphams where da_xoa = 0",[],2);
            ?>
            <div class="karl-projects-menu mb-100">
                <div class="text-center portfolio-menu">
                <?php
                    foreach($loaisanphams as $loaisanpham) {
                ?>
                    <button class="btn active" data-filter=".<?=$loaisanpham["id"];?>a"><?=$loaisanpham["ten_loai_san_pham"];?></button>
                <?php
                    }
                ?>
                </div>
            </div>

            <div class="container">
                <div class="row karl-new-arrivals">
                    <?php
                        foreach($loaisanphams as $loaisanpham) {
                            $sanphams = DP::run_query("select * from sanphams where sanphams.loai_san_pham_id = ?",[$loaisanpham["id"]],2);
                            
                            foreach($sanphams as $sanpham) {
                    ?>
                                <!-- Single gallery Item Start -->
                                <div class="col-12 col-sm-6 col-md-4 single_gallery_item <?php echo $loaisanpham["id"];?>a wow fadeInUpBig" data-wow-delay="0.2s">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <img src=<?php echo 'admin/'._DIR_['IMG']['ADMINS'].'product/'.$sanpham["hinh_anh"];?> alt="">
                                        <div class="product-quicview">
                                            <a 
                                                data-id="<?php echo $sanpham["id"];?>" 
                                                data-name="<?php echo $sanpham["ten_san_pham"];?>" 
                                                data-count="<?php echo $sanpham["so_luong"];?>"
                                                data-price="<?php echo $sanpham["don_gia"];?>"
                                                data-img="<?php echo $sanpham["hinh_anh"];?>"
                                                class="btn-xem-chi-tiet-sp">
                                                <i class="ti-plus">
                                                
                                                </i>
                                                <span style="font-size:12px;">Xem chi tiết</span>
                                                <p id="mo-ta-sp<?php echo $sanpham["id"];?>" style="display:none;"><?php echo $sanpham["mo_ta_san_pham"];?></p>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Product Description -->
                                    <div class="product-description">
                                        <h4 class="product-price"><?php echo $sanpham["don_gia"];?> đ</h4>
                                        <p><?php echo $sanpham["ten_san_pham"];?></p>
                                        
                                        <!-- Add to Cart -->
                                        <form id="form-sp-<?php echo $sanpham["id"]?>" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ;?>" method="post">
                                            <input type="hidden" name="name" value="<?php echo $sanpham["ten_san_pham"];?>">
                                            <div class="form-group">
                                                <label for="number">Số lượng: </label>
                                                <input type="number" min="1" max="<?php echo $sanpham["so_luong"];?>" name="count" value="1">
                                            </div>
                                            <input type="hidden" name="price" value="<?php echo $sanpham["don_gia"];?>">
                                            <input type="hidden" name="image" value="<?php echo $sanpham["hinh_anh"];?>">
                                            <input type="hidden" name="id_san_pham" value="<?php echo $sanpham["id"];?>">
                                            <button data-id="<?php echo $sanpham["id"]?>" type="submit" class="them-pt-gio-hang btn add-to-cart-btn">Thêm vào giỏ hàng</button>
                                        </form>
                                    </div>
                                </div>

                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </section>
        <!-- ****** New Arrivals Area End ****** -->