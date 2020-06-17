<?php
    $dbname="finance";
    $servername="localhost";
    $username="root";
    $password="";
    $conn=mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn)
    {
             echo "connection to database failed";
    }

?>