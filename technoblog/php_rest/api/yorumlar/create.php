  
<?php 

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Yorumlar.php';


  $database = new Database();
  $db = $database->connect();


  $yorumlar = new Yorumlar($db);

 
  $data = json_decode(file_get_contents("php://input"));

  $yorumlar->yorum_ekleyen = $data->yorum_ekleyen;
  $yorumlar->yorum_eposta = $data->yorum_eposta;
  $yorumlar->yorum_mesaj = $data->yorum_mesaj;
  $yorumlar->yorum_konu_id = $data->yorum_konu_id;

  
  if($yorumlar->create()) {
    echo json_encode(
      array('message' => 'Veri oluşturuldu')
    );
  } else {
    echo json_encode(
      array('message' => 'Veri oluşturulmadı')
    );
  }