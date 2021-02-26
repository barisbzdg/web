<?php
$gid=$_POST['id'];

$yorum_ekleyen = $_POST['yorum_ekleyen'];
$yorum_mesaj = $_POST['yorum_mesaj'];
$baglan=mysqli_connect("localhost","root","","test");
$sql="UPDATE `yorumlar` SET yorum_ekleyen='$yorum_ekleyen' ,  yorum_mesaj='$yorum_mesaj' WHERE yorum_id='$gid'";
$sonuc= mysqli_query($baglan,$sql);

header('Location: index.php');

?>