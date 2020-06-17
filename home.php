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
<title>Home</title>
<style>
.inner1cont2
{
  display:flex;
  
  justify-content:flex-start;
  flex-direction:column;
}
.inner1inner1cont2
{

}
.inner2inner1cont2
{
     padding:20px;
}
.cont2
{
  display:flex;
  
}

.inner1cont2
{
  flex:1;
  
}
.inner2cont2{
  flex:4;
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
</head>
<body>
<div class="container">

<div class="cont1">
  <div class="ui menu">
    <a class="item" href="http://localhost/finance/home.php">Home</a>
    <a class="item" href="http://localhost/finance/stats.php">Stats</a>
    <div class="right menu">
      <a class="item" href="http://localhost/finance/history.php">History</a>
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
      <a class="active item" href="http://localhost/finance/home.php">
        Display All
      </a>
      
      <a class="item" onclick="myFunction1()">
        Overdue 
      </a>
      <br>
      
    
      
    </div>
    </div>
    <div class="inner2inner1cont2">
             <form action="http://localhost/finance/insertdata.php" >
            <button   class="ui red button">Insert New Record</button>
            </form>
    </div>
  </div>
  <div class="inner2cont2">
    <div id="hello">
  <table class="ui very basic table">

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
    <tbody>
      <?php
      include("conn.php");
      error_reporting (0); 
      $j=1;
      $query="select loaner.* ,borrow.*,login.* from  loaner,borrow,login where loaner.lid=borrow.lid and borrow.id=login.id and login.id='$loginid' and borrow.status='running' ";
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
        echo "<td>".$result['edat']."</td>";
        echo '<td><button  onclick="window.location.href= \'http://localhost/finance/more.php?bid='.$bid.'\'" class="ui blue button">More</button></td>';
        echo '<td><button  onclick="window.location.href= \'http://localhost/finance/existinsertdata.php?id='.$eid.'\'" class="ui red button">Add New</button></td>'; 
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
  xhttp.open("GET", "http://localhost/finance/search.php?q="+name, true);
  xhttp.send();
}
function myFunction1()
{



  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('hello').innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "http://localhost/finance/overdue.php", true);
  xhttp.send();
}
  </script>
</body>
</html>