<!DOCTYPE html>
<html>
<?php
include("conn.php");
session_start();
$loginid=$_SESSION['loginid'];
$str="please login first";
$str1="Unauthorized access";
$redirect_page="http://localhost/finance/index1.php?q=+'$str'";
$redirect_page1="http://localhost/finance/index1.php?q=+'$str1'";
if(strcmp($_SESSION["status"],"true")==0)
{
         
}
else
{
  sleep(1);
header('Location:'.$redirect_page);
}
if(isset($_POST['submit']))
{
    $payingamount=$_POST['payingamount'];
    $bid=$_POST['bid'];
    $remaining=$_POST['remaining'];
    $date=Date("Y-m-d");
    $lid=$_POST['lid'];
    
}
else
{
    sleep(1);
header('Location:'.$redirect_page1);
}
?>
<head>
<title>Payments</title>
</head>
<body>
     <?php
     if ($remaining>$payingamount)
     {
         $query1="insert into transact(lid,bid,id,amount_paid,dat) values ('$lid','$bid','$loginid','$payingamount','$date')";
         $result1=mysqli_query($conn,$query1);
         if($result1)
         {
            $str2="Last transaction was done";
         $redirect_page2="http://localhost/finance/more.php?bid=$bid";
         header('Location:'.$redirect_page2);
         }
         else{
             $tr2="something went wrong,please try again";
             $redirect_page2="http://localhost/finance/more.php?bid=$bid";
             header('Location:'.$redirect_page2);
         }
     }
     else if($remaining=$payingamount){
      $query1="insert into transact(lid,bid,id,amount_paid,dat) values ('$lid','$bid','$loginid','$payingamount','$date')";
      $result1=mysqli_query($conn,$query1);
      $query2="update borrow set status='finished' where bid='$bid'";
      $result2=mysqli_query($conn,$query2);
      if($result1&&$result2)
      {
         $str2="Last transaction was done";
         $redirect_page2="http://localhost/finance/home.php";
         header('Location:'.$redirect_page2);
      }
      else{
          $tr2="something went wrong,please try again";
          $redirect_page2="http://localhost/finance/more.php?bid=$bid";
          header('Location:'.$redirect_page2);
      }
     }
     else
     {
       $str3="something went wrong,please try again";
       $redirect_page3="http://localhost/finance/more.php?bid=$bid";
       header('Location:'.$redirect_page3);
     }
     ?>
</body>
</html>