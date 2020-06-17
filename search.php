<?php
    include("conn.php");
    error_reporting (0); 
    $name=$_GET['q'];
    echo "<table class='ui very basic table'>
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Amount</th>
        <th>Date</th>
        <th>More</th>
        <th>Add</th>
      </tr>
    </thead>
    <tbody>
    ";
    $query="select login.*,borrow.*,loaner.* from  loaner,borrow,login where loaner.lid=borrow.lid and borrow.id=login.id and borrow.status='running' and loaner.llname like '%$name%'  ";
    $data=mysqli_query($conn,$query);
    $j=1;
    while($result= mysqli_fetch_assoc($data))
       {
          $eid=$result['id'];  
          $bid=$result['bid'];   

       echo "
      <tr>";
       echo " <td>".$j."</td>";
        echo "<td>".$result['lfname']."   ".$result['llname']."</td>";
        echo "<td>".$result['amount']."</td> ";
        echo " <td>".$result['dat']."</td> ";
        echo '<td><button  onclick="window.location.href= \'http://localhost/finance/more.php?bid='.$bid.'\'" class="ui blue button">More</button></td>';
        echo '<td><button  onclick="window.location.href= \'http://localhost/finance/existinsertdata.php?id='.$eid.'\'" class="ui red button">Add New</button></td>'; 
      echo "</tr> ";
      $j=$j+1;
       }
       echo "</tbody> </table>";
    

?>