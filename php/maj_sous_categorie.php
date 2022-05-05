<?php

// ----------------------------------------------------------------------
// Connexion à la base de données
// ----------------------------------------------------------------------

include 'conn.php';
 
// ----------------------------------------------------------------------
// Lecture de la date et heure de synchronisation
// ----------------------------------------------------------------------

$id_sous_categorie       = $_POST['id_sous_categorie'];
$nom_sous_categorie      = $_POST['nom_sous_categorie'];
$photo_sous_categorie    = $_POST['photo_sous_categorie'];
$photo_sous_categorie    = str_replace(' ', '+', $photo_sous_categorie);

echo $photo_sous_categorie;
// ----------------------------------------------------------------------
// Initialisation des variables de sortie de la procédure
// ----------------------------------------------------------------------

$select                     = [];
$select["CODE_RETOUR"]      = '';
$select["PARAMETRE"]        = '';
$select["MESSAGE_RETOUR"]   = '';
 
date_default_timezone_set('Europe/Paris');
$date_heure_jour = date('Y-m-d H:i:s');

$query = "UPDATE `sous_categorie` SET `nom_sous_categorie`='$nom_sous_categorie', `photo_sous_categorie`='$photo_sous_categorie', `dt_maj_sous_categorie`='$date_heure_jour' WHERE `id_sous_categorie`=$id_sous_categorie";
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
