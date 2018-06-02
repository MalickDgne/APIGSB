<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/medicament.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$UnMedicament = new Medicament($db);

// set ID property of product to be edited
$UnMedicament->MED_DEPOTLEGAL = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of product to be edited
$UnMedicament->readOne();

// create array
$UnMedicament_arr = array(
  "MED_NOMCOMMERCIAL" =>  $UnMedicament->MED_NOMCOMMERCIAL,
  "FAM_CODE" => $UnMedicament->FAM_CODE,
  "MED_COMPOSITION" => $UnMedicament->MED_COMPOSITION,
  "MED_EFFETS" => $UnMedicament->MED_EFFETS,
  "MED_CONTREINDIC" => $UnMedicament->MED_CONTREINDIC,
  "MED_PRIXECHANTILLON" => $UnMedicament->MED_PRIXECHANTILLON
);

// make it json format
print_r(json_encode($UnMedicament_arr));
?>
