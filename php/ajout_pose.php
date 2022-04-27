<?php

// ----------------------------------------------------------------------
// Connexion à la base de données
// ----------------------------------------------------------------------

include 'conn.php';
 
// ----------------------------------------------------------------------
// Lecture de la date et heure de synchronisation
// ----------------------------------------------------------------------

$id_sous_categorie       = $_POST['id_sous_categorie'];
$id_filtre               = $_POST['id_filtre'];
$nom_filtre              = $_POST['nom_filtre'];
$photo_pose              = $_POST['photo_pose'];

// ----------------------------------------------------------------------
// Initialisation des variables de sortie de la procédure
// ----------------------------------------------------------------------

$select                     = [];
$select["CODE_RETOUR"]      = '';
$select["PARAMETRE"]        = '';
$select["MESSAGE_RETOUR"]   = '';
 
$date_heure_jour = date('Y-m-d H:m:s');

if ($id_filtre === '-1') {
    $query = "INSERT INTO `filtre`( `nom_filtre`, `id_sous_categorie`) VALUES ('$nom_filtre','$id_sous_categorie')";
    try {
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $select["CODE_RETOUR"]      = 'OK';
    } catch (PDOException $e) {
        $select["CODE_RETOUR"]      = 'ERREUR';
        $select["MESSAGE_RETOUR"]   = 'ERREUR DE TRAITEMENT : ' . $query;
    } finally {
        $id_filtre = $dbh->lastInsertId();
    }
}

if ($select["CODE_RETOUR"] != 'ERREUR') {
    $query = "INSERT INTO `pose`( `photo_pose`, `commentaire`, `favori`, `id_filtre`, `id_sous_categorie`, `actif_pose`, `dt_maj_pose`) VALUES ('$photo_pose', '', 0, '$id_filtre', '$id_sous_categorie',1,'$date_heure_jour')";
    try {
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        $select["CODE_RETOUR"]      = 'OK';
    } catch (PDOException $e) {
        $select["CODE_RETOUR"]      = 'ERREUR';
        $select["MESSAGE_RETOUR"]   = 'ERREUR DE TRAITEMENT : ' . $query;
    }  
}

// ------------------------------------------------------------------------------------------------------------------------------
// FIN DU TRAITEMENT
// ------------------------------------------------------------------------------------------------------------------------------

echo json_encode($select);
exit(0);
?>
