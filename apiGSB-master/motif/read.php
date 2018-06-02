<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/database.php';
include_once '../objects/motif.php';

$database = new Database();
$db = $database->getConnection();

$motif = new Motif($db);

$stmt = $motif->read();
$num = $stmt->rowCount();

if($num>0){
  $motif_arr=array();
  $motif_arr["motifs"]=array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $motif_item=array(
      "MOTIF_CODE" => $MOTIF_CODE,
      "MOTIF_LIBELLE" => $MOTIF_LIBELLE
    );

    array_push($motif_arr["motifs"], $motif_item);
  }

  echo json_encode($motif_arr);
}
else{
  echo json_encode(
    array("message" => "Aucun praticiens trouvés.")
  );
}
?>
