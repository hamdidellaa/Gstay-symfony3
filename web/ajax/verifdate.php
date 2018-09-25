<?php
include ("config1.php");


$c=new config();
$conn=$c->getConnexion();


$nom = $_GET['nom'];
$dateverif = $_GET['date'];

$req="select id from navire where nom like'".$nom."'"  ;

$liste=$conn->query($req);
$test=$liste->fetchAll();
foreach ( $test as $t)
{
    $nomm=$t[0];

}


$req1="SELECT DATEDIFF( '".$dateverif."', date_arr ) from croisiere where id_navire =".$nomm  ;

$liste1=$conn->query($req1);
$test1=$liste1->fetchAll();


foreach ( $test1 as $t)
{
    $diff=$t[0];

}




if ($diff < 7)
{
	echo "non";
}