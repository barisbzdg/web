
<?php

if($_POST) {
    $eposta = trim($_POST["eposta"]);
    $sifre = trim($_POST["sifre"]);

    if(!$eposta || !$sifre) {
        echo '<div class="hata">Kullanıcı Adı ve Şifre Alanı Boş Bırakılamaz</div>';
    }else {
        $uye = $db->prepare("select * from uyeler where uye_eposta=? and uye_sifre=? and uye_onay=?");
        $uye->execute(array($eposta,$sifre,1));
        $z = $uye->fetch(PDO::FETCH_ASSOC);
        $x = $uye->rowCount();

        if($x) {
            
            $_SESSION["uye"] = $z["uye_adi"];
            $_SESSION["uyesoyad"] = $z["uye_soyad"];
            $_SESSION["eposta"] = $z["uye_eposta"];
            $_SESSION["rutbe"] = $z["uye_rutbe"];
            $_SESSION["id"] = $z["uye_id"];

            header("location:index.php");

        }elseif($z["uye_onay"] == 0){
			
			echo '<div class="hata">uyeliğiniz onaylanmadı yonetici onayını bekleyin..</div>';
			
        }else {
            echo '<div class="hata">Üye Adı veya Şifreniz Hatalı</div>';
        }

    }
}

?>