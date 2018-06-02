<?php
class notedefrais{

    // database connection and table name
    private $conn;
    private $table_name = "notedefrais";

    // object properties
    public $id;
    public $PRA_NOM;
    public $dateVisite;
    public $MontantRepasMidi;
    public $MontantRepasSoir;
    public $PrixNuit;
    public $MontantTotalHF;
    public $NbJustificatif;
    public $MontantTotal;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
      $query = "SELECT * FROM notedefrais ORDER BY '1' ";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }
    // used when filling up the update product form

    public function create(){

        // query to insert record
        $query = "INSERT INTO notedefrais(PRA_NOM,dateVisite,MontantRepasMidi,MontantRepasSoir,PrixNuit,MontantTotalHF,NbJustificatif,MontantTotal) VALUES (?,?,?,?,?,?,?,?)";
       

        // prepare query
        $stmt = $this->conn->prepare($query);
        

        // sanitize
        $this->PRA_NOM=htmlspecialchars(strip_tags($this->PRA_NOM));
        $this->dateVisite=htmlspecialchars(strip_tags($this->dateVisite));
        $this->MontantRepasMidi=htmlspecialchars(strip_tags($this->MontantRepasMidi));
        $this->MontantRepasSoir=htmlspecialchars(strip_tags($this->MontantRepasSoir));
        $this->PrixNuit=htmlspecialchars(strip_tags($this->PrixNuit));
        $this->MontantTotalHF=htmlspecialchars(strip_tags($this->MontantTotalHF));
        $this->NbJustificatif=htmlspecialchars(strip_tags($this->NbJustificatif));
        $this->MontantTotal=htmlspecialchars(strip_tags($this->MontantTotal));
 
        //
       

        //
      

        if($stmt->execute(array($this->PRA_NOM, $this->dateVisite, $this->MontantRepasMidi, $this->MontantRepasSoir,$this->PrixNuit,$this->MontantTotalHF,$this->NbJustificatif,$this->MontantTotal)) == true);
           
            {
                return true;
            }

            return false;
        

        
}



}
    

?>
