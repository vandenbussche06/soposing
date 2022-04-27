<?php

// ----------------------------------------------------------------------
// Connexion à la base de données
// ----------------------------------------------------------------------

include 'conn.php';
 
// ----------------------------------------------------------------------
// Lecture de la date et heure de synchronisation
// ----------------------------------------------------------------------

$id_categorie = $_GET['id_categorie'];

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

$query = "UPDATE `categorie` SET  actif_categorie = !actif_categorie, `dt_maj_categorie` = '$date_heure_jour' WHERE `id_categorie` = '$id_categorie'";

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
