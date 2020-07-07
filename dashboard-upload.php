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
                                <a href="#">Hesap Satışı Yap</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Satış Yap</h1>
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
                            
                            <li class="active">
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
                 <?php 
                if ($_GET['durum']=="kayitbasarili") {?>
                            <div class="alert alert-success" role="alert">
                                  <span class="alert_icon lnr lnr-checkmark-circle"></span>
                                <strong>Başarılı!</strong> Onaya Gönderildi!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                    
                <?php } else if($_GET['durum']=="basarisiz"){?>

<div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Başarısız!</strong> Onaya Gönderilmedi Lütfen Tekrar Deneyiniz.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h3>Hesap Satışı Yapın</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
<?php 
$tarih=date("d.m.Y");
$k_id=$kullanicicek['k_id'];
$satan=$kullanicicek['k_isim'];
if (isset($_POST['urunyukle'])) {

if ($_POST['satis_kategori']=="instagram") {
    $resim = "images/instagram.jpg";
}
else if ($_POST['satis_kategori']=="facebook") {
    $resim = "images/facebook.jpg";
}
else if ($_POST['satis_kategori']=="youtube") {
    $resim = "images/youtube.jpg";
}
else if ($_POST['satis_kategori']=="tiktok") {
    $resim = "images/tiktok.jpg";
}
else if ($_POST['satis_kategori']=="twitter") {
    $resim = "images/twitter.jpg";
}
else if ($_POST['satis_kategori']=="snapchat") {
    $resim = "images/snapchat.png";
}


$urunkaydet=$db->prepare("INSERT INTO satis SET
          k_id=:k_id,
          k_satan=:k_satan,
          satis_resim=:satis_resim,
          satis_tarih=:satis_tarih,
          satis_kategori=:satis_kategori,
          satis_baslik=:satis_baslik,
          satis_aciklama=:satis_aciklama,
          satis_fiyat=:satis_fiyat
          ");
        $insert=$urunkaydet->execute(array(
          'k_id' => $k_id,
          'k_satan' => $satan,
          'satis_resim' => $resim,
          'satis_tarih' => $tarih,
          'satis_kategori' => $_POST['satis_kategori'],
          'satis_baslik' => $_POST['satis_baslik'],
          'satis_aciklama' => strip_tags($_POST['satis_aciklama']),
          'satis_fiyat' => $_POST['satis_fiyat']
        ));
        if ($insert) {
          header("Location:?durum=kayitbasarili");

        
        } else {
         header("Location:?durum=basarisiz");
        }


}
 ?>
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="POST">
                            <div class="upload_modules">
                                <div class="modules__title">
                                    <h3>Öğe Adı ve Açıklama</h3>
                                </div>
                                <!-- end /.module_title -->

                                <div class="modules__content">
                                    <div class="form-group">
                                        <label for="category">Kategori Seç</label>
                                        <div class="select-wrap select-wrap2">
                                            <select name="satis_kategori" id="category" class="text_field">
                                                <option value="instagram">İnstagram</option>
                                                <option value="facebook">Facebook</option>
                                                <option value="youtube">Youtube</option>
                                                <option value="tiktok">Tiktok</option>
                                                <option value="twitter">Twitter</option>
                                                <option value="snapchat">Snapchat</option>
                                            </select>
                                            <span class="lnr lnr-chevron-down"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_name">Ürün Adı
                                        </label>
                                        <input type="text" id="product_name" class="text_field" name="satis_baslik" placeholder="Ürün Adını Giriniz...">
                                    </div>

                                    <div class="form-group no-margin">
                                        <p class="label">Ürün Açıklaması</p>
                                        <textarea name="satis_aciklama"></textarea>
                                    </div>
                                    
                                </div>
                                <!-- end /.modules__content -->
                            </div>
                            

                            

                            <div class="upload_modules with--addons">
                                <div class="modules__title">
                                    <h3>Fiyat Bilgisi</h3>
                                </div>
                                <!-- end /.module_title -->

                                <div class="modules__content">
                                    <div class="row">
                                        
                                       
                                        <div class="col-md-12">
                                            <div class="form-group" align="center">
                                                <label for="exlicense">Fiyat</label>
                                                <div class="input-group">
                                                   
                                                    <input type="text" id="exlicense" name="satis_fiyat" class="text_field" placeholder="00">

                                                </div>
                                            </div>
                                        </div>
                                        <!-- end /.col-md-6 -->

                                    </div>
                                  
                                </div>
                                <!-- end /.modules__content -->
                            </div>
                            <!-- end /.upload_modules -->

                            <!-- submit button -->
                            <button type="submit" name="urunyukle" class="btn btn--round btn--fullwidth btn--lg">Ürünü İncelemeye Gönder</button>
                        </form>
                    </div>
                    <!-- end /.col-md-8 -->
                    
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

    <!--//////////////////// JS GOES HERE ////////////////-->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0C5etf1GVmL_ldVAichWwFFVcDfa1y_c"></script>
    <!-- inject:js -->
    <script src="js/plugins.min.js"></script>
    <script src="js/script.min.js"></script>
    <!-- endinject -->
</body>


</html>