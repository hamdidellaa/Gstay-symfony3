<?php
include ("../config1.php");


$c=new config();
$conn=$c->getConnexion();

$nb = $_GET['nb'];
$idtour = $_GET['idtour'];


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









