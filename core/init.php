<?php

//en hstech:

//local:
 $db = mysqli_connect('127.0.0.1', 'root', '', 'cad_database');


if(mysqli_connect_error()) {
	echo 'Database connection failed with following errors: '.mysqli_connect_error();
	die();
} 
//else
//	{echo 'todo bien';}

//$fn = explode(' ',$user_data['full_name']);   //se crea un array 'fn' 

//$user_data['first']=$fn[0];       

// if(isset($user_data['last'])){ $user_data['last']=$fn[1]; } else { $user_data['last']=''; }

//$user_data['last']=$fn[1];




