<?php
include ("config1.php");


$c=new config();
$conn=$c->getConnexion();

$id = $_GET['id'];
$req="select * from days where id=".$id;

$liste=$conn->query($req);
$test=$liste->fetchAll();


foreach ($test as $t ) {

    echo '
    <input type="text" id="idedit" value="'. $t[0] .'" hidden>
    <input type="text" id="descriptionedit" value="'. $t[2] .'" hidden>
    <input type="text" id="latedit" value="'. $t[4] .'" hidden>
    <input type="text" id="lonedit" value="'. $t[5] .'"hidden >
    <input type="text" id="addressedit" value="'. $t[3] .' "hidden >
    <input type="text" id="nbdayedit" value="'. $t[6] .' "hidden >
    ';}









/*
echo '<select id="select" onChange="tabb()" class="form-control">';
foreach ($test as $t ) {
	
echo '<option value='. $t[0].' >'. $t[2] .'</option>';
	
}
echo '</select>';
*/
