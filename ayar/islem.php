<?php 
ob_start();
session_start();
include 'baglan.php';
function islemkontrol () {

    if (empty($_SESSION['kullanici_adi'])) {
        
        Header("Location:../index");
        exit;
    }
}
if (isset($_POST['kullanicikaydet'])) {

  
   $kullanici_isim=htmlspecialchars($_POST['k_isim']);
   $kullanici_mail=htmlspecialchars($_POST['k_mail']); 
   $kullanici_adi=htmlspecialchars($_POST['k_kadi']); 
   $kullanici_passwordone=trim($_POST['k_sifre']); 
   $kullanici_passwordtwo=trim($_POST['k_sifre2']); 

  if ($kullanici_passwordone==$kullanici_passwordtwo) {

    if (strlen($kullanici_passwordone)>=6) {

// Başlangıç

      $kullanicisor=$db->prepare("select * from kullanici where k_kadi=:kadi or k_mail=:k_mail");
      $kullanicisor->execute(array(
        'kadi' => $kullanici_adi,
        'k_mail' => $kullanici_mail
      ));
      //dönen satır sayısını belirtir
      $say=$kullanicisor->rowCount();

      if ($say==0) {

        //md5 fonksiyonu şifreyi md5 şifreli hale getirir.
        $password=md5($kullanici_passwordone);

      //Kullanıcı kayıt işlemi yapılıyor...
        $kullanicikaydet=$db->prepare("INSERT INTO kullanici SET
          k_isim=:k_isim,
          k_mail=:k_mail,
          k_kadi=:k_kadi,
          k_sifre=:k_sifre
          ");
        $insert=$kullanicikaydet->execute(array(
          'k_isim' => $kullanici_isim,
          'k_mail' => $kullanici_mail,
          'k_kadi' => $kullanici_adi,
          'k_sifre' => $password
        ));
        if ($insert) {
          header("Location:../login.php?durum=kayitbasarili");

        //Header("Location:../production/genel-ayarlar.php?durum=ok");
        } else {
          header("Location:../login.php?durum=basarisiz");
        }

      } else {

        header("Location:../signup.php?durum=mukerrerkayit");

      }

    // Bitiş


    } else {
      header("Location:../signup.php?durum=eksiksifre");
    }
  } else {
    header("Location:../signup.php?durum=farklisifre");
  }
}
if (isset($_POST['girisyap'])) {

  $kullanici_adi=$_POST['k_adi'];
  $kullanici_password=md5($_POST['k_sifre']);
  $kullanicisor=$db->prepare("SELECT * FROM kullanici where k_kadi=:kadi and k_sifre=:sifre");
  $kullanicisor->execute(array(
    'kadi' => $kullanici_adi,
    'sifre' => $kullanici_password
    ));

  echo $say=$kullanicisor->rowCount();

  if ($say==1) {

    $_SESSION['kullanici_adi']=$kullanici_adi;

    header("Location:../index.php");
    exit;



  } else {

    header("Location:../login.php?durum=no");
    exit;
  }
  

}
if ($_GET['satissil']=="ok") {
islemkontrol();
  $sil=$db->prepare("DELETE from satis where satis_id=:satis_id");
  $kontrol=$sil->execute(array(
    'satis_id' => $_GET['satis_id']
    ));

  if ($kontrol) {

    Header("Location:../dashboard-manage-item?durum=ok");

  } else {

    Header("Location:../dashboard-manage-item?durum=no");
  }

}
 ?>