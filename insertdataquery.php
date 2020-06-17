<?php
 include("conn.php");
 error_reporting(0);
 session_start();
$loginid=$_SESSION['loginid'];
$llname=$_POST['llanme'];
$pno=$_POST['pno'];
$email=$_POST['email'];
$address=$_POST['address'];
$aid=$_POST['aid'];
$amount=$_POST['amount'];
$dat=$_POST['dat'];
$edat=$_POST['edat'];
$interest=$_POST['interest'];
$query="insert into loaner(llname,pno,email,address,aid) values ('$llname','$pno','$email','$address','$aid')";
$result=mysqli_query($conn,$query);
echo $result;

if($result)
{ 
    $query2="select * from loaner where email='$email'";
    $data=mysqli_query($conn,$query2);
    $result2=mysqli_fetch_assoc($data);
    $lid=$result2['lid'];
    $query3="insert into borrow(id,lid,amount,dat,interest,edat,status) values('$loginid','$lid','$amount','$dat','$interest','$edat','running')";
    $result1=mysqli_query($conn,$query3);
    echo $result1;
    
    if($result1)
    {
        $redirect1_page="http://localhost/finance/home.php";
        header('Location:'.$redirect1_page);
    }
    else{
        $redirect1_page="http://localhost/finance/insertdata.php";
        header('Location:'.$redirect1_page);
    }


}
else
{
    $redirect1_page="http://localhost/finance/insertdata.php";
    header('Location:'.$redirect1_page);
}
?>