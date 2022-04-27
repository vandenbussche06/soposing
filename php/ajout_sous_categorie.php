<?php

// ----------------------------------------------------------------------
// Connexion à la base de données
// ----------------------------------------------------------------------

include 'conn.php';
 
// ----------------------------------------------------------------------
// Lecture de la date et heure de synchronisation
// ----------------------------------------------------------------------

$id_categorie            = $_POST['id_categorie'];
$nom_sous_categorie      = $_POST['nom_sous_categorie'];
$photo_sous_categorie    = $_POST['photo_sous_categorie'];
$photo_sous_categorie    = str_replace(' ', '+', $photo_sous_categorie);

// ----------------------------------------------------------------------
// Initialisation des variables de sortie de la procédure
// ----------------------------------------------------------------------

$select                     = [];
$select["CODE_RETOUR"]      = '';
$select["PARAMETRE"]        = '';
$select["MESSAGE_RETOUR"]   = '';
 
$date_heure_jour = date('Y-m-d H:m:s');
$query = "INSERT INTO `sous_categorie`( `nom_sous_categorie`, `photo_sous_categorie`, `id_categorie`, `actif_sous_categorie`, `dt_maj_sous_categorie`) VALUES ('$nom_sous_categorie', '$photo_sous_categorie', '$id_categorie', 0, '$date_heure_jour')";
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
