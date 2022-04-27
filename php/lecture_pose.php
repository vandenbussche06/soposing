<?php

// ----------------------------------------------------------------------
// Connexion à la base de données
// ----------------------------------------------------------------------

include 'conn.php';
 
// ----------------------------------------------------------------------
// Lecture de la date et heure de synchronisation
// ----------------------------------------------------------------------

$date_heure = $_GET['dthr_synchro'];

// ----------------------------------------------------------------------
// Initialisation des variables de sortie de la procédure
// ----------------------------------------------------------------------

$select                          = [];
$select["CODE_RETOUR"]           = '';
$select["PARAMETRE"]             = '';
$select["LISTE_SOUS_CATEGORIES"] = NULL;
$select["MESSAGE_RETOUR"]        = '';
$select["NB_RECORD"]    = 0;

$query = "SELECT `id_pose`, `photo_pose`, `commentaire`, `favori`, `id_filtre`, `id_sous_categorie` FROM `pose` LIMIT 10";
 
try {
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetchAll();
    $select["CODE_RETOUR"]      = 'OK';

    if (count($row) > 0) {
        $select["LISTE"] = $row;
        $select["NB_RECORD"]    = count($row);
    } else {
        $select["NB_RECORD"]    = 0;
    }

} catch (PDOException $e) {
    $select["CODE_RETOUR"]      = 'ERREUR';
    $select["MESSAGE_RETOUR"]   = 'ERREUR DE TRAITEMENT : ' . $query;
}
 
// ------------------------------------------------------------------------------------------------------------------------------
// FIN DU TRAITEMENT
// ------------------------------------------------------------------------------------------------------------------------------

echo json_encode($select);
exit(0);
?>
