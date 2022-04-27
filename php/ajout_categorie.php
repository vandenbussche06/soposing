<?php

// ----------------------------------------------------------------------
// Connexion à la base de données
// ----------------------------------------------------------------------

include 'conn.php';
 
// ----------------------------------------------------------------------
// Lecture de la date et heure de synchronisation
// ----------------------------------------------------------------------

$nom_categorie      = $_POST['nom_categorie'];
$photo_categorie    = $_POST['photo_categorie'];

// ----------------------------------------------------------------------
// Initialisation des variables de sortie de la procédure
// ----------------------------------------------------------------------

$select                     = [];
$select["CODE_RETOUR"]      = '';
$select["PARAMETRE"]        = '';
$select["MESSAGE_RETOUR"]   = '';
 
$date_heure_jour = date('Y-m-d H:m:s');

$query = "INSERT INTO categorie( nom_categorie, photo_categorie, dt_maj_categorie) VALUES ('$nom_categorie','$photo_categorie','$date_heure_jour')";
 
try {
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $select["CODE_RETOUR"]      = 'OK';
} catch (PDOException $e) {
    $select["CODE_RETOUR"]      = 'ERREUR';
    $select["MESSAGE_RETOUR"]   = 'ERREUR DE TRAITEMENT : ' . $query;
} finally {

}
 
// ------------------------------------------------------------------------------------------------------------------------------
// FIN DU TRAITEMENT
// ------------------------------------------------------------------------------------------------------------------------------

echo json_encode($select);
exit(0);
?>
