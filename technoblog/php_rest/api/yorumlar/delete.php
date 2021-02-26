<?php 

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Yorumlar.php';


  $database = new Database();
  $db = $database->connect();


  $yorumlar = new Yorumlar($db);


  $data = json_decode(file_get_contents("php://input"));


  $yorumlar->yorum_id = $data->yorum_id;


  if($yorumlar->delete()) {
    echo json_encode(
      array('message' => 'Veri silindi')
    );
  } else {
    echo json_encode(
      array('message' => 'Veri silinemedi')
    );
  }