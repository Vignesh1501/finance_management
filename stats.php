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
<title>Statistics</title>
<style>
.cont2
{
  display:flex;
  flex-wrap;wrap;
  justify-content: center;
  align-items: center;  
  /*margin-left:35%;
  margin-right:30%;*/
  margin-top:10%;
}
</style>
</head>
<body>
<div class="container">
     <div class="cont1">
            <div class="ui menu">
             <a class="item" href="http://localhost/finance/home.php">Home</a>
             
             <div class="right menu">
                 <a class="item" href="http://localhost/finance/history.php">History</a>
                  <a class="item  " href="http://localhost/finance/logout.php">Logout</a>
              </div>
         </div>
     </div>
     <div class="cont2">
     <div class="ui inverted segment">
     <div class="ui red inverted statistic">
     <?php
     include("conn.php");
     $query="select * from loaner";
     $query1="select * from borrow where status='running'";
     $result=mysqli_query($conn,$query);
     $result1=mysqli_query($conn,$query1);
     $number=mysqli_num_rows($result);
     $mincome=0;
     $yincome=0;
     while($bdata=mysqli_fetch_assoc($result1))
     {
         $date2=$bdata['dat'];
         $year2 = date("Y",strtotime(str_replace('.', '-',$bdata['dat'])));
         $year1 = date("Y");
         $month2 = date('m', strtotime(str_replace('.', '-',$bdata['dat'])));
         $month1 = date("m");
         if(($month1==$month2)&&($year1==$year2))
         {
          $day1=date("d");
          $day2=date("d",strtotime(str_replace('.', '-',$bdata['dat'])));
          
          $diff = round((($day1-$day2)/30),2,PHP_ROUND_HALF_UP);
          $interestamount=$bdata['amount']*(($diff*($bdata['interest']/100)));
          $mincome=$mincome+$interestamount;
         }
         else
         {
          $day1=date("d");
          $day2="1";
          $diff = round((($day1-$day2)/30),2,PHP_ROUND_HALF_UP);
          $interestamount=$bdata['amount']*(($diff*($bdata['interest']/100)));
          $mincome=$mincome+$interestamount;    
         }
         if($year1==$year2)
         {
          $day1=date("d");
          $day2=date("d",strtotime(str_replace('.', '-',$bdata['dat'])));
          $month2 = date('m', strtotime(str_replace('.', '-',$bdata['dat'])));
          $month1 = date("m");
          $diff = round(($month1 - $month2)+(($day1-$day2)/30),2,PHP_ROUND_HALF_UP);
          $interestamount1=$bdata['amount']*(($diff*($bdata['interest']/100)));
          $yincome=$yincome+$interestamount1;
         }
         else
         {
          $day1=date("d");
          $day2="1";
          $month2 = date('m', strtotime(str_replace('.', '-',$bdata['dat'])));
          $month1 = "1";
          $diff = round(($month1 - $month2)+(($day1-$day2)/30),2,PHP_ROUND_HALF_UP);
          $interestamount1=$bdata['amount']*(($diff*($bdata['interest']/100)));
          $yincome=$yincome+$interestamount1;
         }
     }
    echo "<div class='value'>";
      echo $number;
    echo '</div>
    <div class="label">
      Total Number Of Clients';
    echo '</div>
  </div>
  </div>
  <div class="ui inverted segment">
  <div class="ui inverted statistic">
    <div class="value">';
      echo round($mincome);
    echo '</div>
    <div class="label">
      Monthly Income';
    echo '</div>
  </div>
  <div class="ui green inverted statistic">
    <div class="value">';
    echo round($yincome);
    echo '</div>
    <div class="label">
      Yearly Income';
    echo '</div>
  </div>';
  ?>
     </div>
     </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
<script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>

</html>