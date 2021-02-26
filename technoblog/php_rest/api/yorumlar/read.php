<?php 

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Yorumlar.php';


  $database = new Database();
  $db = $database->connect();

 
  $yorumlar = new Yorumlar($db);


  $result = $yorumlar->read();

  $num = $result->rowCount();


  if($num > 0) {
  
    $posts_arr = array();
  
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $post_item = array(
        'yorum_id' => $yorum_id,
        'yorum_ekleyen' => $yorum_ekleyen,
        'yorum_eposta' => html_entity_decode($yorum_eposta),
        'yorum_mesaj' => $yorum_mesaj,
        'yorum_tarih' => $yorum_tarih,
        'yorum_konu_id' => $yorum_konu_id
      );

      
      array_push($posts_arr, $post_item);
    
    }

  
    echo json_encode($posts_arr);

  } else {
   
    echo json_encode(
      array('message' => 'Veri yok')
    );
  }