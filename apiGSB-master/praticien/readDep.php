<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/database.php';
include_once '../objects/praticien.php';

$database = new Database();
$db = $database->getConnection();

$DepPraticien = new Praticien($db);

$stmt = $DepPraticien->readDep();
$num = $stmt->rowCount();

if($num>0){
  $DepPraticien_arr=array();
  $DepPraticien_arr["departement_praticien"]=array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $DepPraticien_item=array(
      "dep" => $dep
    );

    array_push($DepPraticien_arr["departement_praticien"], $DepPraticien_item);
  }

  echo json_encode($DepPraticien_arr);
}
else{
  echo json_encode(
    array("message" => "Aucun departement de praticiens trouvés.")
  );
}
?>
