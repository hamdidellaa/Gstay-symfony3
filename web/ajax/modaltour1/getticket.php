<?php
include ("../config1.php");


$c=new config();
$conn=$c->getConnexion();

$idtour = $_POST['idtour'];
$iduser = $_POST['iduser'];
$nbticket = $_POST['nbticket'];
$message = uniqid("GstayCruise");





$stmt = $conn->prepare("INSERT INTO reservation ( id_user, id_cabine, nbr_cabine, keyy) VALUES (:iduser,:idtour,:nbticket,:message)");
$stmt->bindParam(':iduser', $iduser);
$stmt->bindParam(':idtour', $idtour);
$stmt->bindParam(':nbticket', $nbticket);
$stmt->bindParam(':message', $message);


$stmt->execute();

$dell = "update cabine set quantite = quantite - ".$nbticket."  where cabine.id ='".$idtour."'";


$dellaa  = $conn->prepare($dell);

$dellaa->execute();
echo $message;
/*
$req="select maxplace from tour where id like '".$idtour."'";

$liste=$conn->query($req);
$test=$liste->fetchAll();
foreach ( $test as $t)
{
    if($nb > $t[0])
    {
        echo " you can t get more than ".$t[0]." tickets ";
    }

}


*/






