<?php
include("conn.php");
session_start();
$loginid=$_SESSION['loginid'];
error_reporting (0);
echo "<table class='ui very basic table'>

<thead>
  <tr>
    <th>Id</th>
    <th>Name</th>
    <th>Amount</th>
    <th>Borrow Date</th>
    <th>Return Date</th>
    <th>More</th>
    <th>Add</th>
  </tr>
</thead>
<tbody>";
  $j=1;
  $query="select loaner.* ,borrow.*,login.* from  loaner,borrow,login where loaner.lid=borrow.lid and borrow.id=login.id and borrow.status='running' and login.id='$loginid'";
  $data=mysqli_query($conn,$query);
  while($result= mysqli_fetch_assoc($data))
   {
    $eid=$result['lid']; 
    $bid=$result['bid'];  
    $date= $result['edat'];
    $today = date("Y/m/d");
    $date1=date_create($date);
    $date2=date_create($today);
    $diff=date_diff($date1,$date2);
    if($diff->format("%R%a days")>=0)
    {

   echo "
  <tr>";
   echo " <td>".$j."</td>";
    echo "<td>".$result['lfname']."   ".$result['llname']."</td>";
    echo "<td>".$result['amount']."</td> ";
    echo " <td>".$result['dat']."</td> ";
    echo "<td>".$result['edat']."</td>";
    echo '<td><button  onclick="window.location.href= \'http://localhost/finance/more.php?bid='.$bid.'\'" class="ui blue button">More</button></td>';
        echo '<td><button  onclick="window.location.href= \'http://localhost/finance/existinsertdata.php?id='.$eid.'\'" class="ui red button">Add New</button></td>'; 
  echo "</tr>";
   }
   $j=$j+1;
}

echo "</tbody>
</table>";
?>
