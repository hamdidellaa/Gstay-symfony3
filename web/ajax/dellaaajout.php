<?php
include ("config1.php");


$c=new config();
$conn=$c->getConnexion();

$id = $_GET['idtour'];
$long = $_GET['long'];
$lat = $_GET['lat'];
$address = $_GET['address'];
$description = $_GET['description'];
$nbday = $_GET['nbday'];


echo $id; echo '<br>'; echo '<br>';
echo $long;echo '<br>';
echo '<br>';
echo $lat;echo '<br>';echo '<br>';
echo $address;echo '<br>';echo '<br>';
echo $description; echo '<br>';echo '<br>';


$stmt = $conn->prepare("INSERT INTO days ( id_tour, description, address, latitude, longitude,nbday) VALUES (:id_tour,:description,:address,:latitude,:longitude,:nbday)");
$stmt->bindParam(':id_tour', $id);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':address', $address);
$stmt->bindParam(':latitude', $lat);
$stmt->bindParam(':longitude', $long);
$stmt->bindParam(':nbday', $nbday);

$stmt->execute();





/*$sql = "DELETE FROM days WHERE id=".$id;
$conn->query($sql);*/
