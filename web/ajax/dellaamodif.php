<?php
include ("config1.php");


$c=new config();
$conn=$c->getConnexion();

$id = $_GET['idtour'];
$long = $_GET['long'];
$lat = $_GET['lat'];
$address = $_GET['address'];
$description = $_GET['description'];

$idday = $_GET['idday'];
/*
echo $idday; echo '<br>'; echo '<br>';
echo $long;echo '<br>';
echo '<br>';
echo $lat;echo '<br>';echo '<br>';
echo $address;echo '<br>';echo '<br>';
echo $description; echo '<br>';echo '<br>';*/

$src = "update days  set  description='".$description."', address ='".$address."' , latitude='$lat',longitude='$long' where id='$idday'";

$stmt = $conn->prepare($src);

$stmt->execute();





/*$sql = "DELETE FROM days WHERE id=".$id;
$conn->query($sql);*/
