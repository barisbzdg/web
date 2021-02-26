<?php
	if($_SESSION) {

		?>

		<div class="sag3">
			<h2>Üye Profili</h2>
			<div style="border:1px solid #ddd;padding:7px;font-size:15px;font-weight:bold;font-family:Verdana, Geneva, Tahoma, sans-serif;">Hoşgeldiniz : <?php echo $_SESSION["uye"];?></div>
			<ul>
			<?php if($_SESSION["rutbe"] == 1){
		
		echo '<li><a href="/admin/">admin paneli</a></li>';
		
	}?>
			<li><a href="?do=konu_ekle">Haber ekle</a></li>
			<li><a href="?do=cikis">Çıkış</a></li>
			</ul>
		
		</div>

		<?php


	}else {
		?>

	<div class="sag2"> 
	<h2>Üye Girişi</h2>
	<ul>
    <form action="?do=uye" method="post">
	<li>Üye Eposta</li>
	<li><input type="text" name="eposta" /></li>
	<li>Şifreniz</li>
	<li><input type="password" name="sifre" /></li>
	<li><button type="submit">Giriş Yap</button></li>
	</form>
	<li><a href="kayit_ol.php"><button type="submit">Kayıt Ol</button></a></li>
    <li><a href="sifremiunuttum.php"><button type="submit">Şifremi Unuttum</button></a></li> 
	</ul>
	</div>

		<?php
	}

?>

