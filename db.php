<?php
$con=mysqli_connect('localhost','root','root','db_schoolbook');
if(!$con){
	die('erreur de connexion a la base de donnée');
}else{
	}


 $pdo= new PDO('mysql:dbname=db_schoolbook;host=localhost','root','');

   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
