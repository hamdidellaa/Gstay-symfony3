<?php
include ("config1.php");


$c=new config();
$conn=$c->getConnexion();

$id = $_GET['x'];
$sql = "DELETE FROM days WHERE id=".$id;
$conn->query($sql);












/*
echo '<select id="select" onChange="tabb()" class="form-control">';
foreach ($test as $t ) {
	
echo '<option value='. $t[0].' >'. $t[2] .'</option>';
	
}
echo '</select>';
*/
