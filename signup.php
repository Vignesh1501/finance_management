<?php
    include 'conn.php';
    error_reporting(0);
    $str="Account created succesfully";
    $str1="Account creation failed";
    $str2="account already exists!please login";
        $username=$_POST['username'];
        $email=$_POST['email'];
        $query1="select * from login where email=?";
        $stmt1=mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt1,$query1);
        mysqli_stmt_bind_param($stmt1,"s",$email);
        mysqli_stmt_execute($stmt1);
        $result1=mysqli_stmt_get_result($stmt1);
        $count=mysqli_fetch_assoc($result1);
    
        if($count['email']==$email)
        {
            header("location:http://localhost/finance/index1.php?q=+$str2");
               
        }
        
        else{
        $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
        $query="insert into login(username,pass,email)  values (?,?,?)";
        $stmt=mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$query);
        mysqli_stmt_bind_param($stmt,"sss",$username,$password,$email);
        $result=mysqli_stmt_execute($stmt);
        echo $result;
        if($result=="true")
        {

            header("location:http://localhost/finance/index1.php?q=+$str");
        }
        else{
           header("location:http://localhost/finance/index1.php?q=+$str1");
        }
        }   
    



    ?>