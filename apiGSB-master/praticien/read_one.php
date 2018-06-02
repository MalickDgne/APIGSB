<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/praticien.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$UnPraticien = new Praticien($db);

// set ID property of product to be edited
$UnPraticien->PRA_NUM = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of product to be edited
$UnPraticien->readOne();

// create array
$UnPraticien_arr = array(
  "PRA_NUM" =>  $UnPraticien->PRA_NUM,
  "PRA_NOM" => $UnPraticien->PRA_NOM,
  "PRA_PRENOM" => $UnPraticien->PRA_PRENOM,
  "PRA_ADRESSE" => $UnPraticien->PRA_ADRESSE,
  "PRA_CP" => $UnPraticien->PRA_CP,
  "PRA_VILLE" => $UnPraticien->PRA_VILLE,
  "PRA_COEFNOTORIETE" => $UnPraticien->PRA_COEFNOTORIETE,
  "TYP_CODE" => $UnPraticien->TYP_CODE

);

// make it json format
print_r(json_encode($UnPraticien_arr));
?>
