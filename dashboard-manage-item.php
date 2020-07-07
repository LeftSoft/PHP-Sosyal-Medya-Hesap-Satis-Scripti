<?php 
include 'header.php'; 
if ($say==0) {

  Header("Location:/media/index.php");
  exit;

}
?>

<body class="preload dashboard-edit">



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
                                <a href="#">Satışları Yönet</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Satışları Yönet</h1>
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
    <section class="dashboard-area">
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
                            <li>
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
                            <li class="active">
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
<?php  
                                        $k_id=$kullanicicek['k_id'];
                                        $satissorr=$db->prepare("SELECT COUNT(*) FROM satis where k_id={$k_id}");
                                        $satissorr->execute(); 
                                        $satissay = $satissorr->fetchColumn();
                                        ?>
        <div class="dashboard_contents">
            <div class="container">
                <?php
                if ($_GET['durum']=="kayitbasarili") {?>
                            <div class="alert alert-success" role="alert">
                                  <span class="alert_icon lnr lnr-checkmark-circle"></span>
                                <strong>Başarılı!</strong> Düzenlenme gerçekleşti!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                    
                <?php } else if($_GET['durum']=="basarisiz"){?>
                    <div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Başarısız!</strong> Lütfen Tekrar Deneyiniz.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="filter-bar dashboard_title_area clearfix filter-bar2">
                            <div class="dashboard__title dashboard__title pull-left">
                                <h3>Satışları Yönet</h3>
                            </div>

                            <div class="pull-right">
                                <div class="filter__option filter--text">
                                    <p>
                                        <span><?php echo $satissay; ?></span> Ürün</p>
                                </div>

                                
                            </div>
                            <!-- end /.pull-right -->
                        </div>
                        <!-- end /.filter-bar -->
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->

                <div class="row">



<?php 
         $sayfada = 6; // sayfada gösterilecek içerik miktarını belirtiyoruz.
                     $sorgu=$db->prepare("SELECT * FROM satis where satis_onay=1 and k_id={$k_id}");
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
        $satissor=$db->prepare("SELECT * FROM satis where satis_onay=1 and k_id={$k_id} order by satis_id DESC limit $limit,$sayfada");
        $satissor->execute();

        while($satiscek=$satissor->fetch(PDO::FETCH_ASSOC)) {

         ?>
                    <!-- start .col-md-4 -->
                    <div class="col-lg-4 col-md-6">
                        <!-- start .single-product -->
                        <div class="product product--card">

                            <div class="product__thumbnail">
                                <img src="<?php echo $satiscek['satis_resim']; ?>">

                                <div class="prod_option">
                                    <a href="#" id="drop2" class="dropdown-trigger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="lnr lnr-cog setting-icon"></span>
                                    </a>

                                    <div class="options dropdown-menu" aria-labelledby="drop2">
                                        <ul>
                                            <li>
                                                <a href="edit-item.php?satis_id=<?php echo $satiscek['satis_id']; ?>">
                                                    <span class="lnr lnr-pencil"></span>Düzenle</a>
                                            </li>
                                            
                                            <li>
                                                <a href="/ayar/islem.php?satis_id=<?php echo $satiscek['satis_id']; ?>&satissil=ok" class="delete">
                                                    <span class="lnr lnr-trash"></span>Sil</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
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

                               <?php echo $satiscek['satis_aciklama']; ?>
                            </div>
                            <!-- end /.product-desc -->

                            <div class="product-purchase">
                                <div class="price_love">
                                    <span>  <?php echo $satiscek['satis_fiyat']; ?>₺</span>
                                    
                                </div>
                               
                            </div>
                            <!-- end /.product-purchase -->
                        </div>
                        <!-- end /.single-product -->
                    </div>
                    <!-- end /.col-md-4 -->
<?php } ?>






                </div>

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
                                
                                <a class="page-numbers current" href="dashboard-manage-item?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>
                            <?php } else {?> 
                                <a class="page-numbers" href="dashboard-manage-item?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>
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
            <!-- end /.container -->
        </div>
        <!-- end /.dashboard_menu_area -->
    </section>
    <!--================================
            END DASHBOARD AREA
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