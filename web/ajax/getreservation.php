<?php
include ("config1.php");


$c=new config();
$conn=$c->getConnexion();

$idpromo = $_POST['idpromo'];
$iduser = $_POST['iduser'];
$nbticket = $_POST['nbticket'];
$debut = $_POST['debut'];
$fin = $_POST['fin'];
$keygen= uniqid('GStay');




$stmt = $conn->prepare("INSERT INTO reservation_hotel ( id_user, id_promo, nbticket, checkin , checkout , keygen) VALUES (:iduser,:idpromo,:nbticket,:checkin ,:checkout,:keygen)");
$stmt->bindParam(':iduser', $iduser);
$stmt->bindParam(':idpromo', $idpromo);
$stmt->bindParam(':nbticket', $nbticket);
$stmt->bindParam(':checkin', $debut);
$stmt->bindParam(':checkout', $fin);
$stmt->bindParam(':keygen', $keygen);


$stmt->execute();

$kha = "update promo_hotel set maxplace = maxplace - ".$nbticket."  where promo_hotel.id ='".$idpromo."'";


$khaled  = $conn->prepare($kha);

$khaled->execute();
echo $keygen;
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






