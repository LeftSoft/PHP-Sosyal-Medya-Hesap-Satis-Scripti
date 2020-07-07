<?php include 'header.php'; 
include 'baglan.php';


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
                                <a href="#">Giriş Yap</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Giriş Yap</h1>
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
            START LOGIN AREA
    =================================-->
    
    <section class="login_area section--padding2">

        <div class="container">

            <div class="row">

                <div class="col-lg-6 offset-lg-3">
                	 <?php 

                if ($_GET['durum']=="kayitbasarili") {?>
<div class="alert alert-success" role="alert">
                                <span class="alert_icon lnr lnr-checkmark-circle"></span>
                                <strong>Kayıt Başarılı!</strong> Güvenli bir şekilde giriş yapabilirsiniz.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                

                    
                <?php }
                elseif ($_GET['durum']=="no") {?>
<div class="alert alert-danger" role="alert">
                                <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Giriş Başarısız!</strong> Lütfen Kullanıcı Adınızı veya Şifrenizi Tekrar Kontrol Ediniz.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                
                    
                <?php }
                 ?>
                    <form action="ayar/islem.php" method="POST">
                        <div class="cardify login">
                            <div class="login--header">
                                <h3>Tekrar Hoşgeldin</h3>
                                <p>Kullanıcı adınızla oturum açabilirsiniz</p>
                            </div>
                            <!-- end .login_header -->

                            <div class="login--form">
                                <div class="form-group">
                                    <label for="user_name">Kullanıcı Adı</label>
                                    <input id="user_name" type="text" class="text_field" name="k_adi" placeholder="Kullanıcı adınızı giriniz...">
                                </div>

                                <div class="form-group">
                                    <label for="pass">Şifre</label>
                                    <input id="pass" type="password" class="text_field" name="k_sifre" placeholder="Şifrenizi giriniz...">
                                </div>

                                <div class="form-group">
                                    <div class="custom_checkbox">
                                        <input type="checkbox" id="ch2" checked="">
                                        <label for="ch2">
                                            <span class="shadow_checkbox" ></span>
                                            <span class="label_text">Beni Hatırla</span>
                                        </label>
                                    </div>
                                </div>

                                <button class="btn btn--md btn--round" name="girisyap" type="submit">Giriş Yap</button>

                                <div class="login_assist">
                                    
                                    <p class="recover"><a href="signup.php">Hesabın </a>Yokmu?
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
            END LOGIN AREA
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