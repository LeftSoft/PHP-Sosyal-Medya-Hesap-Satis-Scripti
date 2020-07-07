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
                                <a href="index.html">Anasayfa</a>
                            </li>
                            <li>
                                <a href="dashboard.html">Panel</a>
                            </li>
                            <li class="active">
                                <a href="#">Ayarlar</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Satıcı Kontrol Paneli</h1>
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
                            
                            <li class="active">
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
                     <?php 

                if ($_GET['durum']=="kayitbasarili") {?>
                            <div class="alert alert-success" role="alert">
                                  <span class="alert_icon lnr lnr-checkmark-circle"></span>
                                <strong>Başarılı!</strong> Şifre değiştirme işlemi başarıyla gerçekleşti!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                    
                <?php } else if($_GET['durum']=="basarisiz"){?>
 <div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Başarısız!</strong> Bir şeyler eksik gitti :(
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>

                <?php }  else if($_GET['durum']=="eksiksifre"){?>
<div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Başarısız!</strong> Şifreniz minimum 6 karakter uzunluğunda olmalıdır.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>

                    <?php } else if($_GET['durum']=="farklisifre"){?>
<div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Başarısız!</strong> Girdiğiniz şifreler eşleşmiyor.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                    <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="dashboard__title">
                                <h3>Hesap Ayarları</h3>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
<?php 
$k_id=$kullanicicek['k_id'];
if (isset($_POST['hesapkaydet'])) {

    $kullanici_isim=htmlspecialchars($_POST['k_isim']);
   $kullanici_mail=htmlspecialchars($_POST['k_mail']); 
   $kullanici_passwordone=trim($_POST['k_sifre']); 
   $kullanici_passwordtwo=trim($_POST['k_sifre2']); 

if ($kullanici_passwordone==$kullanici_passwordtwo) {

    if (strlen($kullanici_passwordone)>=6) {


        $password=md5($kullanici_passwordone);


        $kullanicikaydet=$db->prepare("UPDATE kullanici SET
          k_sifre=:k_sifre
          WHERE k_id={$k_id}");
        $insert=$kullanicikaydet->execute(array(
          'k_sifre' => $password
        ));
        if ($insert) {
          header("Location:?durum=kayitbasarili");

        } else {
          header("Location:?durum=basarisiz");
        }

    } else {
      header("Location:?durum=eksiksifre");
    }
  } else {
    header("Location:?durum=farklisifre");
  }

}



 ?>
                <form action="" method="POST" class="setting_form">
                    <div class="row">
                   
                        <div class="col-lg-12">
                            <div class="information_module" align="center">
                                <a class="toggle_title" href="#collapse2" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                    <h4>Kişisel Bilgiler
                                        <span class="lnr lnr-chevron-down"></span>
                                    </h4>
                                </a>

                                <div class="information__set toggle_module collapse show" id="collapse2">
                                    <div class="information_wrapper form--fields">
                                        <div class="form-group">
                                            <label for="acname">Hesap Adı
                                            </label>
                                            <input type="text" id="acname" required class="text_field" disabled name="k_isim" placeholder="Hesap Adı" value="<?php echo $kullanicicek['k_isim'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="usrname">Kullanıcı Adı
                                            </label>
                                            <input disabled="" type="text" id="usrname" class="text_field" placeholder="Kullanıcı Adı" value="<?php echo $kullanicicek['k_kadi'] ?>">
                                           
                                        </div>

                                        <div class="form-group">
                                            <label for="emailad">Email Adresiniz
                                            </label>
                                            <input type="text" id="emailad" required class="text_field" disabled name="k_mail" placeholder="E-Posta" value="<?php echo $kullanicicek['k_mail'] ?>">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password">Şifre
                                                        <sup>*</sup>
                                                    </label>
                                                    <input type="password" required id="password" name="k_sifre" class="text_field" placeholder="Şifre">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="conpassword">Parolayı Onayla
                                                        <sup>*</sup>
                                                    </label>
                                                    <input type="password" required id="conpassword" name="k_sifre2" class="text_field" placeholder="Şifre Tekrar">
                                                </div>
                                            </div>
                                        </div>

                                       
                                       
                                    </div>
                                    <!-- end /.information_wrapper -->
                                </div>
                                <!-- end /.information__set -->
                            </div>
                       
                        </div>
                        <!-- end /.col-md-6 -->

                        <!-- end /.col-md-6 -->

                        <div class="col-md-12">
                            <div class="dashboard_setting_btn">
                                <button type="submit" name="hesapkaydet" class="btn btn--round btn--md">Değişiklikleri Kaydet</button>
                            </div>
                        </div>
                        <!-- end /.col-md-12 -->
                    </div>
                    <!-- end /.row -->
                </form>
                <!-- end /form -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.dashboard_menu_area -->
    </section>
    <!--================================
            END DASHBOARD AREA
    =================================-->

    <!--================================
        START FOOTER AREA
    =================================-->
    <footer class="footer-area">
        <div class="footer-big section--padding">
            <!-- start .container -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="info-footer">
                            <div class="info__logo">
                                <img src="images/flogo.png" alt="footer logo">
                            </div>
                            <p class="info--text">Nunc placerat mi id nisi interdum they mollis. Praesent pharetra, justo ut scel erisque the mattis,
                                leo quam.</p>
                            <ul class="info-contact">
                                <li>
                                    <span class="lnr lnr-phone info-icon"></span>
                                    <span class="info">Phone: +6789-875-2235</span>
                                </li>
                                <li>
                                    <span class="lnr lnr-envelope info-icon"></span>
                                    <span class="info">support@aazztech.com</span>
                                </li>
                                <li>
                                    <span class="lnr lnr-map-marker info-icon"></span>
                                    <span class="info">202 New Hampshire Avenue Northwest #100, New York-2573</span>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.info-footer -->
                    </div>
                    <!-- end /.col-md-3 -->

                    <div class="col-lg-5 col-md-6">
                        <div class="footer-menu">
                            <h4 class="footer-widget-title text--white">Our Company</h4>
                            <ul>
                                <li>
                                    <a href="#">How to Join Us</a>
                                </li>
                                <li>
                                    <a href="#">How It Work</a>
                                </li>
                                <li>
                                    <a href="#">Buying and Selling</a>
                                </li>
                                <li>
                                    <a href="#">Testimonials</a>
                                </li>
                                <li>
                                    <a href="#">Copyright Notice</a>
                                </li>
                                <li>
                                    <a href="#">Refund Policy</a>
                                </li>
                                <li>
                                    <a href="#">Affiliates</a>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.footer-menu -->

                        <div class="footer-menu">
                            <h4 class="footer-widget-title text--white">Help and FAQs</h4>
                            <ul>
                                <li>
                                    <a href="#">How to Join Us</a>
                                </li>
                                <li>
                                    <a href="#">How It Work</a>
                                </li>
                                <li>
                                    <a href="#">Buying and Selling</a>
                                </li>
                                <li>
                                    <a href="#">Testimonials</a>
                                </li>
                                <li>
                                    <a href="#">Copyright Notice</a>
                                </li>
                                <li>
                                    <a href="#">Refund Policy</a>
                                </li>
                                <li>
                                    <a href="#">Affiliates</a>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.footer-menu -->
                    </div>
                    <!-- end /.col-md-5 -->

                    <div class="col-lg-4 col-md-12">
                        <div class="newsletter">
                            <h4 class="footer-widget-title text--white">Newsletter</h4>
                            <p>Subscribe to get the latest news, update and offer information. Don't worry, we won't send spam!</p>
                            <div class="newsletter__form">
                                <form action="#">
                                    <div class="field-wrapper">
                                        <input class="relative-field rounded" type="text" placeholder="Enter email">
                                        <button class="btn btn--round" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>

                            <!-- start .social -->
                            <div class="social social--color--filled">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-facebook"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-twitter"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-google-plus"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-pinterest"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-linkedin"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="fa fa-dribbble"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end /.social -->
                        </div>
                        <!-- end /.newsletter -->
                    </div>
                    <!-- end /.col-md-4 -->
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.footer-big -->

        <div class="mini-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright-text">
                            <p>&copy; 2018
                                <a href="#">MartPlace</a>. All rights reserved. Created by
                                <a href="#">AazzTech</a>
                            </p>
                        </div>

                        <div class="go_top">
                            <span class="lnr lnr-chevron-up"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
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