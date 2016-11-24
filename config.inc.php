<?php 

 //los atributos de abajo son los que tenemos que modificar
    $username = "u890009820_user"; 
    $password = "s2831994"; 
    $servername = "localhost"; 
    $dbname = "u890009820_dbusr"; 

try {
    	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    	die("OOPs something went wrong");
    }

?>