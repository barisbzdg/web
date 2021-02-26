<?php
$gID=$_GET['id'];
$baglan=mysqli_connect("localhost","root","","test");
$sonuc1=mysqli_query($baglan,"select * from yorumlar WHERE yorum_id=".$gID);
$m = mysqli_fetch_array($sonuc1);
?>
    <form method="POST" action="guncelle2.php">
    <table border="1" align="center" width="50%">
<tr>
<td colspan="2" align="center"> Yorum Düzenleme</td>
</tr>
<tr>
<td>Ad</td>
<?php echo '<td><input type="text"style="width: 700px; height:50px;" name="yorum_ekleyen" value='.$m['yorum_ekleyen'].'></td>';?>
</tr>
<tr>
<td>Mesaj</td>
<?php echo '<td><input type="text" style="width: 700px; height: 50px;" name="yorum_mesaj" value='.$m['yorum_mesaj'].'></td>';?>
</tr>


<?php echo '<input type="hidden"style="width: 700px; height:50px;" name="id" value='.$m['yorum_id'].'>';?>




<tr>
<td></td>
<td><input type="submit" value="Kaydet"></td>
</tr>
</table>
</form>