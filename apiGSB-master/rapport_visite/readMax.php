<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/database.php';
include_once '../objects/Rapport_visite.php';

$database = new Database();
$db = $database->getConnection();

$rapportvisite = new Rapport_visite($db);

$stmt = $rapportvisite->readMax();
$num = $stmt->rowCount();

if($num>0){
  $rapportvisite_arr=array();
  $rapportvisite_arr["Max_rapport"]=array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $rapportvisite_item=array(
      "MAX" => $MAX
    );

    array_push($rapportvisite_arr["Max_rapport"], $rapportvisite_item);
  }

  echo json_encode($rapportvisite_arr);
}
else{
  echo json_encode(
    array("message" => "Impossible de calculer le nombre de rapports.")
  );
}
?>
