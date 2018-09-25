<?php
include ("config1.php");


$c=new config();
$conn=$c->getConnexion();

$id = $_GET['id'];

$req="select * from days where id_tour like '".$id."' order by nbday ASC";

$liste=$conn->query($req);
$test=$liste->fetchAll();

echo ' <br> <table border = 1 class="table table-striped" id="tabledays" >
<tr>  
<th width="15%"> Day nb  </th> 
<th width="60%"> Address </th> 

<th width="25%"> action </th> 

</tr> ';
foreach ($test as $t ) {

    echo '
<tr>
<td width="15%">'. $t[6] .'</td>
<td width="60%">'. $t[3] .'</td>

<td width="25%"><button type="button" class="btn btn-primary" onclick="supprimer('.$t[0].','.$t[6].')">delete</button>
 <button type="button" class="btn btn-primary" onclick="edit('.$t[0].')">Edit</button></td>




</tr>';}
echo "</table>" ;








/*
echo '<select id="select" onChange="tabb()" class="form-control">';
foreach ($test as $t ) {

echo '<option value='. $t[0].' >'. $t[2] .'</option>';

}
echo '</select>';
*/
