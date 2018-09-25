<?php
include ("config1.php");


$c=new config();
$conn=$c->getConnexion();
$name = $_GET['x'];
$req="select * from days where id like '$name' ";
$liste=$conn->query($req);
$test=$liste->fetchAll();
echo ' <br> <table border = 1 class="table table-striped" >
<tr>  
<th> id </th>
<th> name </th> 
<th> firstname </th> 
<th> action </th> 

</tr> ';
foreach ($test as $t ) {
	
echo '
<tr>
<td>'. $t[0] .'</td>
<td>'. $t[1] .'</td>
<td>'. $t[2] .'</td>
<td><button type="button" class="btn btn-primary" onclick="supprimer('.$t[0].')">delete</button></td>




</tr>
</table>
';


}


