<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/collaborateur.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$collaborateur = new Collaborateur($db);

// set ID property of product to be edited
$collaborateur->COL_MATRICULE = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of product to be edited
$collaborateur->readOne();

// create array
$collaborateur_arr = array(
    "COL_MATRICULE" =>  $collaborateur->COL_MATRICULE,
    "COL_NOM" => $collaborateur->COL_NOM,
    "COL_DATEEMBAUCHE" => $collaborateur->COL_DATEEMBAUCHE,
    "COL_PRENOM" => $collaborateur->COL_PRENOM,
    "COL_ADRESSE" => $collaborateur->COL_ADRESSE,
    "COL_CP" => $collaborateur->COL_CP,
    "COL_VILLE" => $collaborateur->COL_VILLE,
    "LAB_CHEFVENTE" => $collaborateur->LAB_CHEFVENTE,
    "SEC_LIBELLE" => $collaborateur->SEC_LIBELLE

);

// make it json format
print_r(json_encode($collaborateur_arr));
?>
