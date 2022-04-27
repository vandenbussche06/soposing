<?php

// ----------------------------------------------------------------------
// Connexion à la base de données
// ----------------------------------------------------------------------

include 'conn.php';
 
// ----------------------------------------------------------------------
// Lecture de la date et heure de synchronisation
// ----------------------------------------------------------------------

$id_sous_categorie = $_POST['id_sous_categorie'];

// ----------------------------------------------------------------------
// Initialisation des variables de sortie de la procédure
// ----------------------------------------------------------------------

$select                     = [];
$select["CODE_RETOUR"]      = '';
$select["PARAMETRE"]        = 'id_sous_categorie:'.$id_sous_categorie;
$select["LISTE"]            = NULL;
$select["MESSAGE_RETOUR"]   = '';
$select["NB_RECORD"]        = 0;

$query = "SELECT `id_filtre`, `nom_filtre`, `id_sous_categorie` FROM `filtre` WHERE `id_sous_categorie`='$id_sous_categorie'";


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
} finally {

}
 
// ------------------------------------------------------------------------------------------------------------------------------
// FIN DU TRAITEMENT
// ------------------------------------------------------------------------------------------------------------------------------

echo json_encode($select);
exit(0);
?>
