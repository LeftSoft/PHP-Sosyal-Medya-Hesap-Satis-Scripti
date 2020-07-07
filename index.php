<?php include 'header.php'; ?>

    <section class="hero-area bgimage">
        <div class="bg_image_holder">
            <img src="images/hero_area_bg1.jpg" alt="background-image">
        </div>
        <!-- start hero-content -->
        <div class="hero-content content_above">
            <!-- start .contact_wrapper -->
            <div class="content-wrapper">
                <!-- start .container -->
                <div class="container">
                    <!-- start row -->
                    <div class="row">
                        <!-- start col-md-12 -->
                        <div class="col-md-12">
                            <div class="hero__content__title">
                                <h1>
                                    <span class="light">Kendi Dijital Ürün</span>
                                    <span class="bold">Pazarınızı Oluşturun</span>
                                </h1>
                                
                            </div>

                            <!-- start .hero__btn-area-->
                            <div class="hero__btn-area">
                                <a href="all-products.php" class="btn btn--round btn--lg">Tüm ürünleri görüntüle</a>
                           
                            </div>
                            <!-- end .hero__btn-area-->
                        </div>
                        <!-- end /.col-md-12 -->
                    </div>
                    <!-- end /.row -->
                </div>
                <!-- end /.container -->
            </div>
            <!-- end .contact_wrapper -->
        </div>
        <!-- end hero-content -->

        <!--start search-area -->
        
        <!--start /.search-area -->
    </section>
    <!--================================
    END HERO AREA
=================================-->

   


    <!--================================
    START PRODUCTS AREA
=================================-->
    <section class="products section--padding">
        <!-- start container -->
        <div class="container">
            <!-- start row -->
            <div class="row">
                <!-- start col-md-12 -->
                <div class="col-md-12">
                    <div class="product-title-area">
                        <div class="product__title">
                            <h2>Son Eklenen Hesaplar</h2>
                        </div>

                       
                    </div>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->

      

            <!-- start .row -->
            <div class="row">
                <!-- start .col-md-4 -->
                 <?php 
      
        $satissor=$db->prepare("SELECT * FROM satis where satis_onay=1 Order By satis_id DESC LIMIT 9");
        $satissor->execute();

        while($satiscek=$satissor->fetch(PDO::FETCH_ASSOC)) {

         ?>
                <div class="col-lg-4 col-md-6">
                    <!-- start .single-product -->
                    <div class="product product--card">

                        <div class="product__thumbnail">
                            <img src="<?php echo $satiscek['satis_resim']?>">
                            <div class="prod_btn">
                                <a href="satis/<?=seo($satiscek["satis_baslik"]).'/'.$satiscek["satis_id"]?>" class="transparent btn--sm btn--round">Daha Fazla Bilgi</a>
                                
                            </div>
                            <!-- end /.prod_btn -->
                        </div>
                        <!-- end /.product__thumbnail -->

                        <div class="product-desc">
                            <a href="satis/<?=seo($satiscek["satis_baslik"]).'/'.$satiscek["satis_id"]?>" class="product_title">
                                <h4><?php echo $satiscek['satis_baslik']; ?></h4>
                            </a>
                            <ul class="titlebtm">
                                <li>
                                    <img class="auth-img" src="images/usr_avatar.png">
                                    <p>
                                   <?php echo $satiscek['k_satan']; ?>
                                    </p>
                                </li>
                                 <li class="product_cat">
                                   
                                        <?php echo $satiscek['satis_kategori']; ?>
                                </li>
                            </ul>

                           <p><?php $detay =  $satiscek['satis_aciklama'];
                                                                $uzunluk = strlen($detay);
                                                              $limit = 38;
                                                              if($uzunluk > $limit)
                                                              {
                                                                $detay = substr($detay,0,$limit)."...";
                                                              }
                                                              echo $detay;
                                                               ?></p>
                        </div>
                        <!-- end /.product-desc -->

                        <div class="product-purchase">
                            <div class="price_love">
                                <span><?php echo $satiscek['satis_fiyat']; ?>₺</span>
                               
                            </div>
                           
                        </div>
                        <!-- end /.product-purchase -->
                    </div>
                    <!-- end /.single-product -->
                </div>
                <!-- end /.col-md-4 -->

<?php } ?>
                

               

               

            </div>
            <!-- end /.row -->

            <!-- start .row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="more-product">
                        <a href="all-products.php" class="btn btn--lg btn--round">Tüm Yeni Ürünler</a>
                    </div>
                </div>
                <!-- end ./col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
    END PRODUCTS AREA
