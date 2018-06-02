<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/database.php';
include_once '../objects/praticien.php';

$database = new Database();
$db = $database->getConnection();

$praticien = new Praticien($db);

$stmt = $praticien->read();
$num = $stmt->rowCount();

if($num>0){
  $praticien_arr=array();
  $praticien_arr["praticiens"]=array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $praticien_item=array(
      "PRA_NUM" => $PRA_NUM,
      "PRA_NOM" => $PRA_NOM,
      "PRA_PRENOM" => $PRA_PRENOM,
      "PRA_CP" => $PRA_CP,
      "PRA_ADRESSE" => $PRA_ADRESSE,
      "PRA_VILLE" => $PRA_VILLE,
      "PRA_COEFNOTORIETE" => $PRA_COEFNOTORIETE,
      "dep" => $dep,
      "TYP_LIEU" => $TYP_LIEU
    );

    array_push($praticien_arr["praticiens"], $praticien_item);
  }

  echo json_encode($praticien_arr);
}
else{
  echo json_encode(
    array("message" => "Aucun praticiens trouvés.")
  );
}
?>
