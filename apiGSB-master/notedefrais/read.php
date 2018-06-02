<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/database.php';
include_once '../objects/notedefrais.php';

$database = new Database();
$db = $database->getConnection();

$notedefrais = new notedefrais($db);

$stmt = $notedefrais->read();
$num = $stmt->rowCount();

if($num>0){
  $notedefrais_arr=array();
  $notedefrais_arr["notedefrais"]=array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $notedefrais_item=array(
      "PRA_NOM" => $PRA_NOM,
      "dateVisite" => $dateVisite,
      "MontantRepasMidi" => $MontantRepasMidi,
      "MontantRepasSoir" => $MontantRepasSoir,
      "PrixNuit" => $PrixNuit,
      "MontantTotalHF" => $MontantTotalHF,
      "NbJustificatif" => $NbJustificatif,
      "MontantTotal" => $MontantTotal,
    );

    array_push($notedefrais_arr["notedefrais"], $notedefrais_item);
  }

  echo json_encode($notedefrais_arr);
}
else{
  echo json_encode(
    array("message" => "Aucun rapports de visite trouvés.")
  );
}
?>
