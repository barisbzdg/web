<?php session_start();?>
<?php include("ayar.php");?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>admin paneli</title>
	<link rel="stylesheet" href="../css/styles.css" />
	<link rel="stylesheet" href="../css/reset.css" />
	<link rel="stylesheet" href="../css/admin.css" />
</head>
<body>
	<?php 
	if($_SESSION){
		
		if($_SESSION["rutbe"] == 1){
			?>
			<div class="admin-genel"> 
			<div class="admin-header"> 
			<h2><a href="/admin/">blog <span style="color:red;">admin paneli</span></a>
			<span style="float:right; margin-right:30px;"><a href="/index.php">siteyi goruntule</a></span>
			</h2>
			<div class="uye">
			admin paneline hosgeldiniz : <?php echo $_SESSION["uye"];?></div>
			</div>
			<div class="admin-icerik"> 
			<div class="admin-menu"> 
			<ul> 
			<li><a href="/admin/?do=konular">haberler</a></li>
			<li><a href="/admin/?do=uyeler">uyeler</a></li>
			<li><a href="/admin/?do=yorumlar">yorumlar</a></li>
			<li><a href="">kategoriler</a></li>
			<li><a href="">cıkıs</a></li>
			</ul>
			</div>
			<?php 
			  
			  $do = @$_GET["do"];
			  
			  if(file_exists("{$do}.php")){
				  
				  include("{$do}.php");
				  
			  }else {
				  
				 include("anasayfa.php"); 
				  
			  }
			  
			
			?>
			</div>
			</div>
			<?php
			
			
		}else {
			
			echo '<div class="hata">admin panelinde yetkiniz bulunmuyor..</div>';
		}
		
	}else{
		
		echo '<div class="hata">admin paneline girmek için uye girisi yapmanız gerekiyor..</div>';
	}
	
	?>
	
	
</body>
</html>


















