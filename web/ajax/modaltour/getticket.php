<?php
include ("../config1.php");


$c=new config();
$conn=$c->getConnexion();
if(isset($_POST['idtour']))
{
$idtour = $_POST['idtour'];
$iduser = $_POST['iduser'];
$nbticket = $_POST['nbticket'];
$message = $_POST['message'];

    $refticket = uniqid("Gstay ");

    $stmt = $conn->prepare("INSERT INTO ticketevent ( iduser, idtour, nbticket, message,refticket) VALUES (:iduser,:idtour,:nbticket,:message,:refticket)");
    $stmt->bindParam(':iduser', $iduser);
    $stmt->bindParam(':idtour', $idtour);
    $stmt->bindParam(':nbticket', $nbticket);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':refticket', $refticket);

    $stmt->execute();

    $dell = "update tour set maxplace = maxplace - ".$nbticket."  where tour.id ='".$idtour."'";
    $dell1 = "update tour set ticketvendu = ticketvendu + ".$nbticket."  where tour.id ='".$idtour."'";


    $dellaa  = $conn->prepare($dell);

    $dellaa->execute();
    $dellaa1  = $conn->prepare($dell1);
    $dellaa1->execute();

}


if(isset($_POST['idevent']))
{
    $idevent = $_POST['idevent'];
    $iduser = $_POST['iduser'];
    $nbticket = $_POST['nbticket'];
    $refticket = uniqid("Gstay ");





    $stmt = $conn->prepare("INSERT INTO ticketevent ( iduser, idevent, nbticket,refticket) VALUES (:iduser,:idevent,:nbticket,:refticket)");
    $stmt->bindParam(':iduser', $iduser);
    $stmt->bindParam(':idevent', $idevent);
    $stmt->bindParam(':nbticket', $nbticket);

    $stmt->bindParam(':refticket', $refticket);


    $stmt->execute();

    $dell = "update evenement set nb_ticket = nb_ticket - ".$nbticket."  where evenement.id =".$idevent;
    $dell1 = "update evenement set ticketvendu = ticketvendu + ".$nbticket."  where evenement.id =".$idevent;

    $dellaa  = $conn->prepare($dell);

    $dellaa->execute();
    $dellaa1  = $conn->prepare($dell1);
    $dellaa1->execute();


}

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






