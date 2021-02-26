<?php define("index",true);?>
<?php include("ayar.php");?>
<?php session_start();
ob_start();

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>TechnoBlog</title>
	<link rel="stylesheet" href="css/styles.css" />
	<link rel="stylesheet" href="css/reset.css" />
</head>
<body>
	<div class="genel"> 
	<div class="header"> 
	<h2><span style="color:skyblue;">TechnoBlog</span></h2>
	<div class="reklam"> 

	</div>
	</div>
	
		<div class="menu"> 
	<ul> 
	<li><a href="index.php">anasayfa</a></li>
	<li><a href="">dersler</a></li>
	<li><a href="">video</a></li>
	<li><a href="">hakkımda</a></li>
	<li><a href="?do=iletisim">iletisim</a></li>
	</ul>
	
	</div>
	<div style="clear:both;"></div>		
	<div class="content"> 
	<div class="sol"> 
   
   <?php 
   
   $do = @$_GET["do"];
   
    switch ($do){
		
		
		case "iletisim":
		include("iletisim.php");
			break;
		
		break;
		
		case "kategori":
		include("kategori_liste.php");
		break;
		
		case "ara":
		include("ara.php");
		break;
		
		case "uye":
		include("uye_giris.php");
		break;
		case "konu_ekle":
		include("konu_ekle.php");
		break;
		
		case "kayit":
		
		include("kayit.php");
		
		break;
		
		case "cikis":
		
		session_destroy();
		
		header("refresh: 2; url=index.php");
		
		echo '<div class="basarili2">başarıyla çıkış yaptınız yönlendiriliyorsunuz</div>';
		
		break;
		
		case "devam":
		include ("devam.php");
		break;
		
		default :
		
		include ("anasayfa.php");
		break;
		
		
	}
   
   
   
   
   ?>
	
	
	
	
	</div>
	
	
	<div class="sag"> 
	<?php include("uye.php");?>
	
	
	
	
	<?php include("kategori.php");?>
	
	 
	  <?php  include("populer_konular.php");?>   
   

  
	</div>
	
	
	</div>
	<div style="clear:both;"></div>
	
	
	
	
	</div>
	
</body>
</html>