<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/database.php';
include_once '../objects/collaborateur.php';

$database = new Database();
$db = $database->getConnection();

$collaborateur = new Collaborateur($db);

$stmt = $collaborateur->read();
$num = $stmt->rowCount();

if($num>0){
  $collaborateur_arr=array();
  $collaborateur_arr["collaborateurs"]=array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $collaborateur_item=array(
      "COL_MATRICULE" => $COL_MATRICULE,
      "COL_NOM" => $COL_NOM,
      "COL_DATEEMBAUCHE" => $COL_DATEEMBAUCHE,
      "COL_PRENOM" => $COL_PRENOM,
      "COL_CP" => $COL_CP,
      "COL_ADRESSE" => $COL_ADRESSE,
      "COL_VILLE" => $COL_VILLE,
      "LAB_CHEFVENTE" => $LAB_CHEFVENTE,
      "SEC_LIBELLE" => $SEC_LIBELLE
    );

    array_push($collaborateur_arr["collaborateurs"], $collaborateur_item);
  }

  echo json_encode($collaborateur_arr);
}
else{
  echo json_encode(
    array("message" => "Aucun collaborateurs trouvés.")
  );
}
?>
