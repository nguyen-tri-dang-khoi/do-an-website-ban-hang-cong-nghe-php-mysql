<!-- ****** Quick View Modal Area Start ****** -->
<div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                    <div class="modal-body">
                        <div class="quickview_body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="quickview_pro_img">
                                            <img id="anh-san-pham" src=<?php echo _DIR_['IMG']['ADMINS'].'product/';?> alt="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="quickview_pro_des">
                                            <h4 id="ten" class="title"></h4>
                                            <div class="top_seller_product_rating mb-15">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                            <h5 id="gia" class="price"></h5>
                                            <p id="mo-ta"></p>
                                            <span>Số lượng còn lại: </span>
                                            <span id="sl"></span>
                                        </div>
                                    </div>
                                </div>
                                <!--Bình luận-->
                                <div class="row">
                                    <h6 id="title-comment" style="margin-left:15px;">Bình luận (0)</h6>

                                     <!-- /.card-body -->
                                    <div id="list-comment" class="col-md-12">
                                        
                                    </div>
                                    <br><br>
                                    <?php
                                        if(isset($_SESSION["isUserLoggedIn"]) && $_SESSION["isUserLoggedIn"] === true) {
                                    ?>
                                    <!-- /.card-footer -->
                                    <div class="col-md-12">
                                        <form action="<?php echo htmlspecialchars('load_comment.php');?>" method="post">
                                            <img class="img-circle img-sm" src="<?php echo _DIR_["IMG"]["USERS"].'info/'.$_SESSION["photo"];?>" alt="Alt Text">
                                            <!-- .img-push is used to add margin to elements next to floating images -->
                                            <div class="img-push">
                                                <input type="text" name="comment" class="form-control form-control-sm" placeholder="Nhập nội dung bình luận...">
                                                <input type="hidden" name="san_pham_id">
                                                <button class="btn-gui-binh-luan btn btn-success" type="submit">Gửi</button>
                                            </div>
                                            
                                        </form>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ****** Quick View Modal Area End ****** -->