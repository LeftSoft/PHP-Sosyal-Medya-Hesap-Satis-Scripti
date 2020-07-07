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
                            <li class="active">
                                <a href="dashboard.php">Gösterge Paneli</a>
                            </li>
                          
                        </ul>
                    </div>
                    <h1 class="page-title">Satıcı Gösterge Baneli</h1>
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
                           <li class="active">
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
        <!-- end /.dashboard_menu_area :) -->
<?php 
$k_id=$kullanicicek['k_id'];
$satistoplam=$db->prepare("SELECT SUM(satis_fiyat) FROM satis where satis_durum=1 and k_id={$k_id}");
        $satistoplam->execute();
        $satistop = $satistoplam->fetchColumn();
        $satintoplam=$db->prepare("SELECT SUM(satis_fiyat) FROM satis where satis_durum=1 and k_satinalan={$k_id}");
        $satintoplam->execute();
        $satintop = $satintoplam->fetchColumn();
 ?>
        <div class="dashboard_contents dashboard_statement_area">
            <div class="container">
                
                <!-- end /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="statement_info_card">
                            <div class="info_wrap">
                                <span class="lnr lnr-tag icon mcolorbg1"></span>
                                <div class="info">
                                    <p><?php 
                                    if ($satistop==null) {
                                        echo "0";
                                    }
                                    else{
                                        echo $satistop; 
                                    }
                                    

                                    ?>₺</p>
                                    <span>Toplam Satış</span>
                                </div>
                            </div>
                            <!-- end /.info_wrap -->
                        </div>
                        <!-- end /.statement_info_card -->
                    </div>
                    <!-- end /.col-md-3 -->

                    <div class="col-lg-3 col-md-3">
                        <div class="statement_info_card">
                            <div class="info_wrap">
                                <span class="lnr lnr-cart icon mcolorbg2"></span>
                                <div class="info">
                                    <p><?php 
                                    if ($satintop==null) {
                                        echo "0";
                                    }
                                    else{
                                        echo $satintop; 
                                    }
                                    

                                    ?>₺</p>
                                    <span>Toplam Alış</span>
                                </div>
                            </div>
                            <!-- end /.info_wrap -->
                        </div>
                        <!-- end /.statement_info_card -->
                    </div>
                   
                </div>
                <!-- end /.row -->
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="dashboard__title">
                                <h3>Satılan Hesaplar</h3>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="statement_table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tarih</th>
                                        <th>Satış ID</th>
                                        <th>Satın Alan</th>
                                        <th>Detay</th>
                                        <th>Durum</th>
                                        <th>Fiyat</th>
                                    </tr>
                                </thead>

                                <?php 
                    $sayfada = 9; // sayfada gösterilecek içerik miktarını belirtiyoruz.
                     $sorgu=$db->prepare("SELECT * FROM satis where satis_durum=1 and k_id={$k_id}");
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

        $satissor=$db->prepare("SELECT * FROM satis where satis_durum=1 and k_id={$k_id} order by satis_id DESC limit $limit,$sayfada");
        $satissor->execute();

        while($satiscek=$satissor->fetch(PDO::FETCH_ASSOC)) {

         ?>


                                <tbody>
                                    <tr>
                                        <td><?php echo $satiscek['k_tarih']; ?></td>
                                        <td><?php echo $satiscek['satis_id']; ?></td>
                                        <td class="author"><?php echo $satiscek['k_satinalani']; ?></td>
                                        <td class="detail">
                                            <a href="satis/<?=seo($satiscek["satis_baslik"]).'/'.$satiscek["satis_id"]?>"><?php echo $satiscek['satis_baslik']; ?></a>
                                        </td>
                                        <td class="type">
                                            <span class="sale">Satın Aldı</span>
                                        </td>
                                        <td><?php echo $satiscek['satis_fiyat']; ?>₺</td>
                                    </tr>
                                </tbody>

<?php } ?>



                            </table>

                            <div class="pagination-area pagination-area2">
                                <nav class="navigation pagination " role="navigation">
                                    <div class="nav-links">
                                       
                                       <?php

                                      $s=0;

                                      while ($s < $toplam_sayfa) {

                                       $s++; ?>
                                       <?php 

                                       if ($s==$sayfa) {?>
                                
                                <a class="page-numbers current" href="dashboard?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>
                            <?php } else {?> 
                                <a class="page-numbers" href="dashboard?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>
                               <?php   }

                          }

                          ?>
                                        
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
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