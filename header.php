<?php 
ob_start();
session_start();
include 'ayar/baglan.php'; 
include 'ayar/fonksiyon.php';
$kullanicisor=$db->prepare("SELECT * FROM kullanici where k_kadi=:kadi");
$kullanicisor->execute(array(
  'kadi' => $_SESSION['kullanici_adi']
  ));
$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
$bildirim = $kullanicicek['k_id'];
$say=$kullanicisor->rowCount();
date_default_timezone_set('Europe/Istanbul');
function userinfo($id)
{

    global $db;
    return $db->query("select * from kullanici where k_id='".$id."'")->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
<base href="http://softwaredemo.tr.ht/">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
<style type="text/css">
    .satis
{
width:150px;
height:120px;
}
</style>
    
    

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MartPlace - Complete Online Multipurpose Marketplace HTML Template">
    <meta name="keywords" content="marketplace, easy digital download, digital product, digital, html5">


    <title>Martplace - Home</title>

    <!-- inject:css -->
    <link rel="stylesheet" href="css/plugins.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- endinject -->

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.php">
</head>

<body class="preload dashboard-edit">

    <!-- ================================
    START MENU AREA
================================= -->
    <!-- start menu-area -->
    <div class="menu-area">
        <!-- start .top-menu-area -->
        <div class="top-menu-area">
            <!-- start .container -->
            <div class="container">
                <!-- start .row -->
                <div class="row">
                    <!-- start .col-md-3 -->
                    <div class="col-lg-3 col-md-3 col-6 v_middle">
                        <div class="logo">
                            <a href="index.php">
                                <img src="images/logo.png" alt="logo image" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <!-- end /.col-md-3 -->

                    <!-- start .col-md-5 -->
                    <div class="col-lg-8 offset-lg-1 col-md-9 col-6 v_middle">
                        <!-- start .author-area -->
                        <div class="author-area">
                             
                            


                           <?php if($say==1){ ?>
                          
                            <div class="author__notification_area" >
                                <ul>
                                    
                                   <?php 
                                   $sendId = $kullanicicek["k_id"];
                                   
?>
                                    <li class="has_dropdown">
                                        <a href="messages">
                                        <div class="icon_wrap">
                                            <span class="lnr lnr-envelope"></span>
                                          
                                        </div>
                                        </a>
                                        <div class="dropdowns messaging--dropdown">
                                            <div class="dropdown_module_header">
                                                <h4>Mesajlarım</h4>
                                                <a href="messages">Hepsini Gör</a>
                                            </div>
                                                <?php
                                               $list = $db->query("select * from messages where userid='".$sendId."' or sendid='".$sendId."' order by updateTime desc limit 0,4")->fetchAll(PDO::FETCH_ASSOC);
                        foreach($list as $key => $value)
                        {
                            if($value['userid'] == $sendId){ $useId = $value['sendid']; } else {$useId = $value['userid']; }
                            $userinfo = userinfo($useId);
                            $sonmesaj = $db->query("select * from messages_sub where messagesid='".$value['messagesid']."' order by id desc limit 0,01")->fetch(PDO::FETCH_ASSOC);

                                                    ?>
                                            <div class="messages">
                                                <a href="message?k_id=<?php echo $useId; ?>" class="message recent">
                                                    <div class="message__actions_avatar">
                                                        <div class="avatar">
                                                            <img src="images/usr_avatar.png" alt="">
                                                        </div>
                                                    </div>
                                                    <!-- end /.actions -->

                                                    <div class="message_data">
                                                        <div class="name_time">
                                                            <div class="name">
                                                                <p><?php echo $userinfo['k_isim']; ?></p>
                                                       
                                                            </div>

                                                            <span class="time"></span>
                                                            
                                                            <p><?php
                                                             $detay = $sonmesaj['text'];
                                                                $uzunluk = strlen($detay);
                                                              $limit = 30;
                                                              if($uzunluk > $limit)
                                                              {
                                                                $detay = substr($detay,0,$limit)."...";
                                                              }
                                                              $userbilgi = userinfo($sonmesaj['userid']);
                                                              if ($kullanicicek['k_isim']==$userbilgi['k_isim']) {
                                                                  echo "<b>"."Ben".": "."</b>".$detay;
                                                              }
                                                              else{
                                                                echo "<b>".$userbilgi['k_isim'].": "."</b>".$detay;
                                                              }
                                                               ?></p>
                                                        </div>
                                                    </div>
                                                    <!-- end /.message_data -->
                                                </a>
                                                <!-- end /.message -->
                                                
                                              
                                            </div>
                                            <?php } ?>

                                        </div>

                                    </li>
                                    
                                </ul>
                            </div>
                            <!--start .author__notification_area -->
 
<?php } ?>

                            <?php if($say==1){ ?>

                            <!--start .author-author__info-->
                            <div class="author-author__info inline has_dropdown">
                                <div class="author__avatar">
                                    <img src="images/usr_avatar.png" alt="user avatar">

                                </div>
                                <div class="autor__info">
                                    <p class="name">
                                     <?php echo $kullanicicek['k_isim']; ?>  
                                    </p>
                                    <p class="ammount"> <?php echo $kullanicicek['k_bakiye']; ?>₺</p>
                                </div>

                                <div class="dropdowns dropdown--author">
                                    <ul>
                                        
                                        <li>
                                            <a href="dashboard.php">
                                                <span class="lnr lnr-home"></span> Panel</a>
                                        </li>
                                        <li>
                                            <a href="dashboard-setting.php">
                                                <span class="lnr lnr-cog"></span> Ayarlar</a>
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
                                                <span class="lnr lnr-book"></span>Satışları Yönet</a>
                                        </li>
                                        <li>
                                            <a href="dashboard-withdrawal.php">
                                                <span class="lnr lnr-briefcase"></span>Para Çek</a>
                                        </li>
                                        <li>
                                            <a href="support.php">
                                                <span class="lnr lnr-inbox"></span>Destek Talebi</a>
                                        </li>
                                        <li>
                                            <a href="logout.php">
                                                <span class="lnr lnr-exit"></span>Çıkış Yap</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--end /.author-author__info-->
<?php } ?>

<div class="author-author__info inline has_dropdown">
 <div class="author__avatar">
    <?php 
                                if($say==0){


                                ?>

                               
                                 <a href="login.php" class="author-area__seller-btn inline">Giriş Yap</a>
                            <a href="signup.php" class="author-area__seller-btn inline">Kayıt Ol</a>
                           

                            <?php } ?>
                                    <img src="images/usr_avatar.png" alt="user avatar" hidden>

                                </div>
</div>

                        </div>
                        <!-- end .author-area -->
                         <?php 

                             if($say==1){

                             ?>
                        <!-- author area restructured for mobile -->
                        <div class="mobile_content ">
                            <span class="lnr lnr-user menu_icon"></span>

                            <!-- offcanvas menu -->
                            <div class="offcanvas-menu closed">
                                <span class="lnr lnr-cross close_menu"></span>
                                <div class="author-author__info">
                                    <div class="author__avatar v_middle">
                                        <img src="images/usr_avatar.png" alt="user avatar">
                                    </div>
                                    <div class="autor__info v_middle">
                                        <p class="name">
                                           <?php echo $kullanicicek['k_isim']; ?>  
                                        </p>
                                        <p class="ammount"><?php echo $kullanicicek['k_bakiye']; ?>₺  </p>
                                    </div>
                                </div>
                                <!--end /.author-author__info-->

                                <div class="author__notification_area">
                                    <ul>
                                        <li>
                                            <a href="messages">
                                                <div class="icon_wrap">
                                                    <span class="lnr lnr-envelope"></span>
                                                    
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!--start .author__notification_area -->

                                <div class="dropdowns dropdown--author">
                                    <ul>
                                        <li>
                                            <a href="dashboard.php">
                                                <span class="lnr lnr-home"></span> Panel</a>
                                        </li>
                                        <li>
                                            <a href="dashboard-setting.php">
                                                <span class="lnr lnr-cog"></span> Ayarlar</a>
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
                                                <span class="lnr lnr-book"></span>Satışları Yönet</a>
                                        </li>
                                        <li>
                                            <a href="dashboard-withdrawal.php">
                                                <span class="lnr lnr-briefcase"></span>Para Çek</a>
                                        </li>
                                        <li>
                                            <a href="logout.php">
                                                <span class="lnr lnr-exit"></span>Çıkış Yap</a>
                                        </li>
                                    </ul>
                                </div>

                                

                            </div>
                        </div>
                        <!-- end /.mobile_content -->
                        <?php } ?>
                    

    <?php 
                                if($say==0){


                                ?>
<div class="mobile_content ">
                            <span class="lnr lnr-user menu_icon"></span>

                            <!-- offcanvas menu -->
                            <div class="offcanvas-menu closed">
                                <span class="lnr lnr-cross close_menu"></span>
                                <div class="author-author__info">
                                    <div class="author__avatar v_middle">
                                        <img src="images/usr_avatar.png" alt="user avatar">
                                    </div>
                                    <br>
                                    <div class="autor__info v_middle">
                                       <a href="login.php" class="author-area__seller-btn inline">Giriş Yap</a>
                            <a href="signup.php" class="author-area__seller-btn inline">Kayıt Ol</a>
                                    </div>
                                </div>
                              

                            </div>
                        </div>

                                 
                           

                            <?php } ?>
                                   </div>




                    <!-- end /.col-md-5 -->
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end  -->

        <!-- start .mainmenu_area -->
        <div class="mainmenu">
            <!-- start .container -->
            <div class="container">
                <!-- start .row-->
                <div class="row">
                    <!-- start .col-md-12 -->
                    <div class="col-md-12">
                        <div class="navbar-header">
                            <!-- start mainmenu__search -->

                            


                            <!-- start mainmenu__search -->
                        </div>

                        <nav class="navbar navbar-expand-md navbar-light mainmenu__menu">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li>
                                        <a href="index.php">Anasayfa</a>
                                        
                                    </li>
                                    <li>
                                        <a href="all-products.php">Tüm Satışlar</a>
                                        
                                    </li>
                                    
                                    
                                    
                                    <li>
                                        <a href="contact.php">İletişim</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                        </nav>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row-->
            </div>
            <!-- start .container -->
        </div>
        <!-- end /.mainmenu-->
    </div>