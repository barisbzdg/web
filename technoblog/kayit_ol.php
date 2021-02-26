<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <?php

    $host    = "localhost";
    $dbname  = "test";
    $kadi    = "root";
    $sifre   = "";

    try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8","$kadi","$sifre");

    }catch (PDOException $mesaj) {

    echo $mesaj->getmessage();
}
 
?>
    <?php
        
    if($_POST) {
        $isim = $_POST["isim"];
        $soyad = $_POST["soyad"];
        $sifre = $_POST["sifre"];
        $eposta = $_POST["eposta"];
        $kod = md5(rand(0,99999));

        if (!$isim || !$soyad || !$sifre || !$eposta) {
            echo '<div class ="alert alert-warning">Gerekli Alanları Doldurmanız Gerekiyor..</div>';
        }
        
    else{
    
        $insert =$db->prepare("insert into uyeler set
                                uye_adi=?,
                                uye_soyad=?,
                                uye_sifre=?,
                                uye_eposta=?,
                                uye_kod=?    
                        ");
    
           $ok = $insert->execute(array($isim,$soyad,$sifre,$eposta,$kod));
                if ($ok) {
                    
                    include("mail/PHPMailerAutoload.php");
			
            $mail = new PHPMailer;            
 			
			$mail->IsSMTP();
			//$mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'tls'; // Güvenli baglanti icin ssl normal baglanti icin tls
			$mail->Host = "smtp.gmail.com"; // Mail sunucusuna ismi
			$mail->Port = 587; // Gucenli baglanti icin 465 Normal baglanti icin 587
			$mail->IsHTML(true);
			$mail->SetLanguage("tr", "phpmailer/language");
			$mail->CharSet  ="utf-8";
			$mail->Username = "btechnoblog@gmail.com"; // Mail adresimizin kullanicı adi
			$mail->Password = "deneme1deneme"; // Mail adresimizin sifresi
			$mail->SetFrom("btechnoblog@gmail.com"); // Mail attigimizda gorulecek ismimiz
			$mail->AddAddress($eposta); // Maili gonderecegimiz kisi yani alici
			$mail->addReplyTo($eposta, $isim);
			$mail->Subject = "Üye Onay Maili"; // Konu basligi
            $mail->Body = "<div style='background:#eee;padding:5px;margin:5px;width:300px;'> eposta : ".$eposta."</div> <br /> Onaylama Linki : <br />
            
            http://localhost/onay.php?eposta=".$eposta."&kod=".$kod."
            "; // Mailin icerigi

			if(!$mail->Send()){
			
                echo '<div class ="alert alert-warning">Mail Gönderilemedi...</div>';
			
			}else {
				
				echo '<div class ="alert alert-warning">Üye Kaydınız Oluşmuştur. Mail adresininize onaylama maili gönderilmiştir...</div>';
				
			}


                }else {
                    echo '<div class ="alert alert-success">Kayıt olurken bir hata oluştu..</div>';
                }
    }
}
    
            ?>
            <form action="" method="post">
            <div class="col-md-5">
            <h3>Üye Kayıt</h3>
            <div class="form-group">
            <label for="isim">Adınız</label>
            <input type="text" name="isim" class="form-control" id="isim" />
            </div>

            <div class="form-group">
            <label for="soyad">Soyadınız</label>
            <input type="text" name="soyad" class="form-control" id="soyad" />
            </div>

            <div class="form-group">
            <label for="sifre">Şifreniz</label>
            <input type="password" name="sifre" class="form-control" id="sifre" />
            </div>

            <div class="form-group">
            <label for="eposta">E-Posta Adresiniz</label>
            <input type="text" name="eposta" class="form-control" id="eposta" />
            </div>

            <button type="submit" class="btn btn-primary">Kayıt Ol</button>
           </div>
           </form>
            <?php
        
    
    ?>
    </div>
</body>
</html>