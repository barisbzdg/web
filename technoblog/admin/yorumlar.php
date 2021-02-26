<?php 

$v = $db->prepare("select * from yorumlar order by yorum_id desc limit 20");
$v->execute(array());
$k = $v->fetchALL(PDO::FETCH_ASSOC);
$x = $v->rowCount();



?>

<div class="admin-icerik-sag"> 
			<h2>yorumlar </h2>
			<div class="konular"> 
			<table cellspacing="0" cellpadding="0"> 
			<thead> 
			<tr> 
			<th width="600">yorumlar</th> <th width="300">yorum ekleyen</th>
			 <th width="250">tarih</th>
			<th width="200">işlemler</th>
			</tr>
			</thead>
			<?php 
			 if($x){
				
                foreach($k as $m){
					?>
					<tbody> 
					<tr> 
					<td><?php echo mb_substr($m["yorum_mesaj"],0,35);?></td> <td><?php echo $m["yorum_ekleyen"];?></td>
				
					<td><?php echo $m["yorum_tarih"];?></td> 
					<td> <span style="margin-left:10px;"><a href="/admin/?do=yorum_sil&id=<?php echo $m["yorum_id"];?>">sil</a></span>
					
					
					</td>
					</tr>
					</tbody>
					<?php
					
					
				}				
				 
			 }else {
				 
				echo '<tr><td colspan="5"><div class="hata">henuz hiç konu 
				eklenmemis...</div></td></tr>'; 
				 
			 }
			
			?>
			</table>
			
			</form>
			</div>
			
			</div>