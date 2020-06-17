<?php
session_start();
include("conn.php");
$loginid=$_SESSION['loginid'];
$str="please login first";
$redirect_page="http://localhost/finance/index1.php?q=+'$str'";
if(strcmp($_SESSION["status"],"true")==0)
{

}
else
{
  sleep(1);
header('Location:'.$redirect_page);
}
   $bid=$_GET['q'];
   $j=1;
   $query="select * from transact where bid=$bid and id=$loginid";
   $result=mysqli_query($conn,$query);
   if(mysqli_num_rows($result)==0)
       {
           echo "<h1>no transactions done till date</hi>";
       }
       else
       {
           echo "<table class='ui inverted blue table'>
            <thead>
              <tr><th>Id</th>
              <th>Amount Paid</th>
              <th>Date</th>
 </tr></thead>
   <tbody>";
  
   while($data=mysqli_fetch_assoc($result))
   {
       
        echo " <tr>";
     echo "<td>".$j."</td>";
     $j=$j+1;
     echo "<td>".$data['amount_paid']."</td>";
     echo "<td>".$data['dat']."</td>";
    echo " </tr>";
   }
 
  echo "</tbody>";
  echo "</table>";
       }
   
 ?>

