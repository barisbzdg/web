<?php 
  class Yorumlar {
    // DB stuff
    private $conn;
    private $table = 'yorumlar';

    // Post Properties
    public $yorum_id;
    public $yorum_ekleyen;
    public $yorum_eposta;
    public $yorum_mesaj;
    public $yorum_tarih;
    public $yorum_konu_id;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT p.yorum_id, p.yorum_ekleyen, p.yorum_eposta, p.yorum_mesaj, p.yorum_tarih, p.yorum_konu_id
                                FROM ' . $this->table . ' p
                               
                                 ORDER BY
                                  p.yorum_id DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT p.yorum_id, p.yorum_ekleyen, p.yorum_eposta, p.yorum_mesaj, p.yorum_tarih, p.yorum_konu_id
                                    FROM ' . $this->table . ' p
                                    
                                    WHERE
                                      p.yorum_id = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->yorum_ekleyen = $row['yorum_ekleyen'];
          $this->yorum_eposta = $row['yorum_eposta'];
          $this->yorum_mesaj = $row['yorum_mesaj'];
          $this->yorum_tarih = $row['yorum_tarih'];
          $this->yorum_konu_id = $row['yorum_konu_id'];
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET yorum_ekleyen = :yorum_ekleyen, yorum_eposta = :yorum_eposta, yorum_mesaj = :yorum_mesaj,  yorum_konu_id = :yorum_konu_id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->yorum_ekleyen = htmlspecialchars(strip_tags($this->yorum_ekleyen));
          $this->yorum_eposta = htmlspecialchars(strip_tags($this->yorum_eposta));
          $this->yorum_mesaj = htmlspecialchars(strip_tags($this->yorum_mesaj));
          $this->yorum_konu_id = htmlspecialchars(strip_tags($this->yorum_konu_id));

          // Bind data
          $stmt->bindParam(':yorum_ekleyen', $this->yorum_ekleyen);
          $stmt->bindParam(':yorum_eposta', $this->yorum_eposta);
          $stmt->bindParam(':yorum_mesaj', $this->yorum_mesaj);
          $stmt->bindParam(':yorum_konu_id', $this->yorum_konu_id);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Post
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET yorum_ekleyen = :yorum_ekleyen, yorum_eposta = :yorum_eposta, yorum_mesaj = :yorum_mesaj,  yorum_konu_id = :yorum_konu_id
                                WHERE yorum_id = :yorum_id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->yorum_ekleyen = htmlspecialchars(strip_tags($this->yorum_ekleyen));
          $this->yorum_eposta = htmlspecialchars(strip_tags($this->yorum_eposta));
          $this->yorum_mesaj = htmlspecialchars(strip_tags($this->yorum_mesaj));
          $this->yorum_konu_id = htmlspecialchars(strip_tags($this->yorum_konu_id));
          $this->yorum_id = htmlspecialchars(strip_tags($this->yorum_id));

          // Bind data
          $stmt->bindParam(':yorum_ekleyen', $this->yorum_ekleyen);
          $stmt->bindParam(':yorum_eposta', $this->yorum_eposta);
          $stmt->bindParam(':yorum_mesaj', $this->yorum_mesaj);
          $stmt->bindParam(':yorum_konu_id', $this->yorum_konu_id);
          $stmt->bindParam(':yorum_id', $this->yorum_id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Post
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE yorum_id = :yorum_id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->yorum_id = htmlspecialchars(strip_tags($this->yorum_id));

          // Bind data
          $stmt->bindParam(':yorum_id', $this->yorum_id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }