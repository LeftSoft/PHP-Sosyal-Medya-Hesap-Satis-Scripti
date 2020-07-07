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
        	<?php 
         	 $sendId = $kullanicicek["k_id"];
        	$userId = $_GET['k_id'];
        	$userinfo = userinfo($userId);

        	if($_POST)
        	{
        		 $text = strip_tags($_POST['text']);
        		if ($text!="") 
        		{
        			
        			 $c = $db->query("select * from messages where userid='".$userId."' and sendid='".$sendId."' or userid='".$sendId."' and sendid='".$userId."'")->rowcount();
        			if ($c==0) 
        			{
        			 $insert = $db->query("insert into messages(userid,sendid) values('$userId','$sendId')");
        			 $last_id = $db->lastInsertId();
        			 $icerikinsert = $db->query("insert into messages_sub(messagesid,text,date,userid) values('$last_id','$text','".date('d.m.Y H:i')."','".$sendId."')");
        			 if($icerikinsert)
        			 {
        			 	$db->query("update messages set updateTime='".time()."' where messagesid='".$last_id."'");
        			 	echo '<div class="alert alert-success" role="alert">
                                  <span class="alert_icon lnr lnr-checkmark-circle"></span>
                                <strong>Başarılı!</strong> Mesaj Oluşturuldu!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>';
        			 }
        			 else
        			 {
        			 	echo '<div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Başarısız!</strong> Mesaj oluşturulamadı!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>';
        			 }
        			}
        			else
        			{
        				$w = $db->query("select * from messages where userid='".$userId."' and sendid='".$sendId."' or userid='".$sendId."' and sendid='".$userId."'")->fetch();
        				$icerikinsert = $db->query("insert into messages_sub(messagesid,text,date,userid) values('".$w['messagesid']."','$text','".date('d.m.Y H:i')."','".$sendId."')");
        				if ($icerikinsert) {
        					$db->query("update messages set updateTime='".time()."' where messagesid='".$w['messagesid']."'");
        					echo '<div class="alert alert-success" role="alert">
                                  <span class="alert_icon lnr lnr-checkmark-circle"></span>
                                <strong>Başarılı!</strong> Mesaj Gönderildi!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>';
        				}
        				else{
        					echo '<div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Hata!</strong> Bir şeyler eksik gitti.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>';
        				}
        			}
        		}
        		else
        		{
        			echo '<div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Hata!</strong> Mesaj boş bırakılamaz!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div>';
        		}
        	}

        	 ?>
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
                    <div class="chat_area cardify">
                        <div class="chat_area--title" align="center">
                            <h3><span class="name"><?php echo $kullanicicekk['k_isim'];?></span> ile Mesajlaşıyorsun
                                
                            </h3>
                            
                        </div>
                        <!-- end /.chat_area--title -->









                        <?php 
                               $w = $db->query("select * from messages where userid='".$userId."' and sendid='".$sendId."' or userid='".$sendId."' and sendid='".$userId."'")->fetch(PDO::FETCH_ASSOC);
                               $all = $db->query("select * from messages_sub where messagesid='".$w['messagesid']."'order by id")->fetchAll(PDO::FETCH_ASSOC);
                               foreach($all as $key => $value)
                               {
                               	$userinfo = userinfo($value['userid']);

                             ?>
                        <div class="chat_area--conversation" >
                            <div class="conversation">
                                <div class="head">
                                    <div class="chat_avatar">
                                        <img src="images/usr_avatar.png" alt="Notification avatar">
                                    </div>

                                    <div class="name_time">
                                        <div>
                                            <h4>
                                            	<?php 
                                            	if ($kullanicicek['k_isim']==$userinfo['k_isim']) {
                                            		echo "Ben";
                                            	}
                                            	else
                                            	{
                                            		echo $userinfo['k_isim']; 
                                            	}

                                            	?>
                                            		
                                            	</h4>
                                            <p><?php  echo $value['date']; ?></p>
                                        </div>
                                        <span class="email"><?php echo $userinfo['k_mail']; ?></span>
                                    </div>
                                    <!-- end /.name_time -->
                                </div>
                                <!-- end /.head -->

                                <div class="body">
                                    <p><?php  echo $value['text']?></p>
                                </div>
                                <!-- end /.body -->

                            </div>
                            <!-- end /.conversation -->

                           


                        </div>
                         <?php } ?>
                        <!-- end /.chat_area--conversation -->
                        <?php 
                        	if($kullanicicekk['k_id'] != "")
                        	{
                        	 ?>
                        <form action="" method="POST">

                        <div class="message_composer">
                            <textarea name="text"></textarea>
                            <!-- end /.trumbowyg-demo -->

                            <div class="attached"></div>

                            <div class="btns">
                                <button class="btn send btn--sm btn--round">Cevap Ver</button>
                               
                            </div>
                            <!-- end /.message_composer -->
                        </div>
                        </form>
                    <?php } else{?><div class="alert alert-danger" role="alert">
                                  <span class="alert_icon lnr lnr-warning"></span>
                                <strong>Hata!</strong> Böyle bir kullanıcı bulunamadı!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="lnr lnr-cross" aria-hidden="true"></span>
                                </button>
                            </div><?php } ?>
                        <!-- end /.message_composer -->
                    </div>
                    <!-- end /.chat_area -->
                </div>
                <!-- end /.col-md-7 -->
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