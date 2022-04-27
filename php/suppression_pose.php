<?php

// ----------------------------------------------------------------------
// Connexion à la base de données
// ----------------------------------------------------------------------

include 'conn.php';
 
// ----------------------------------------------------------------------
// Lecture de la date et heure de synchronisation
// ----------------------------------------------------------------------

$id_pose = $_GET['id_pose'];

// ----------------------------------------------------------------------
// Initialisation des variables de sortie de la procédure
// ----------------------------------------------------------------------

$select                     = [];
$select["CODE_RETOUR"]      = '';
$select["PARAMETRE"]        = 'dthr_synchro:'.$date_heure;
$select["LISTE_CATEGORIES"] = NULL;
$select["MESSAGE_RETOUR"]   = '';
$select["NB_CATEGORIES"]    = 0;

$date_heure_jour = date('Y-m-d H:i:s');

$query = "UPDATE `pose` SET  actif_pose = !actif_pose, `dt_maj_pose` = '$date_heure_jour' WHERE `id_pose` = '$id_pose'";

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
