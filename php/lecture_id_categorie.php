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
$select["PARAMETRE"]        = 'id_categorie:'.$id_categorie;
$select["LISTE"] = NULL;
$select["MESSAGE_RETOUR"]   = '';
$select["NB_CATEGORIES"]    = 0;

$query = "SELECT `id_categorie`, `nom_categorie`, `actif_categorie`, `dt_maj_categorie`, `photo_categorie`  FROM `categorie` WHERE  `id_categorie` = '$id_categorie'";

try {
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetchAll();
    $select["CODE_RETOUR"]      = 'OK';

    if (count($row) > 0) {
        $select["LISTE"] = $row;
        $select["NB_CATEGORIES"]    = count($row);
    } else {
        $select["NB_CATEGORIES"]    = 0;
    }

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
