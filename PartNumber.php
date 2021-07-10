<?php
// $q = intval($_GET['q']);

// require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

// if(isset($_GET)){

// $con = mysqli_connect('localhost','nombre BD','clave bd','usuario bd');
// if (!$con) {
//   die('Could not connect: ' . mysqli_error($con));
// }

// mysqli_select_db($con,"ajax_example");

 
		$sql="SELECT * FROM cad_table ORDER BY id DESC LIMIT 1";
 

//echo $sql;
$result = mysqli_query($db,$sql);

  
while($row = mysqli_fetch_array($result)) {
    echo "Nombre tabla:" . $row['partid'] ;
   
}

mysqli_close($db);
//mysqli_close($con);

//}
?>