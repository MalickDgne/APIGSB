<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/database.php';
include_once '../objects/medicament.php';

$database = new Database();
$db = $database->getConnection();

$medicaments = new Medicament($db);

$stmt = $medicaments->read();
$num = $stmt->rowCount();

if($num>0){
  $medicaments_arr=array();
  $medicaments_arr["medicaments"]=array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $medicaments_item=array(
      "MED_NOMCOMMERCIAL" => $MED_NOMCOMMERCIAL,
      "FAM_CODE" => $FAM_CODE,
      "MED_COMPOSITION" => $MED_COMPOSITION,
      "MED_EFFETS" => $MED_EFFETS,
      "MED_CONTREINDIC" => $MED_CONTREINDIC,
      "MED_PRIXECHANTILLON" => $MED_PRIXECHANTILLON,
      "MED_DEPOTLEGAL" => $MED_DEPOTLEGAL
    );

    array_push($medicaments_arr["medicaments"], $medicaments_item);
  }

  echo json_encode($medicaments_arr);
}
else{
  echo json_encode(
    array("message" => "Aucun medicaments trouvés.")
  );
}
?>
