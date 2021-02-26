<?php !defined("index") ? die("Hacking ??") : null;?>
<?php

    $konu = $db->prepare("select * from konular inner join kategoriler on kategoriler.kategori_id = konular.konu_kategori");
    $konu->execute(array());
    $x = $konu->fetchALL(PDO::FETCH_ASSOC);

    foreach ($x as $m) {
	   
		$yorum = $db->prepare("select * from yorumlar where yorum_konu_id=?");
		$yorum->execute(array($m["konu_id"]));
		$yorum->fetchAll(PDO::FETCH_ASSOC);
		$x = $yorum->rowCount();
	 ?>
    <div class="sol2"> 
	    <h2><?php echo $m["konu_baslik"];?></h2>
	    <div class="bilgi">Kategori : <?php echo $m["kategori_adi"];?> Ekleyen : <?php echo $m["konu_ekleyen"];?> Okunma : <?php echo $m["konu_hit"];?> Yorum : <?php echo $x;?> 
	    <span style="float:right;">tarih : <?php echo $m["konu_tarih"];?></span></div>
	    <div class="resim"> 
	    <img src="<?php echo $m["konu_resim"];?>" alt="" />
	    </div>
	    <p> 
	    <?php echo substr($m["konu_aciklama"],0,300); ?>....
	    </p>
	
	    <div class="devam"> 
	    <a href="?do=devam&id=<?php echo $m["konu_id"];?>">devam</a>
	    </div>
	    <div style="clear:both;"></div>
	    </div>
    
        <?php
    }

?>
