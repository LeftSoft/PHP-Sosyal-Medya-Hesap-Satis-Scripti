<?php 
include 'header.php'; 


if ($say==1) {

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
                            <li class="active">
                                <a href="#">Kayıt Ol</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Kayıt Ol</h1>
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
            START SIGNUP AREA
    =================================-->
    <section class="signup_area section--padding2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                   
                        <?php 

                if ($_GET['durum']=="farklisifre") {?>

               <div class="alert alert-danger" role="alert">
                                <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Hata!</strong> Girdiğiniz şifreler eşleşmiyor.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                    
                <?php } elseif ($_GET['durum']=="eksiksifre") {?>

               <div class="alert alert-danger" role="alert">
                                <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Hata!</strong> Şifreniz minimum 6 karakter uzunluğunda olmalıdır.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                    
                <?php } elseif ($_GET['durum']=="mukerrerkayit") {?>

               <div class="alert alert-danger" role="alert">
                                <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Hata!</strong> Bu kullanıcı daha önce kayıt edilmiş.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                    
                <?php } elseif ($_GET['durum']=="basarisiz") {?>

                <div class="alert alert-danger" role="alert">
                                <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Hata!</strong> Kayıt Yapılamadı Sistem Yöneticisine Danışınız.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                    
                <?php }
                 ?>
                 <form action="ayar/islem.php" method="POST">
                        <div class="cardify signup_form">
                            <div class="login--header">
                                <h3>Hesabını oluştur</h3>
                                <p>Yeni bir hesap açmak için lütfen aşağıdaki alanları uygun bilgilerle doldurun.
                                </p>
                            </div>
                            <!-- end .login_header -->
                            
                            <div class="login--form">

                                <div class="form-group">
                                    <label for="urname">İsim</label>
                                    <input id="urname" type="text" class="text_field" name="k_isim" placeholder="İsminizi Girin">
                                </div>

                                <div class="form-group">
                                    <label for="email_ad">E-Posta</label>
                                    <input id="email_ad" type="text" class="text_field" name="k_mail" placeholder="E-Posta Adresinizi Girin">
                                </div>

                                <div class="form-group">
                                    <label for="user_name">Kullanıcı Adı</label>
                                    <input id="user_name" type="text" class="text_field" name="k_kadi" placeholder="Kullanıcı Adınızı Girin...">
                                </div>

                                <div class="form-group">
                                    <label for="password">Şifre</label>
                                    <input id="password" type="password" class="text_field" name="k_sifre" placeholder="Şifrenizi Girin...">
                                </div>

                                <div class="form-group">
                                    <label for="con_pass">Şifre Tekrar</label>
                                    <input id="con_pass" type="password" class="text_field" name="k_sifre2" placeholder="Tekrar Şifre Girin">
                                </div>

                                <button class="btn btn--md btn--round register_btn" name="kullanicikaydet" type="submit">Kayıt Ol</button>

                                <div class="login_assist">
                                    <p>Hesabınız zaten var mı?
                                        <a href="signup.php">Giriş Yap</a>
                                    </p>
                                </div>

                
                            </div>

                            <!-- end .login--form -->
                        </div>
                        <!-- end .cardify -->
                    </form>
                </div>
                <!-- end .col-md-6 -->
            </div>
            <!-- end .row -->
        </div>
        <!-- end .container -->
    </section>
    <!--================================
            END SIGNUP AREA
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