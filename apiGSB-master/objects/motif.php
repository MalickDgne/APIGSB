<?php
class Motif{

    // database connection and table name
    private $conn;
    private $table_name = "motif";

    // object properties
    public $MOTIF_CODE;
    public $MOTIF_LIBELLE;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    public function read(){

      $query="SELECT * FROM motif";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }

}
?>
