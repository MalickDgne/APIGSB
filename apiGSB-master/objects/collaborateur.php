<?php
class Collaborateur{

    // database connection and table name
    private $conn;
    private $table_name = "collaborateur";

    // object properties
    public $COL_MATRICULE;
    public $COL_NOM;
    public $COL_DATEEMBAUCHE;
    public $COL_PRENOM;
    public $COL_ADRESSE;
    public $COL_CP;
    public $COL_VILLE;
    public $LAB_CHEFVENTE;
    public $SEC_LIBELLE;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
      $query = "SELECT * FROM collaborateur INNER JOIN visiteur ON visiteur.COL_MATRICULE = collaborateur.COL_MATRICULE INNER JOIN labo ON collaborateur.LAB_CODE = labo.LAB_CODE LEFT JOIN secteur ON collaborateur.SEC_CODE = secteur.SEC_CODE ORDER BY 1";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }
    // used when filling up the update product form
    public function readOne(){

        // query to read single record
        $query = "SELECT * FROM collaborateur INNER JOIN visiteur ON visiteur.COL_MATRICULE = collaborateur.COL_MATRICULE INNER JOIN labo ON collaborateur.LAB_CODE = labo.LAB_CODE LEFT JOIN secteur ON collaborateur.SEC_CODE = secteur.SEC_CODE WHERE collaborateur.COL_MATRICULE = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $this->COL_MATRICULE);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->COL_NOM = $row['COL_NOM'];
        $this->COL_DATEEMBAUCHE = $row['COL_DATEEMBAUCHE'];
        $this->COL_PRENOM = $row['COL_PRENOM'];
        $this->COL_ADRESSE = $row['COL_ADRESSE'];
        $this->COL_CP = $row['COL_CP'];
        $this->COL_VILLE = $row['COL_VILLE'];
        $this->LAB_CHEFVENTE = $row['LAB_CHEFVENTE'];
        $this->SEC_LIBELLE = $row['SEC_LIBELLE'];
    }
}
?>
