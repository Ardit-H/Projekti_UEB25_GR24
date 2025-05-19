<?php
 
 $servername="127.0.0.1";
 $username="root";
 $password="";
 $dbname="projekti";

 $conn=mysqli_connect($servername,$username,$password,$dbname);

 if(!$conn){
    echo "Error";
 }
 else{
    echo "connected with db server";
 }
?>