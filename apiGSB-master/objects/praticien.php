<?php
class Praticien{

    // database connection and table name
    private $conn;
    private $table_name = "praticien";

    // object properties
    public $PRA_NUM;
    public $PRA_NOM;
    public $PRA_PRENOM;
    public $PRA_ADRESSE;
    public $PRA_CP;
    public $PRA_VILLE;
    public $PRA_COEFNOTORIETE;
    public $dep;

    public $TYP_LIEU;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    public function read(){
      $query="SELECT PRA_NUM, PRA_NOM, PRA_PRENOM, PRA_ADRESSE, PRA_CP, PRA_VILLE, PRA_COEFNOTORIETE, dep, TYP_LIEU FROM praticien INNER JOIN type_praticien ON praticien.TYP_CODE = type_praticien.TYP_CODE ORDER BY 1";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }

    public function readOne(){

        // query to read single record
        $query = "SELECT * FROM praticien WHERE PRA_NUM = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $this->PRA_NUM);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->PRA_NOM = $row['PRA_NOM'];
        $this->PRA_PRENOM = $row['PRA_PRENOM'];
        $this->PRA_ADRESSE = $row['PRA_ADRESSE'];
        $this->PRA_CP = $row['PRA_CP'];
        $this->PRA_VILLE = $row['PRA_VILLE'];
        $this->PRA_COEFNOTORIETE = $row['PRA_COEFNOTORIETE'];
        $this->TYP_CODE = $row['TYP_CODE'];
    }

    public function readDep(){

      $query = "SELECT DISTINCT(dep) FROM praticien ORDER BY 1";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }
}
?>
