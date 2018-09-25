<?php
include ("config1.php");


$c=new config();
$conn=$c->getConnexion();

$nb = $_GET['nb'];
$idpromo = $_GET['idpromo'];

$req="select maxplace from promo_hotel where id = '".$idpromo."'";

$liste=$conn->query($req);
$test=$liste->fetchAll();
foreach ( $test as $t)
{
    if($nb > $t[0])
    {
        echo " you can t get more than ".$t[0]." tickets ";
    }

}









