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


if(isset($_POST['ideventuser']))
{
    $idevent = $_POST['ideventuser'];
    $iduser = $_POST['iduser'];

    $message = $_POST['messageuser'];






    $stmt = $conn->prepare("INSERT INTO message ( iduser, idevent, message) VALUES (:iduser,:idevent,:message)");
    $stmt->bindParam(':iduser', $iduser);
    $stmt->bindParam(':idevent', $idevent);

    $stmt->bindParam(':message', $message);



    $stmt->execute();



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






