<?php
	// $servername = "localhost";
	// $username = "root";
	// $password = "Pass@123";
	// $dbname = "test";

	// $servername = "localhost";
	// $username = "id17280554_a3harva";
	// $password = "Pass@12345678910";
	// $dbname = "id17280554_bankingdatabase";




	// $servername = "remotemysql.com";
	// $username = "e9IpnahYdV";
	// $password = "K9nZR8KZ1v";
	// $dbname = "e9IpnahYdV";
    

	define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "id17280554_bankingdatabase");

$conn = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);








	//$conn = mysqli_connect($servername, $username, $password, $dbname);

	if(!$conn){
		die(`Could not connect !!!! BRO THE ERRORs IS/ARE ${dbname}:--> `.mysqli_connect_error());
	}

?>  