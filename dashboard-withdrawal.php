<?php 
include 'header.php'; 
if ($say==0) {

  Header("Location:index");
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
                                <a href="#">Para Çekme</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Para Çekme</h1>
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
                            <li class="active">
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

                if ($_GET['durum']=="basarili") {?>
                            <div class="alert alert-success" role="alert">
                                  <span class="alert_icon lnr lnr-checkmark-circle"></span>
                                <strong>Başarılı!</strong> Kredi çekme işlemin onaya gönderildi!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                    
                <?php } else if($_GET['durum']=="basarisiz"){?>

                    <div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Başarısız!</strong> Bir şeyler eksik gitti lütfen tekrar deneyiniz.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                <?php } else if($_GET['durum']=="yetersiz"){?>

                     <div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Başarısız!</strong> Mevcut kredinizden fazla çekim gerçekleştiremezsiniz.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                <?php } else if($_GET['durum']=="uzunluk"){?> 
                    <div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Başarısız!</strong> IBAN Numarasına'a 26 haneden fazla uzunluk yazamazsınız.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>

                <?php } else if($_GET['durum']=="operator"){?>

                    <div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Başarısız!</strong> Tutara sadece sayı giriniz.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>
                <?php }?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area clearfix">
                            <div class="dashboard__title pull-left">
                                <h3>Para Çekme</h3>
                            </div>

                            <div class="pull-right">
                                <a href="dashboard-add-credit.php" class="btn btn--round btn--md">Kredi Yükle</a>
                            </div>
                        </div>
                        <!-- end /.dashboard_title_area -->
                    </div>
                    <!-- end /.col-md-12 -->
                </div>

                <!-- end /.row -->
<?php 
$tarih = date("d.m.Y");
$k_id=$kullanicicek['k_id'];
$isteyen=$kullanicicek['k_isim'];
$mevcut=$kullanicicek['k_bakiye'];
$istenilen=$_POST['kredi_miktar'];
if (substr($istenilen,0,1)!="-") {
   if (strlen($_POST['kredi_iban'])<= 26) {
if (isset($_POST['kredigonder'])) {

if ($mevcut>=$istenilen) {
$top = $mevcut - $istenilen;
    $kredikaydet=$db->prepare("INSERT INTO kredionay SET
          k_id=:k_id,
          k_isteyen=:k_isteyen,
          kredi_iban=:kredi_iban,
          kredi_tarih=:kredi_tarih,
          kredi_miktar=:kredi_miktar
          ");
        $insert=$kredikaydet->execute(array(
          'k_id' => $k_id,
          'k_isteyen' => $isteyen,
          'kredi_iban' => $_POST['kredi_iban'],
          'kredi_tarih' => $tarih,
          'kredi_miktar' => $_POST['kredi_miktar'] 
        ));
        if ($insert) {
            
            $kredikaydett=$db->prepare("UPDATE kullanici SET
          k_bakiye=:k_bakiye
          WHERE k_id={$k_id}");
        $kredikaydett->execute(array(
          'k_bakiye' => $top
        ));

          header("Location:?durum=basarili");

       
        } else {
         header("Location:?durum=basarisiz");
        }
}
else{
    header("Location:?durum=yetersiz");
}
}
}

else{
    header("Location:?durum=uzunluk");
} 
}
else{
    header("Location:?durum=operator");
}


 ?>


<form action="" method="POST">
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="withdraw_module cardify">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="modules__title">
                                        <h3>Ödeme Metodu</h3>
                                    </div>

                                    <div class="modules__content">
                                        IBAN
                                        <input type="text" id="acname" class="text_field" name="kredi_iban" maxlength="26" placeholder="IBAN numarasını giriniz." required="">
                                        
                                        <!-- end /.options -->
                                    </div>
                                    <!-- end /.modules__content -->
                                </div>
                                <!-- end /.col-md-6 -->

                                <div class="col-lg-6">
                                    <div class="modules__title">
                                        <h3>Para Çekme Tutarı</h3>
                                    </div>

                                    <div class="modules__content">
                                        <p class="subtitle">Ne kadar para çekmek istersiniz?</p>
                                        <div class="options">

                                            <div class="withdraw_amount">
                                                <div class="input-group">
                                                  
                                                    <input type="number" id="rlicense" required="" name="kredi_miktar" class="text_field" placeholder="00.00">
                                                </div>
                                                <span class="fee">Para çekme başına 2TL ücret alınır.</span>
                                            </div>
                                        </div>

                                        <div class="button_wrapper">
                                          
                                            <input type="submit" name="kredigonder" class="btn btn--round btn--md" value="Para Çekmeyi Gönder">
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- end /.col-md-6 -->
                            </div>
                            <!-- end /.row -->
                        </div>
                        <!-- end /.withdraw_module -->
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
</form>




                <div class="row">
                    <div class="col-md-12">
                        <div class="withdraw_module withdraw_history">
                            <div class="withdraw_table_header">
                                <h3>Para Çekme Geçmişi</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table withdraw__table">
                                    <thead>
                                        <tr>
                                            <th>Tarih</th>
                                            <th>IBAN</th>
                                            <th>Miktar</th>
                                            <th>Durum</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                          <?php 
      
        $kredisor=$db->prepare("SELECT * FROM kredionay");
        $kredisor->execute();

        while($kredicek=$kredisor->fetch(PDO::FETCH_ASSOC)) {

         ?>
                                        <tr>
                                            <td><?php echo $kredicek['kredi_tarih']; ?></td>
                                            <td><?php echo $kredicek['kredi_iban']; ?></td>
                                            <td class="bold"><?php echo $kredicek['kredi_miktar']; ?>₺</td>
                                            <td class="<?php if($kredicek['kredi_durum']==0){echo 'pending';} else{echo "paid";}?>">
                                                <span><?php if($kredicek['kredi_durum']==0){echo 'Bekliyor';} else{echo "Ödendi";}?></span>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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

    <!-- Modals -->
    <div class="modal fade rating_modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="rating_modal">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="rating_modal">Rating this Item</h3>
                    <h4>Product Enquiry Extension</h4>
                    <p>by
                        <a href="author.php">AazzTech</a>
                    </p>
                </div>
                <!-- end /.modal-header -->

                <div class="modal-body">
                    <form action="#">
                        <ul>
                            <li>
                                <p>Your Rating</p>
                                <div class="right_content btn btn--round btn--white btn--md">
                                    <select name="rating" class="give_rating">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </li>

                            <li>
                                <p>Rating Causes</p>
                                <div class="right_content">
                                    <div class="select-wrap">
                                        <select name="review_reason" id="">
                                            <option value="design">Design Quality</option>
                                            <option value="customization">Customization</option>
                                            <option value="support">Support</option>
                                            <option value="performance">Performance</option>
                                            <option value="documentation">Well Documented</option>
                                        </select>

                                        <span class="lnr lnr-chevron-down"></span>
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <div class="rating_field">
                            <label for="rating_field">Comments</label>
                            <textarea name="rating_field" id="rating_field" class="text_field" placeholder="Please enter your rating reason to help the author"></textarea>
                            <p class="notice">Your review will be ​publicly visible​ and the author may reply to your comments. </p>
                        </div>
                        <button type="submit" class="btn btn--round btn--default">Submit Rating</button>
                        <button class="btn btn--round modal_close" data-dismiss="modal">Close</button>
                    </form>
                    <!-- end /.form -->
                </div>
                <!-- end /.modal-body -->
            </div>
        </div>
    </div>

    <!--//////////////////// JS GOES HERE ////////////////-->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0C5etf1GVmL_ldVAichWwFFVcDfa1y_c"></script>
    <!-- inject:js -->
    <script src="js/plugins.min.js"></script>
    <script src="js/script.min.js"></script>
    <!-- endinject -->
</body>

</html>