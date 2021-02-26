<?php
    if (isset($_POST["email"])){
        $kime = "btechnoblog@gmail.com";
        $konu = $_POST["konu"];
        $mesaj = "<h1>".$_POST["mesaj"]."</h1>";
        $baslik = "From: ".$_POST["name"]."<".$_POST["email"].">\r\n";
        $baslik .= "Reply-to : info@technoblog\r\n";
        $baslik .= "Content-type: text/html\r\n";
        
        if(mail($kime,$konu,$mesaj,$baslik))
        
            echo"<script type='text/javascript'>  
            alert('Mesajınız başarıyla gönderilmiştir.');
            </script>";
        else
            echo "Malesef e-mailiniz gönderilemedi.";
    }
?>




<div class="sol2">
<form action="" method="post">
  <h2>Bize Ulaşın</h2>
  <ul>
  <li>Adınız</li>
  <li><input type="text" name="name" /></li>
  <li>Konu Başlığı</li>
  <li><input type="text" name="konu" /></li>
  <li>Mail</li>
  <li><input type="text" name="email" /><br></li>
  <li>Mesaj</li>
  <li><textarea name="mesaj" id="" cols="50" rows="10"></textarea></li>
  <li><br><button type="submit">gonder</button><br></li>
  </ul>

</form>
</div>



