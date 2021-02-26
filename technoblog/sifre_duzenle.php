<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

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
	  
	  
	  
	    $eposta = $_GET["eposta"];
	    $kod    = $_GET["kod"];
		
	    if(!$eposta || !$kod){
			
 echo '<div style="margin-top:20px;" class="alert alert-warning">gerekli kodlar bos gozukuyor ..</div>';
	
			
		}else {
			
		  
          $query = $db->prepare("select * from uyeler where uye_eposta=? and uye_kod=?");
		  $query->execute(array($eposta,$kod));
		  $query->fetch(PDO::FETCH_ASSOC);
		  $kontrol = $query->rowCount(); 
		  
		  if($kontrol){
			  
            if($_POST){
                $sifre = $_POST["sifre"];

                if(!$sifre){
                    
                    echo '<div class ="alert alert-warning">Şifre Alanı Boş Bırakılamaz..</div>';
                
                } else {
                    
                    $update = $db->prepare("update uyeler set uye_sifre=? where uye_eposta=? and uye_kod=?");
                    $ok = $update->execute(array($sifre,$eposta,$kod));

                    if ($ok == true) {
                        
                        echo '<div class ="alert alert-success">Şifreniz başarıyla değiştirildi. Giriş yapabilirsiniz..</div>';
                        header("refresh: 2; url=index.php");
                    
                    }else {
                        echo '<div class ="alert alert-warning">Şifreniz değiştirilirken bir hata oluştu...</div>';
                    }
                }
            }else {
                ?>
                <form action="" method="post">
                <div class="col-md-5">
                <h3>Yeni Şifrenizi Giriniz..</h3>
            
                <div class="form-group">
                <label for="eposta">Yeni Şifre</label>
                <input type="password" name="sifre" class="form-control" id="eposta" />
                </div>

                <button type="submit" class="btn btn-primary">Gönder</button>
                </div>
                </form>
                <?php
            }
			  
			  
		  }else {
			  
			 echo '<div style="margin-top:20px;" class="alert alert-warning">onay kodu yanlıs yada daha once onaylanmıs...</div>'; 
			  
		  }
			
			
		}
	    
		
	  
	  ?>
	 
	 
	 
	 
	 </div>
</body>
</html>