<?php

// ----------------------------------------------------------------------
// Connexion à la base de données
// ----------------------------------------------------------------------

include 'conn.php';

// ----------------------------------------------------------------------
// Lecture des paramètres en entrée
// ----------------------------------------------------------------------

$id_categorie      = $_POST['id_categorie'];

// ----------------------------------------------------------------------
// Initialisation des variables de sortie de la procédure
// ----------------------------------------------------------------------

$select                     = [];
$select["CODE_RETOUR"]      = '';
$select["PARAMETRE"]        = '';
$select["LISTE"]            = NULL;
$select["MESSAGE_RETOUR"]   = '';
$select["COMPTAGE"]         = 0;

$query = "SELECT `id_sous_categorie`, `nom_sous_categorie`, `photo_sous_categorie`, `actif_sous_categorie`, `dt_maj_sous_categorie` FROM `sous_categorie` WHERE `id_categorie`='$id_categorie' ORDER BY `id_categorie`";

try {
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetchAll();
    $select["CODE_RETOUR"]      = 'OK';

    if (count($row) > 0) {
        $select["LISTE"]        = $row;
        $select["COMPTAGE"]     = count($row);
    } else {
        $select["COMPTAGE"]     = 0;
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
