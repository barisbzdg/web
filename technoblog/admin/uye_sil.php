<?php

$id = $_GET["id"];



?>

<div class="admin-icerik-sag"> 
			<h2>uye sil</h2>
			<div class="konular"> 
			<?php
			$v = $db->prepare("delete from uyeler where uye_id=?");
			$sil = $v->execute(array($id));
			if($sil){
				
				echo '<div class="basarili2">uye basarıyla engellendi yonlendiriliyorsunuz..</div>';
				header("refresh: 2; url=/admin/?do=uyeler");
			}else {
				
				echo '<div class="hata">uye silinirken bir hata olustu</div>';
				
			}
			?>
			</div>
			</div>