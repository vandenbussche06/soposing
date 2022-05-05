<?php

// ----------------------------------------------------------------------
// Connexion à la base de données
// ----------------------------------------------------------------------

include 'conn.php';
 
// ----------------------------------------------------------------------
// Lecture de la date et heure de synchronisation
// ----------------------------------------------------------------------

$id_categorie       = $_POST['id_categorie'];
$nom_categorie      = $_POST['maj_nom_categorie'];
$photo_categorie    = $_POST['maj_photo_categorie'];
$photo_categorie    = str_replace(' ', '+', $photo_categorie);

// ----------------------------------------------------------------------
// Initialisation des variables de sortie de la procédure
// ----------------------------------------------------------------------

$select                     = [];
$select["CODE_RETOUR"]      = '';
$select["PARAMETRE"]        = '';
$select["MESSAGE_RETOUR"]   = '';

date_default_timezone_set('Europe/Paris');
$date_heure_jour = date('Y-m-d H:i:s');

$query = "UPDATE `categorie` SET `nom_categorie`='$nom_categorie',`photo_categorie`='$photo_categorie',`dt_maj_categorie`='$date_heure_jour' WHERE `id_categorie`=$id_categorie";
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
