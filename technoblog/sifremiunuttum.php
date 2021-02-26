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
        
        $eposta = $_POST["eposta"];
       
        if (!$eposta) {
            echo '<div class ="alert alert-warning">E posta adresi boş bırakılamaz...</div>';
        }
        
    else{
    
         $query = $db->prepare("select * from uyeler where uye_eposta=?");
         $query->execute(array($eposta));
         $row = $query->fetch(PDO::FETCH_ASSOC);
         $kontrol = $query->rowCount();

         if($kontrol){

         
                    
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
			$mail->addReplyTo($eposta,$row["uye_adi"]);
			$mail->Subject = "Şifre Sıfırlama Maili"; // Konu basligi
            $mail->Body = "<div style='background:#eee;padding:5px;margin:5px;width:300px;'> eposta : ".$eposta."</div> <br /> Sıfırlama Linki : <br />
            
            http://localhost/sifre_duzenle.php?eposta=".$eposta."&kod=".$row["uye_kod"]."
            "; // Mailin icerigi

			if(!$mail->Send()){
			
                echo '<div class ="alert alert-warning">Mail Gönderilemedi...</div>';
			
			}else {
				
				echo '<div class ="alert alert-success">Mail adresininize parola sıfırlama maili gönderilmiştir...</div>';
				
            }
            
        }else {
            echo '<div class ="alert alert-warning">Girilen e posta adresi sistemde kayıtlı değil..</div>';
        }


                
    }
}
    
            ?>
            <form action="" method="post">
            <div class="col-md-5">
            <h3>Parola Sıfırlama</h3>
            
            <div class="form-group">
            <label for="eposta">E-Posta Adresiniz</label>
            <input type="text" name="eposta" class="form-control" id="eposta" />
            </div>

            <button type="submit" class="btn btn-primary">Parolanızı sıfırlayın</button>
           </div>
           </form>
            <?php
        
    
    ?>
    </div>
</body>
</html>