<?php 
	date_default_timezone_set('America/Lima');
$username="root";
$password="";
$host="localhost";
$database="atmeccom_db2";
$db_link=mysqli_connect($host,$username,$password,$database)or die("ERROR".mysqli_error($db_link));

if (mysqli_connect_error()){
	echo "Could not connect to MySql. Please try again";
	exit();
} else {
    //echo 'exitoso';
}

if (!mysqli_set_charset($db_link, "utf8")) {
    exit();
} else {
 
}




?>
