<?php
class Medicament{

    // database connection and table name
    private $conn;
    private $table_name = "medicament";

    // object properties
    public $MED_NOMCOMMERCIAL;
    public $FAM_CODE;
    public $MED_COMPOSITION;
    public $MED_EFFETS;
    public $MED_CONTREINDIC;
    public $MED_PRIXECHANTILLON;
    public $MED_DEPOTLEGAL;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){

      $query = "SELECT * FROM medicament";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }
    // used when filling up the update product form
    public function readOne(){
        // query to read single record
        $query = "SELECT * FROM medicament INNER JOIN famille ON medicament.FAM_CODE = famille.FAM_CODE WHERE medicament.MED_DEPOTLEGAL = ? ORDER BY 1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $this->MED_DEPOTLEGAL);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->MED_NOMCOMMERCIAL = $row['MED_NOMCOMMERCIAL'];
        $this->FAM_CODE = $row['FAM_CODE'];
        $this->MED_COMPOSITION = $row['MED_COMPOSITION'];
        $this->MED_EFFETS = $row['MED_EFFETS'];
        $this->MED_CONTREINDIC = $row['MED_CONTREINDIC'];
        $this->MED_PRIXECHANTILLON = $row['MED_PRIXECHANTILLON'];

    }
}
?>
