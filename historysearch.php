<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
    include("conn.php");
    error_reporting (0); 
    $name=$_GET['q'];
    echo "<table class='ui selectable inverted table'>
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Amount</th>
        <th>Borrow Date</th>
        <th>Status</th>
        <th>View Transactions</th>
      </tr>
    </thead>
    <tbody>
    ";
    $query="select login.*,borrow.*,loaner.* from  loaner,borrow,login where loaner.lid=borrow.lid and borrow.id=login.id and loaner.llname like '%$name%' order by borrow.dat ";
    $data=mysqli_query($conn,$query);
    $j=1;
    while($result= mysqli_fetch_assoc($data))
       {
          $eid=$result['id'];  
          $bid=$result['bid'];    
       echo "<tr>";
       echo " <td>".$j."</td>";
       $j=$j+1;
        echo "<td>".$result['lfname']."   ".$result['llname']."</td>";
        echo "<td>".$result['amount']."</td> ";
        echo " <td>".$result['dat']."</td> ";
        echo "<td>".$result['status']."</td>";
        echo   '<td><button onclick="view('.$bid.')" class="ui blue button">View Transactions</button></td>'; 
      echo "</tr> ";
       }
       echo "</tbody> </table>";
?>
</body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
<script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
<script>
function view(bid)
{
  
  //bid=document.getElementById('bidvalue').value;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('transactions').innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "http://localhost/finance/transactions.php?q="+bid, true);
  xhttp.send();
}
</script>
</html>