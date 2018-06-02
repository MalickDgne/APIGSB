<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/notedefrais.php';

$database = new Database();
$db = $database->getConnection();

$notedefrais = new notedefrais($db);

if(!isset($_POST['PRA_NOM'])  OR !isset($_POST['MontantRepasMidi']) OR !isset($_POST['MontantRepasSoir']) OR !isset($_POST['PrixNuit']) OR !isset($_POST['MontantTotalHF']) OR !isset($_POST['NbJustificatif']) OR !isset($_POST['MontantTotal']))
{
  echo '{';
      echo '"message": "Des informations sont manquantes."';
  echo '}';
}
else {

  // set product property values
  $notedefrais->PRA_NOM = $_POST['PRA_NOM'];
  $notedefrais->dateVisite = date('Y-m-d H:i:s');
  $notedefrais->MontantRepasMidi = $_POST['MontantRepasMidi'];
  $notedefrais->MontantRepasSoir = $_POST['MontantRepasSoir'];
  $notedefrais->PrixNuit = $_POST['PrixNuit'];
  $notedefrais->MontantTotalHF = $_POST['MontantTotalHF'];
  $notedefrais->NbJustificatif = $_POST['NbJustificatif'];
  $notedefrais->MontantTotal = $_POST['MontantTotal'];


  // create the product
  if($notedefrais->create()){
      echo '{';
          echo '"message": "Note de frais créer."';
      echo '}';
  }

  // if unable to create the product, tell the user
  else{
      echo '{';
          echo '"message": "Impossible de créer la Note de frais."';
      echo '}';
  }
}



?>
