<?php 
include 'header.php'; 
if ($say==0) {

  Header("Location:/media/index.php");
  exit;

}
?>

    <!--================================
        START BREADCRUMB AREA
    =================================-->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li>
                                <a href="index.php">Anasayfa</a>
                            </li>
                            <li>
                                <a href="dashboard.php">Gösterge Paneli</a>
                            </li>
                            <li class="active">
                                <a href="#">Satın Alım</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Satın Alma İşlemleri</h1>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
            START DASHBOARD AREA
    =================================-->
    <section class="dashboard-area dashboard_purchase">
        <div class="dashboard_menu_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="dashboard_menu">
                             <li>
                                <a href="dashboard.php">
                                    <span class="lnr lnr-chart-bars"></span>Panel</a>
                            </li>
                            
                            <li>
                                <a href="dashboard-setting.php">
                                    <span class="lnr lnr-cog"></span>Ayarlar</a>
                            </li>
                            <li class="active">
                                <a href="dashboard-purchase.php">
                                    <span class="lnr lnr-cart"></span>Satın Alımlar</a>
                            </li>
                            <li>
                                <a href="dashboard-add-credit.php">
                                    <span class="lnr lnr-dice"></span>Kredi Ekle</a>
                            </li>
                            
                            <li>
                                <a href="dashboard-upload.php">
                                    <span class="lnr lnr-upload"></span>Hesap Satışı Yap</a>
                            </li>
                            <li>
                                <a href="dashboard-manage-item.php">
                                    <span class="lnr lnr-briefcase"></span>Satışları Yönet</a>
                            </li>
                            <li>
                                <a href="dashboard-withdrawal.php">
                                    <span class="lnr lnr-briefcase"></span>Para Çekme</a>
                            </li>
                        </ul>
                        <!-- end /.dashboard_menu -->
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.dashboard_menu_area -->

        <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="filter-bar clearfix filter-bar2">

                            <div class="dashboard__title pull-left">
                                <h3>Satın Alma İşlemleriniz</h3>
                            </div>

                            <div class="pull-right">
                                <div class="filter__option filter--text">
                                    <p>
                                        <?php  
                                        $k_id=$kullanicicek['k_id'];
                                        $satissorr=$db->prepare("SELECT COUNT(*) FROM satis where k_satinalan={$k_id}");
                                        $satissorr->execute(); 
                                        $satissay = $satissorr->fetchColumn();
                                        ?>
                                        <span><?php echo $satissay; ?></span> Satın Alınan Hesaplar</p>
                                </div>
                            </div>
                            <!-- end /.pull-right -->
                        </div>
                        <!-- end /.filter-bar -->
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->

                <div class="product_archive">
                    <div class="title_area">
                        <div class="row">
                            <div class="col-md-5">
                                <h4>Hesap Detayları</h4>
                            </div>
                            <div class="col-md-3">
                                <h4 class="add_info">İlave Bilgiler</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Fiyat</h4>
                            </div>
                            
                        </div>
                    </div>

                    <div class="row">

                        <?php 
        $sayfada = 3; // sayfada gösterilecek içerik miktarını belirtiyoruz.
                     $sorgu=$db->prepare("SELECT * FROM satis where k_satinalan={$k_id}");
                     $sorgu->execute();
                     $toplam_icerik=$sorgu->rowCount();
                     $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                     // eğer sayfa girilmemişse 1 varsayalım.
                     $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                            // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
                     if($sayfa < 1) $sayfa = 1; 
                                   // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
                     if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
                     $limit = ($sayfa - 1) * $sayfada;
        $satissor=$db->prepare("SELECT * FROM satis where k_satinalan={$k_id} order by satis_id DESC limit $limit,$sayfada");
        $satissor->execute();

        while($satiscek=$satissor->fetch(PDO::FETCH_ASSOC)) {

         ?>



                        <div class="col-md-12">
                            <div class="single_product clearfix">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="product__description">
                                            <img class="satis" src="<?php echo $satiscek['satis_resim']; ?>">
                                            <div class="short_desc">
                                               <a href="satis/<?=seo($satiscek["satis_baslik"]).'/'.$satiscek["satis_id"]?>"> <h4><?php echo $satiscek['satis_baslik']; ?></h4></a>
                                            </div>
                                        </div>
                                        <!-- end /.product__description -->
                                    </div>
                                    <!-- end /.col-md-5 -->

                                    <div class="col-lg-3 col-md-3 col-6 xs-fullwidth">
                                        <div class="product__additional_info">
                                            <ul>
                                                <li>
                                                    <p>
                                                        <span>Tarih: </span> <?php echo $satiscek['k_tarih']; ?></p>
                                                </li>
                                                <li>
                                                    <p>
                                                        <span>Satan:</span> <?php echo $satiscek['k_satan']; ?></p>
                                                </li>
                                                <li>
                                                    
                                             <?php echo $satiscek['satis_kategori']; ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- end /.product__additional_info -->
                                    </div>
                                    <!-- end /.col-md-3 -->

                                    <div class="col-lg-4 col-md-4 col-6 xs-fullwidth">
                                        <div class="product__price_download">
                                            <div class="item_price v_middle">
                                                <span><?php echo $satiscek['satis_fiyat']; ?></span>
                                            </div>
                                            <div class="item_action v_middle">
                                             
                                                <!-- end /.rating_btn -->
                                            </div>
                                            <!-- end /.item_action -->
                                        </div>
                                        <!-- end /.product__price_download -->
                                    </div>
                                    <!-- end /.col-md-4 -->
                                </div>
                            </div>
                            <!-- end /.single_product -->
                        </div>
<?php } ?>


                        <div class="col-md-12">
                            <div class="pagination-area pagination-area2">
                                <nav class="navigation pagination " role="navigation">
                                    <div class="nav-links">
                                        
                                       <?php

                                      $s=0;

                                      while ($s < $toplam_sayfa) {

                                       $s++; ?>
                                       <?php 

                                       if ($s==$sayfa) {?>
                                
                                <a class="page-numbers current" href="dashboard-purchase?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>
                            <?php } else {?> 
                                <a class="page-numbers" href="dashboard-purchase?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>
                               <?php   }

                          }

                          ?>
                                    </div>
                                </nav>
                            </div>
                            <!-- end /.pagination-area -->
                        </div>
                        <!-- end /.col-md-12 -->
                    </div>
                    <!-- end /.row -->
                </div>





                <!-- end /.product_archive2 -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.dashboard_menu_area -->
    </section>
    <!--================================
            END DASHBOARD AREA
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