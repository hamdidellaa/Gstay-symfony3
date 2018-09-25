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

$idc = $_GET['idc'];

/*
echo $idday; echo '<br>'; echo '<br>';
echo $long;echo '<br>';
echo '<br>';
echo $lat;echo '<br>';echo '<br>';
echo $address;echo '<br>';echo '<br>';
echo $description; echo '<br>';echo '<br>';*/

$src = "update cabine  set  nom='".$nom."', type ='".$type."' where id='$idday'";

$stmt = $conn->prepare($src);

$stmt->execute();





/*$sql = "DELETE FROM days WHERE id=".$id;
$conn->query($sql);*/
