<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/database.php';
include_once '../objects/Rapport_visite.php';

$database = new Database();
$db = $database->getConnection();

$rapportvisite = new Rapport_visite($db);

$stmt = $rapportvisite->read();
$num = $stmt->rowCount();

if($num>0){
  $rapportvisite_arr=array();
  $rapportvisite_arr["Rapport_visite"]=array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $rapportvisite_item=array(
      "COL_MATRICULE" => $COL_MATRICULE,
      "RAP_NUM" => $RAP_NUM,
      "PRA_NUM" => $PRA_NUM,
      "RAP_DATE" => $RAP_DATE,
      "RAP_BILAN" => $RAP_BILAN,
      "MOTIF_LIBELLE" => $MOTIF_LIBELLE
    );

    array_push($rapportvisite_arr["Rapport_visite"], $rapportvisite_item);
  }

  echo json_encode($rapportvisite_arr);
}
else{
  echo json_encode(
    array("message" => "Aucun rapports de visite trouvés.")
  );
}
?>
