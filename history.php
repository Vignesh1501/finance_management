<html>
<?php
session_start();
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
?>

<head>
<style>
.inner1cont2
{
  display:flex;
  
  justify-content:flex-start;
  flex-direction:column;
}
.inner1inner1cont2
{
      margin-left:50%;
}
.inner2inner1cont2
{
     margin-left:20px;
     margin-right:20px;
}
.cont2
{
  display:flex;
  
}

.inner1cont2
{
  flex:2;
  order:2;
  
}
.inner2cont2{
  flex:3;
  order:1;
  margin-left:20px;
  
 /*border:2px #ccc solid
*/

}
.container
{
display:flex;
flex-direction: column;
}
.cont1
{
flex:1;
}
.cont2
{
flex:5;

}

</style>
<title>History</title>
</head>
<body>
<div class="container">

<div class="cont1">
  <div class="ui menu">
    <a class="item" href="http://localhost/finance/home.php">Home</a>
    <a class="item" href="http://localhost/finance/stats.php">Stats</a>
    <div class="right menu">
     
      <a class="item  " href="http://localhost/finance/logout.php">Logout</a>
    </div>
  </div>
   
</div>
<br>
<br>
<div class="cont2">
  <div class="inner1cont2">
   <div class="inner1inner1cont2">
    <div class="ui secondary vertical menu">
      <a class="item">
        <div class="ui transparent icon input">
          <input type="text" placeholder="Search by name.." id ="ex" onkeyup="search()">
          <i class="search icon"></i>
        </div>
      </a>
      <br>
      
    
      
    </div>
    </div>
    <div>
    <h1 style="margin-left:100px;">Transactions History</h1>
    <div  id="transactions" class="inner2inner1cont2">
         
    </div>
    </div>
  </div>
  <div class="inner2cont2">
    <div id="hello">
  <table class="ui selectable inverted table">

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
      <?php
      include("conn.php");
      error_reporting (0); 
      $j=1;
      $query="select loaner.*,borrow.*,login.* from  loaner,borrow,login where loaner.lid=borrow.lid and borrow.id=login.id  and login.id='$loginid' order by borrow.dat";
      $data=mysqli_query($conn,$query);
      while($result= mysqli_fetch_assoc($data))
       {
         
          $eid=$result['lid']; 
          $bid=$result['bid'];   
          
       echo "
      <tr>";
       echo " <td>".$j."</td>";
       $j=$j+1;
        echo "<td>".$result['llname']."</td>";
        echo "<td>".$result['amount']."</td> ";
        echo " <td>".$result['dat']."</td> ";
        echo "<td>".$result['status']."</td>";
        echo   '<td><button onclick="view('.$bid.')" class="ui blue button">View Transactions</button></td>';
      echo "</tr>";
       }

      ?>
    </tbody>
  </table>
  
      </div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
<script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
<script>
  function search()
{
  var name;
  name=document.getElementById('ex').value;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('hello').innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "http://localhost/finance/historysearch.php?q="+name, true);
  xhttp.send();
}
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
</body>
</html>