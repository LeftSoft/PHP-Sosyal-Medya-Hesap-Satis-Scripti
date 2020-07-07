
<?php 
include 'header.php'; 
                    
if (isset($_POST['arama'])) {

    $aranan=$_POST['aranan'];
    $satissor=$db->prepare("SELECT * FROM satis where satis_onay=1 and satis_baslik LIKE ?");
    $satissor->execute(array("%$aranan%"));

    $say=$satissor->rowCount();

} else {

    Header("Location:all-products?durum=bos");

}
$satissorr=$db->prepare("SELECT COUNT(*) FROM satis where satis_onay=1");
                                        $satissorr->execute(); 
                                        $satissay = $satissorr->fetchColumn();
?>

    <!--================================
        START SEARCH AREA
    =================================-->
    <section class="search-wrapper">
        <div class="search-area2 bgimage">
            <div class="bg_image_holder">
                <img src="images/search.jpg" alt="">
            </div>
            <div class="container content_above">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="search">
                            <div class="search__title">
                                <h3>
                                    Toplamda<span> <?php echo $satissay; ?></span> Satış Bulunmaktadır. </h3>
                            </div>
                            <div class="search__field">
                                <form action="" method="POST">
                                    <div class="field-wrapper">
                                        <input class="relative-field rounded" name="aranan" type="text" placeholder="Arama yapın..">
                                        <button class="btn btn--round" name="arama" type="submit">Search</button>
                                    </div>
                                </form>
                            </div>
                            <div class="breadcrumb">
                                <ul>
                                    <li>
                                        <a href="#">Anasayfa</a>
                                    </li>
                                    <li class="active">
                                        <a href="#">Bütün Hesaplar</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.search-area2 -->
    </section>
    <!--================================
        END SEARCH AREA
    =================================-->

    


    <!--================================
        START PRODUCTS AREA
    =================================-->
    <section class="products">
        <!-- start container -->
        <div class="container">

            <!-- start .row -->
            <div class="row">
                <?php   if ($say==0) {
                    echo "Aradığınız şeyi bulamadık.";
                }
 ?>

                <?php 
                    
      
        while($satiscek=$satissor->fetch(PDO::FETCH_ASSOC)) {

         ?>
                <!-- start .col-md-4 -->
                <div class="col-lg-4 col-md-6">
                    <!-- start .single-product -->
                    <div class="product product--card">

                        <div class="product__thumbnail">
                            <img src="<?php echo $satiscek['satis_resim']?>" alt="Product Image">
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
                                    <img class="auth-img" src="images/usr_avatar.png" alt="author image">
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

                        <div class="product-purchase" align="center">
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

            <div class="row">
                <div class="col-md-12">
                    <div class="pagination-area">
                        <nav class="navigation pagination" role="navigation">
                            <div class="nav-links">
                                <?php

                                      $s=0;

                                      while ($s < $toplam_sayfa) {

                                       $s++; ?>
                                       <?php 

                                       if ($s==$sayfa) {?>
                                
                                <a class="page-numbers current" href="all-products?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>
                            <?php } else {?> 
                                <a class="page-numbers" href="all-products?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>
                               <?php   }

                          }

                          ?>
                               
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
        END PRODUCTS AREA
    =================================-->


   <?php include 'footer.php'; ?>

    <!--//////////////////// JS GOES HERE ////////////////-->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0C5etf1GVmL_ldVAichWwFFVcDfa1y_c"></script>
    <!-- inject:js -->
    <script src="js/plugins.min.js"></script>
    <script src="js/script.min.js"></script>
    <!-- endinject -->
</body>



</html>