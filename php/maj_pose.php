<?php

// ----------------------------------------------------------------------
// Connexion à la base de données
// ----------------------------------------------------------------------

include 'conn.php';
 
// ----------------------------------------------------------------------
// Lecture de la date et heure de synchronisation
// ----------------------------------------------------------------------

$id_pose            = $_POST['id_pose'];
$id_filtre          = $_POST['id_filtre'];
$nom_categorie      = $_POST['maj_nom_categorie'];
$photo_pose         = $_POST['maj_photo_pose'];
$photo_pose         = str_replace(' ', '+', $photo_pose);

// ----------------------------------------------------------------------
// Initialisation des variables de sortie de la procédure
// ----------------------------------------------------------------------

$select                     = [];
$select["CODE_RETOUR"]      = '';
$select["PARAMETRE"]        = '';
$select["MESSAGE_RETOUR"]   = '';
 
date_default_timezone_set('Europe/Paris');
$date_heure_jour = date('Y-m-d H:i:s');

$query = "UPDATE `pose` SET `id_filtre`='$id_filtre', `photo_pose`='$photo_pose', `dt_maj_pose`='$date_heure_jour' WHERE `id_pose`=$id_pose";
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
