<?php
class Rapport_visite{

    // database connection and table name
    private $conn;
    private $table_name = "rapport_visite";

    // object properties
    public $COL_MATRICULE;
    public $RAP_NUM;
    public $PRA_NUM;
    public $RAP_DATE;
    public $RAP_BILAN;
    public $MOTIF_LIBELLE;
    public $MOTIF_CODE;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){

      $query = "SELECT rapport_visite.COL_MATRICULE,rapport_visite.RAP_NUM,RAP_BILAN,PRA_NUM,RAP_DATE,motif.MOTIF_LIBELLE FROM rapport_visite INNER JOIN motiver ON motiver.RAP_NUM = rapport_visite.RAP_NUM INNER JOIN motif ON motif.MOTIF_CODE = motiver.MOTIF_CODE ORDER BY rapport_visite.RAP_NUM";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }

    public function readMax(){

        // query to read single record
        $query = "SELECT MAX(RAP_NUM)+1 AS MAX  FROM rapport_visite";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // create rapport_visite
    public function create(){

        // query to insert record
        $query = "INSERT INTO rapport_visite(COL_MATRICULE, PRA_NUM, RAP_DATE, RAP_BILAN) VALUES (?,?,?,?)";
        $query2 = "INSERT INTO motiver(COL_MATRICULE,RAP_NUM,MOTIF_CODE) VALUES (?,?,?)";

        // prepare query
        $stmt = $this->conn->prepare($query);
        $stmt2 = $this->conn->prepare($query2);

        // sanitize
        $this->COL_MATRICULE=htmlspecialchars(strip_tags($this->COL_MATRICULE));
        $this->PRA_NUM=htmlspecialchars(strip_tags($this->PRA_NUM));
        $this->RAP_DATE=htmlspecialchars(strip_tags($this->RAP_DATE));
        $this->RAP_BILAN=htmlspecialchars(strip_tags($this->RAP_BILAN));
        $this->MOTIF_LIBELLE=htmlspecialchars(strip_tags($this->MOTIF_LIBELLE));

        //
        $query3 = "SELECT MOTIF_CODE FROM motif WHERE MOTIF_LIBELLE= ?";
        $stmt3 = $this->conn->prepare($query3);
        $stmt3->bindParam(1, $this->MOTIF_LIBELLE);
        $stmt3->execute();
        $row = $stmt3->fetch(PDO::FETCH_ASSOC);
        $this->MOTIF_CODE= $row['MOTIF_CODE'];

        //
        $stmtMax = $this->readMax();
        $rowMax = $stmtMax->fetch(PDO::FETCH_ASSOC);
        $this->RAP_NUM= $rowMax['MAX'];

        if($stmt2->execute(array($this->COL_MATRICULE, $this->RAP_NUM,$this->MOTIF_CODE)) == $stmt->execute(array($this->COL_MATRICULE, $this->PRA_NUM, $this->RAP_DATE, $this->RAP_BILAN))){
            return true;
        }

        return false;

    }
}
?>
