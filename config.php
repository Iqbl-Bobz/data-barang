<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'dbbarang';

$conn = new mysqli ($hostname, $username, $password, $database);

if(!$conn){
    die ("error" .mysqli_connect_error());
}

#echo "berhasil";

?>