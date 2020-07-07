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
                                <a href="#">Kredi Ekle</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Kredi Ekle</h1>
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
                            <li class="active">
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
                            <div class="dashboard__title">
                                <h3>Kredi Satın Al</h3>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->

                <form action="#" name="add_credit_form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="credit_modules">
                                <div class="modules__title">
                                    <h3>Kredi Miktarı</h3>
                                </div>

                                <div class="modules__content">
                                    <p class="subtitle">Miktar Seçin</p>
                                    <div class="amounts">
                                        <ul>
                                            <li data-price="10">
                                                <p>10</p>
                                            </li>
                                            <li data-price="20">
                                                <p>20</p>
                                            </li>
                                            <li data-price="50">
                                                <p>30</p>
                                            </li>
                                            <li data-price="100">
                                                <p>100</p>
                                            </li>
                                            <li data-price="500">
                                                <p>500</p>
                                            </li>
                                        </ul>
                                        <input type="hidden" class="selected_price">
                                    </div>
                                 
                                </div>
                               
                            </div>
                            <!-- end /.credit_modules -->
                        </div>
                        <!-- end /.col-md-12 -->
                    </div>
                                </div>
                             
                            </div>
                            <!-- end /.col-md-6 -->
                        </div>
                        <!-- end /.row -->
                    </div>
                    <!-- end /.credit_modules -->
                </form>
                <!-- end /.add_credit_form -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.dashboard_menu_area -->
    </section>
    <!--================================
            END DASHBOARD AREA
    =================================-->
<?php include 'header.php'; ?>

    <!--//////////////////// JS GOES HERE ////////////////-->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0C5etf1GVmL_ldVAichWwFFVcDfa1y_c"></script>
    <!-- inject:js -->
    <script src="js/plugins.min.js"></script>
    <script src="js/script.min.js"></script>
    <!-- endinject -->
</body>



</html>