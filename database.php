<?php
 include('php/handle_create_tables.php');
 $servername="127.0.0.1";
 $username="root";
 $password="";
 $dbname="projekti";

 $conn=mysqli_connect($servername,$username,$password,$dbname);
    //createTables($conn);

 if(!$conn){
    echo "Error";
 }
 else{
 }
?>
