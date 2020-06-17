<?php
    include 'conn.php';
    error_reporting(0);
    
   
    
        $username=$_POST['username'];
        $password=$_POST['password'];
        $query="select * from login where (username=? or email=?);";
        $stmt=mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$query);
        mysqli_stmt_bind_param($stmt,"ss",$username,$username);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        $row=mysqli_fetch_assoc($result);
        $verify=password_verify($password,$row['pass']);
       
        if($verify=="true")
        {
            sleep(1);
           session_start();
           $_SESSION["status"]= "true";
           $_SESSION['loginid']=$row['id'];
           header("location:http://localhost/finance/home.php");
        }
        else{
            $str="Entered wrong credentails";
            header("location:http://localhost/finance/index1.php?q=+$str");

        }


?>