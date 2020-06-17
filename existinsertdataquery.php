<?php
if(isset($_POST['submit']))
{
    include("conn.php");
 error_reporting(0);
 session_start();
$loginid=$_SESSION['loginid'];
$lid=$_POST['lid'];
$amount=$_POST['amount'];
$dat=$_POST['dat'];
$edat=$_POST['edat'];
$interest=$_POST['interest'];
$query="insert into borrow(id,lid,amount,dat,interest,edat,status) values('$loginid','$lid','$amount','$dat','$interest','$edat','running')";
$data=mysqli_query($conn,$query);

if($data)
{
	$redirect1_page="http://localhost/finance/home.php";
    header('Location:'.$redirect1_page);
}
else
{
	$redirect1_page="http://localhost/finance/existinsertdata.php?id='$lid'";
    header('Location:'.$redirect1_page);
}

}
 
?>