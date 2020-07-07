<?php 
include 'header.php'; 

if ($say==0) {

  Header("Location:index");
  exit;

}
$kullanicisorr=$db->prepare("SELECT * FROM kullanici where k_id=:k_id");
$kullanicisorr->execute(array(
  'k_id' => $_GET['k_id']
  ));
$kullanicicekk=$kullanicisorr->fetch(PDO::FETCH_ASSOC);

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
                                <a href="#">Mesajlar</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Mesaj Kutusu</h1>
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
            START MESSAGE AREA
    =================================-->
    
    <section class="message_area">
        <div class="container">
        	
            <div class="row">
                <div class="col-md-12">
                    <div class="content_title">
                        <h3>Mesajlar</h3>
                    </div>
                    <!-- end /.content_title -->
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="cardify messaging_sidebar">
                        <div class="messaging__header">
                            
                            <!-- end /.messaging_menu -->

                           
                            <!-- end /.messaging_action -->
                        </div>
                        <!-- end /.messaging__header -->
<?php       
                        
                        $sendId = $kullanicicek["k_id"];
                        $row = $db->query("select * from messages where userid='".$sendId."' or sendid='".$sendId."'")->rowcount();
                        if($row == 0)
                        {
                            echo '<div class="messaging__header" align="center"><p>Mesaj Kutunuz Boş</p></div>';
                        }
                        else
                        {
                        $list = $db->query("select * from messages where userid='".$sendId."' or sendid='".$sendId."' order by updateTime desc")->fetchAll(PDO::FETCH_ASSOC);
                        foreach($list as $key => $value)
                        {
                            if($value['userid'] == $sendId){ $useId = $value['sendid']; } else {$useId = $value['userid']; }
                            $userinfo = userinfo($useId);
                            $sonmesaj = $db->query("select * from messages_sub where messagesid='".$value['messagesid']."' order by id desc limit 0,01")->fetch(PDO::FETCH_ASSOC);
                        
                    ?>
                        
                        <div class="messaging__contents">
                           
                            
                             <a href="message?k_id=<?php echo $useId; ?>">
                            <div class="messages">
                                <div class="message ">
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

                                            <span class="time"><?php echo $sonmesaj['date']; ?></span>
                                            <p><b><?php 
                                            $userbilgi =  userinfo($sonmesaj['userid']);
                                            if ($kullanicicek['k_isim']==$userbilgi['k_isim']) {
                                                echo "Ben";
                                               }
                                              else{
                                              echo $userbilgi['k_isim'];
                                                 }
                                              ?>: </b><?php echo $sonmesaj['text']; 
                                            ?></p>
                                        </div>
                                    </div>
                                    <!-- end /.message_data -->
                                </div>
                                <!-- end /.message -->
                           
                                
                                <!-- end /.message -->
                            </div>
                            </a>

                            <!-- end /.messages -->
                        </div>
<?php } }?>

                        <!-- end /.messaging__contents -->
                    </div>
                    <!-- end /.cardify -->
                </div>
         

            </div>
            <!-- end /.row -->
        </div>
    </section>
    <!--================================
            END MESSAGE AREA
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