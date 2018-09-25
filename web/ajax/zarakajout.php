<?php
include ("config1.php");


$c=new config();
$conn=$c->getConnexion();

$id = $_GET['idcroisiere'];
$nom = $_GET['nom'];
$type = $_GET['type'];
$superficie = $_GET['superficie'];
$maxper = $_GET['maxper'];
$nbr_lit = $_GET['nbr_lit'];
$salle_bain = $_GET['salle_bain'];
$tele = $_GET['tele'];
$mini_bar = $_GET['mini_bar'];
$coffre_fort = $_GET['coffre_fort'];
$clim = $_GET['clim'];
$dressing = $_GET['dressing'];
$prix = $_GET['prix'];


echo $id; echo '<br>'; echo '<br>';
echo $nom;echo '<br>';
echo '<br>';
echo $type;echo '<br>';echo '<br>';
echo $superficie;echo '<br>';echo '<br>';
echo $maxper; echo '<br>';echo '<br>';
echo $nbr_lit; echo '<br>';echo '<br>';
echo $salle_bain; echo '<br>';echo '<br>';
echo $tele; echo '<br>';echo '<br>';
echo $mini_bar; echo '<br>';echo '<br>';
echo $coffre_fort; echo '<br>';echo '<br>';
echo $clim; echo '<br>';echo '<br>';
echo $dressing; echo '<br>';echo '<br>';
echo $prixr; echo '<br>';echo '<br>';


$stmt = $conn->prepare("INSERT INTO cabine ( id_croisiere, nom, type, superficie, maxper,nbr_lit,salle_bain,tele,mini_bar,coffre_fort,clim,dressing,prix) VALUES (:id_croisiere,:nom,:type,:superficie,:maxper,:nbr_lit,:salle_bain,:tele,:mini_bar,:coffre_fort,:clim,:dressing,:prix)");
$stmt->bindParam(':id_croisiere', $id);
$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':type', $type);
$stmt->bindParam(':superficie', $superficie);
$stmt->bindParam(':maxper', $maxper);
$stmt->bindParam(':nbr_lit', $nbr_lit);
$stmt->bindParam(':tele', $tele);
$stmt->bindParam(':mini_bar', $mini_bar);
$stmt->bindParam(':coffre_fort', $coffre_fort);
$stmt->bindParam(':clim', $clim);
$stmt->bindParam(':dressing', $dressing);
$stmt->bindParam(':prix', $prix);
$stmt->bindParam(':salle_bain', $salle_bain);

$stmt->execute();





/*$sql = "DELETE FROM days WHERE id=".$id;
$conn->query($sql);*/
