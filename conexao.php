<?php
 $host = "localhost";
 $user = "root";
 $pass = "";
 $dbname = "mercearia";

 $conn = new mysqli ($host, $user, $pass, $dbname);

 if ($conn->connect_error) {
    die ("Falha na conexão: " . $conn->connect_error);
 }
 ?>