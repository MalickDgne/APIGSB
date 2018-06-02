<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/Rapport_visite.php';

$database = new Database();
$db = $database->getConnection();

$rapportvisite = new Rapport_visite($db);

if(!isset($_POST['COL_MATRICULE']) OR !isset($_POST['MOTIF_LIBELLE']) OR !isset($_POST['PRA_NUM']) OR !isset($_POST['RAP_BILAN']) OR empty($_POST['COL_MATRICULE']) OR empty($_POST['MOTIF_LIBELLE']) OR empty($_POST['PRA_NUM']) OR empty($_POST['RAP_BILAN']))
{
  echo '{';
      echo '"message": "Des informations sont manquantes."';
  echo '}';
}
else {

  // set product property values
  $rapportvisite->COL_MATRICULE = $_POST['COL_MATRICULE'];
  $rapportvisite->PRA_NUM = $_POST['PRA_NUM'];
  $rapportvisite->RAP_DATE = date('Y-m-d H:i:s');
  $rapportvisite->RAP_BILAN = $_POST['RAP_BILAN'];
  $rapportvisite->MOTIF_LIBELLE = $_POST['MOTIF_LIBELLE'];

  // create the product
  if($rapportvisite->create()){
      echo '{';
          echo '"message": "Rapport de visite créer."';
      echo '}';
  }

  // if unable to create the product, tell the user
  else{
      echo '{';
          echo '"message": "Impossible de créer le rapport de visite."';
      echo '}';
  }
}



?>