=================================-->


 

    <!--================================
    START COUNTER UP AREA
=================================-->
    <section class="counter-up-area bgimage">
        <div class="bg_image_holder">
            <img src="images/countbg.jpg" alt="">
        </div>
        <!-- start .container -->
        <div class="container content_above">
            <!-- start .col-md-12 -->
            <div class="col-md-12">
                <div class="counter-up">
                    <div class="counter mcolor2">
                        <span class="lnr lnr-briefcase"></span>
                        <span class="count">38,436</span>
                        <p>Satılık Hesaplar</p>
                    </div>
                    <div class="counter mcolor3">
                        <span class="lnr lnr-cloud-download"></span>
                        <span class="count">38,436</span>
                        <p>Toplam Satış</p>
                    </div>
                    <div class="counter mcolor1">
                        <span class="lnr lnr-smile"></span>
                        <span class="count">38,436</span>
                        <p>Mutlu Üye</p>
                    </div>
                    <div class="counter mcolor4">
                        <span class="lnr lnr-users"></span>
                        <span class="count">38,436</span>
                        <p>Toplam Üye</p>
                    </div>
                </div>
            </div>
            <!-- end /.col-md-12 -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
    END COUNTER UP AREA
=================================-->



    <!--================================
    START SELL BUY
=================================-->
    <section class="proposal-area">

        <!-- start container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 no-padding">
                    <div class="proposal proposal--left bgimage">
                        <div class="bg_image_holder">
                            <img src="images/bbg.png" alt="prop image">
                        </div>
                        <div class="content_above">
                            <div class="proposal__icon ">
                                <img src="images/buy.png" alt="Buy icon">
                            </div>
                            <div class="proposal__content ">
                                <h1 class="text--white">Ürünlerinizi Satmaya Başlayın</h1>
                                
                            </div>
                            <a href="signup.php" class="btn--round btn btn--lg btn--white">Ürün Satmaya Başla</a>
                        </div>
                    </div>
                    <!-- end /.proposal -->
                </div>

                <div class="col-md-6 no-padding">
                    <div class="proposal proposal--right">
                        <div class="bg_image_holder">
                            <img src="images/sbg.png" alt="this is magic">
                        </div>
                        <div class="content_above">
                            <div class="proposal__icon">
                                <img src="images/sell.png" alt="Sell icon">
                            </div>
                            <div class="proposal__content ">
                                <h1 class="text--white">Bugün Alışverişe Başlayın</h1>
                               
                            </div>
                            <a href="signup.php" class="btn--round btn btn--lg btn--white">Alışverişe Başla</a>
                        </div>
                    </div>
                    <!-- end /.proposal -->
                </div>
            </div>
        </div>
        <!-- start container-fluid -->
    </section>
    <!--================================
    END SELL BUY
=================================-->



    <!--================================
    START FOOTER AREA
=================================-->
    <?php include 'footer.php'; ?>
    <!--================================
    END FOOTER AREA
=================================-->

    <!--//////////////////// JS GOES HERE ////////////////-->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0C5etf1GVmL_ldVAichWwFFVcDfa1y_c"></script>
    <!-- inject:js -->
    <script src="js/plugins.min.js"></script>
    <script src="js/script.min.js"></script>
    <!-- endinject -->
</body>



</html>