<!DOCTYPE html>
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
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body,html
{
  height:100%;
}
.container
{
  margin-left:20%;
  margin-right:20%;
  margin-top:50px;
  margin-bottom:400px;
}
.parallax {
  background-image: url("note.jpeg");
  min-height: 100%;
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
</head>
<body>
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
     <div class="parallax">
    </div>
     <div class="container">
         <div class="cont1">
            <?php
                 include("conn.php");
                 error_reporting(0);
                 $bid=$_GET['bid'];
                 $query1="select * from borrow where bid='$bid' and id='$loginid'";
                 $borrowdata=mysqli_query($conn,$query1);
                 $bdata=mysqli_fetch_assoc($borrowdata);
                 $lid=$bdata['lid'];
                 $query2="select * from loaner where lid='$lid'";
                 $query3="select username from login where id='$loginid'";
                 $loanerdata=mysqli_query($conn,$query2);
                 $ldata=mysqli_fetch_array($loanerdata);
                 $issuername=mysqli_query($conn,$query3);
                 $lname=mysqli_fetch_array($issuername);
                 $query4="select * from transact where bid='$bid' and lid='$lid' and id='$loginid'";
                 $transactdata=mysqli_query($conn,$query4);
                 $tdata=mysqli_fetch_assoc($transactdata);
                 $paidtillnow=0;
                 while($tdata)
                 {
                    $paidtillnow=$paidtillnow+$tdata['amount_paid'];
                    $tdata=mysqli_fetch_assoc($transactdata);
                 }
                 $date= date("Y-m-d");
                 $date2=$bdata['dat'];
                 $year2 = date("Y",strtotime(str_replace('.', '-',$bdata['dat'])));
                 $year1 = date("Y");
                 $month2 = date('m', strtotime(str_replace('.', '-',$bdata['dat'])));
                 $month1 = date("m");
                 $day1=date("d");
                 $day2=date("d",strtotime(str_replace('.', '-',$bdata['dat'])));
                 $diff = round((($year1 - $year2) * 12) + ($month1 - $month2)+(($day1-$day2)/30),2,PHP_ROUND_HALF_UP);
                 $interestamount=$bdata['amount']*(($diff*($bdata['interest']/100)));
                 $finalamount=($bdata['amount']*(1+(($diff*($bdata['interest']/100)))));
                 $remaining=floor(($finalamount)-($paidtillnow));
                 echo "<table class='ui striped red table'>
                 <thead>
                   <tr><th>Name</th>
                   <th>".$ldata['llname']."</th>
                 </tr></thead><tbody>
                   <tr>
                     <td>Phone Number</td>
                     <td>".$ldata['pno']."</td>
                    
                   </tr>
                   <tr>
                     <td>Email</td>
                     <td>".$ldata['email']."</td>
                
                   </tr>
                   <tr>
                   <td>Address</td>
                   <td>".$ldata['address']."</td>
              
                 </tr>
                 <tr>
                 <td>Pincode</td>
                 <td>".$ldata['aid']."</td>

               </tr>
                 <tr>
                 <td>Issuer Name</td>
                 <td>".$lname['username']."</td>
                 
               </tr>
                 
                 <tr>
                 <td>Taken Date</td>
                 <td>".$bdata['dat']."</td>
                 

               </tr>
                 <tr>
                 <td>Today Date</td>
                 <td>".$date."</td>
                 
               </tr>
                 <tr>
                 <td>Rate of Interest</td>
                 <td>".$bdata['interest']."</td>  
               </tr>
               <tr>
                 <td>Amount Taken</td>
                 <td>".$bdata['amount']."</td>
               </tr>
               <tr>
                 <td>Tenure(in months)</td>
                 <td>".$diff."</td>
                 </tr>
                 <tr>
                 <td>Amount Taken</td>
                 <td>".$bdata['amount']."</td>
               </tr>
               <tr>
                 <td>Interest Amount</td>
                 <td>".$interestamount."</td>
                 </tr>
                 <tr>
                 <td>Amount Paid till date</td>
                 <td>".$paidtillnow."</td>
                 </tr>
               <tr>
               <td>Remaining Amount</td>
               <td>".$remaining."</td>
               
             </tr>
             <tr>
                 <td>Amount in total</td>
                 <td>".$finalamount."</td>
                 </tr>
                 </tbody>
               </table>";
            
            ?>
          </div>
          <div class="cont2">
                
          <div class="ui form">
          <form action="http://localhost/finance/paynow.php" method="POST">
             <div class="fields">
                <div class="ten wide field">
                <label>Amount going to pay</label>
                <input type="text" placeholder="Amount going to pay" name="payingamount" required>
                </div>
                <div class=" ten wide field">
                <input type="hidden" name="bid" value="<?php echo $bdata['bid']?>">
             </div>
             <div class=" ten wide field">
                <input type="hidden" name="remaining" value="<?php echo $remaining ?>">
             </div>
             <div class=" ten wide field">
                <input type="hidden" name="lid" value="<?php echo $ldata['lid'] ?>">
             </div>
             </div>
             <div class=" button">
             <input class="ui blue button" type="submit" name="submit" value="Pay Now">
             </div>
          </form>
          </div>
          </div>
     </div>
     <script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
<script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
</body>
</html>
