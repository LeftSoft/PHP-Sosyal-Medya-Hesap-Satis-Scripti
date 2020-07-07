<?php 
include 'header.php'; 

$satissor=$db->prepare("SELECT * FROM satis where satis_id=:id");
$satissor->execute(array(
  'id' => $_GET['satis_id']
  ));
$satis = $_GET['satis_id'];
$satiscek=$satissor->fetch(PDO::FETCH_ASSOC);
$say=$satissor->rowCount();
if($say==0)
{
header("Location:index.php");
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
                            
                            <li class="active">
                                <a href="#">Kategori</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title"><?php echo $satiscek['satis_baslik']; ?></h1>
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


    <!--============================================
        START SINGLE PRODUCT DESCRIPTION AREA
    ==============================================-->
    <section class="single-product-desc">
        <div class="container">
            <?php 

                if ($_GET['durum']=="yetersiz") {?>
<div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Satın Alma Başarısız!</strong> Yetersiz Bakiye!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                

                    
                <?php } else if($_GET['durum']=="basarili"){?>
                <div class="alert alert-success" role="alert">
                                  <span class="alert_icon lnr lnr-checkmark-circle"></span>
                                <strong>Satın Alma Başarılı!</strong> Hesap Satın Alındı Lütfen Satıcıyla İrtibata Geçiniz!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                        <?php } else if($_GET['durum']=="no"){?>
                <div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>HATA!</strong> Sistemsel Bir Hata Mevcut Lütfen Kurucuyla İrtibata Geçiniz!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                        <?php } else if($_GET['durum']=="giris"){?>
                             <div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>HATA!</strong> Satın Almanız İçin <a href="/login.php">Giriş</a> Yapmalısınız!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                        <?php } else if($_GET['durum']=="alinmis"){?>
                                <div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Satın Alınamadı!</strong> Daha önceden bir kişi satın aldı
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>

                        <?php } ?>


            <div class="row">
                <div class="col-lg-8">
                    <div class="item-preview">
                        <div class="item__preview-slider">
                            <div class="prev-slide">
                                <img src="<?php echo $satiscek['satis_resim']; ?>">
                            </div>
                            
                        </div>
                        <!-- end /.item--preview-slider -->

                       


                    </div>
                    <!-- end /.item-preview-->

                    <div class="item-info">
                        <div class="item-navigation">
                            <ul class="nav nav-tabs">
                                <li>
                                    <a href="#product-details" class="active" aria-controls="product-details" role="tab" data-toggle="tab">Detaylar</a>
                                </li>
                                
                            </ul>
                        </div>
                        <!-- end /.item-navigation -->

                        <div class="tab-content">
                            <div class="fade show tab-pane product-tab active" id="product-details">
                                <div class="tab-content-wrapper">
                                   <p> <?php echo $satiscek['satis_aciklama']; ?> </p>
                                </div>
                            </div>
                            <!-- end /.tab-content -->

                        </div>
                        <!-- end /.tab-content -->
                    </div>
                    <!-- end /.item-info -->
                </div>
                <!-- end /.col-md-8 -->

                <?php 

                    if (isset($_POST['satinal'])) {
                        $satisdurum=$satiscek['satis_durum'];
                        if ($satisdurum==1) {
                          Header("Location:?durum=alinmis");
                        }
                        else{
                       $tarih =  date("d.m.Y");
                            $fiyat=$satiscek['satis_fiyat'];
$hesapfiyat= $kullanicicek['k_bakiye'];
if ($hesapfiyat>=$fiyat) {
     $bildirimmesaj = 'Hesap Satın Aldı!';
     $k_isim=$kullanicicek['k_isim'];
     $k_id=$kullanicicek['k_id'];
    $kaydet=$db->prepare("UPDATE kullanici SET
    k_bakiye=:k_bakiye 
    WHERE k_id={$bildirim}");
  $update=$kaydet->execute(array(
    'k_bakiye' => $hesapfiyat-$fiyat
    ));

  if ($update) {

    $kaydet2=$db->prepare("UPDATE satis SET
    k_satinalan=:k_satinalan,
    k_satinalani=:k_satinalani,
    k_tarih=:k_tarih,
    satis_durum=:satis_durum
    WHERE satis_id={$satis}");
  $update2=$kaydet2->execute(array(
    'k_satinalan' => $k_id,
    'k_satinalani' => $k_isim,
    'k_tarih' => $tarih,
    'satis_durum' => 1
    ));

    Header("Location:?durum=basarili");
   

  } else {

    Header("Location:?durum=no");
  }
}
else if($say==1){
    
    Header("Location:?durum=giris");
    
}
else if($hesapfiyat<$fiyat)
{
    Header("Location:?durum=yetersiz");
}
                        }

}
 ?>
                <div class="col-lg-4">
                    <aside class="sidebar sidebar--single-product">
                        <form action="" method="POST">
                        <div class="sidebar-card card-pricing">
                            <div class="price">
                                <h1>
                                    <?php echo $satiscek['satis_fiyat']; ?><sup>₺</sup></h1>
                                    
                            </div>
                          <?php
                          $satisdurum=$satiscek['satis_durum']; 
                          $kisi = $satiscek['k_id'];
                          if($satisdurum==1){?>
                         
                            <div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Üzgünüz!</strong> Önceden Hesap Satın Alınmış
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                           
                            <?php } else{?>
                                <?php if($kisi!=$bildirim){ ?>
                                <div class="purchase-button">
                                
                                <button class="btn btn--lg btn--round" type="submit" name="satinal">Satın Al</button>
                                
                            </div>
                            <?php } ?>

                            <?php } ?>
                           
                          
                            
                           
                           

                            
                            <!-- end /.purchase-button -->
                        </div>
                        <!-- end /.sidebar--card -->
                        </form>
                       

                        <div class="sidebar-card card--product-infos">
                            <div class="card-title">
                                <h4>Satış Bilgileri</h4>
                            </div>

                            <ul class="infos">
                                <li>
                                    <p class="data-label">Tarih</p>
                                    <p class="info"><?php echo $satiscek['satis_tarih']; ?></p>
                                </li>
                               
                                <li>
                                    <p class="data-label">Kategori</p>
                                    <p class="info"><?php echo $satiscek['satis_kategori']; ?></p>
                                </li>
                               
                            </ul>
                        </div>
                        <!-- end /.aside -->

                        <div class="author-card sidebar-card ">
                            <div class="card-title">
                                <h4>Satıcı Bilgileri</h4>
                            </div>

                            <div class="author-infos">
                                <div class="author_avatar">
                                    <img src="images/100x100.png">
                                </div>

                                <div class="author">
                                    <h4><?php echo $satiscek['k_satan']; ?></h4>
                                </div>
                                <!-- end /.author -->

                              
                                <div class="author-btn">
                                   
                                    <a href="message?k_id=<?php echo $satiscek['k_id']; ?>" class="btn btn--sm btn--round">Mesaj Göder</a>
                                </div>
                                <!-- end /.author-btn -->
                            </div>
                            <!-- end /.author-infos -->


                        </div>
                        <!-- end /.author-card -->
                    </aside>
                    <!-- end /.aside -->
                </div>
                <!-- end /.col-md-4 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--===========================================
        END SINGLE PRODUCT DESCRIPTION AREA
    ===============================================-->

    
   


    <?php include 'footer.php'; ?>

    <!--//////////////////// JS GOES HERE ////////////////-->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0C5etf1GVmL_ldVAichWwFFVcDfa1y_c"></script>
    <!-- inject:js -->
    <script src="js/plugins.min.js"></script>
    <script src="js/script.min.js"></script>
    <!-- endinject -->
</body>



</html>