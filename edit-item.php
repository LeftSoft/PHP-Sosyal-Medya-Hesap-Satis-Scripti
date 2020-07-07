<?php 
include 'header.php'; 
if ($say==0) {

  Header("Location:index");
  exit;

}
$k_id=$kullanicicek['k_id'];
$satissor1=$db->prepare("SELECT * FROM satis where k_id={$k_id} and satis_id=:id");
$satissor1->execute(array(
  'id' => $_GET['satis_id']
  ));
$satiscek1=$satissor1->fetch(PDO::FETCH_ASSOC);
$satissay=$satissor1->rowCount();
if ($satissay==0) {
    Header("Location:dashboard-manage-item");
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
                                <a href="#">Hesap Satışı Düzenle</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Satış Düzenle</h1>
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
                        <div class="dashboard_title_area">
                            <div class="pull-left">
                                <div class="dashboard__title">
                                    <h3>Hesap Satışı Düzenle</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
<?php 
$tarih=date("d.m.Y");
$satan=$kullanicicek['k_isim'];
if (isset($_POST['urunguncelle'])) {

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


$urunkaydet=$db->prepare("UPDATE satis SET
          k_id=:k_id,
          k_satan=:k_satan,
          satis_resim=:satis_resim,
          satis_tarih=:satis_tarih,
          satis_kategori=:satis_kategori,
          satis_baslik=:satis_baslik,
          satis_aciklama=:satis_aciklama,
          satis_fiyat=:satis_fiyat
           WHERE satis_id={$_POST['satis_id']}");
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
          header("Location:dashboard-manage-item?durum=kayitbasarili");


        } else {
         header("Location:dashboard-manage-item?durum=basarisiz");
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
                                                
                                                <option <?php if($satiscek1['satis_kategori']=="instagram"){echo 'selected=""';} ?> value="instagram">İnstagram</option>
                                                <option <?php if($satiscek1['satis_kategori']=="facebook"){echo 'selected=""';} ?> value="facebook">Facebook</option>
                                                <option <?php if($satiscek1['satis_kategori']=="youtube"){echo 'selected=""';} ?> value="youtube">Youtube</option>
                                                <option  <?php if($satiscek1['satis_kategori']=="tiktok"){echo 'selected=""';} ?> value="tiktok">Tiktok</option>
                                                <option <?php if($satiscek1['satis_kategori']=="Twitter"){echo 'selected=""';} ?>  value="twitter">Twitter</option>
                                                <option <?php if($satiscek1['satis_kategori']=="snapchat"){echo 'selected=""';} ?> value="snapchat">Snapchat</option>
                                            </select>
                                            <span class="lnr lnr-chevron-down"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_name">Ürün Adı
                                        </label>
                                        <input type="text" id="product_name" class="text_field" name="satis_baslik" value="<?php echo $satiscek1['satis_baslik']; ?>" placeholder="Ürün Adını Giriniz...">
                                    </div>

                                    <div class="form-group no-margin">
                                        <p class="label">Ürün Açıklaması</p>
                                        <textarea name="satis_aciklama"><?php echo $satiscek1['satis_aciklama']; ?></textarea>
                               
                                    </div>
                                    <input type="hidden" name="satis_id" value="<?php echo $satiscek1['satis_id']; ?>">
                                   
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
                                                   
                                                    <input type="text" id="exlicense" name="satis_fiyat" class="text_field" placeholder="00" value="<?php echo $satiscek1['satis_fiyat']; ?>">

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
                            <button type="submit" name="urunguncelle" class="btn btn--round btn--fullwidth btn--lg">Güncelle</button>
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