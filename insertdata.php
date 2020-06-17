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
<html>
<head>
<title>Insert Form</title>
<style>
.cont2{
    display:flex;
    flex-direction:column;
    /*justify-content:center;
    align-items:center;
*/
}
.inner1cont2
{
    flex:1;
    padding:px;
    margin-left:550px;
}
.inner2cont2
{
    flex:5;
    margin-left:250px;
    margin-right:250px;
    
}


.container
{
    display:flex;
    flex-direction:column;
    
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
            <div class="right menu">
            <a class="item  " href="http://localhost/finance/logout.php">Logout</a>
             </div>
         </div>
       </div>
	   <div class="cont2">
	       <div class="inner1cont2">
                  <h1>ENTER DETAILS</h1>
           </div>
		   <h3 style="color:red;margin-left:300px;">*All fields are mandatory</h3>
		   <div class="inner2cont2">
		         <div class="ui  form" >
             <form action="http://localhost/finance/insertdataquery.php" method="POST">
				 <div style="margin-left:5%;margin-right:5%;"class="field">
                      <label>Full Name</label>
                      <input placeholder="Full Name" type="text" name="llanme" required>
                 </div>
				 <div class="fields">
                         <div class="six wide field"style="margin-left:5%;" >
                             <label>Mobile Number</label>
                              <input placeholder="Phone Number" type="text" name="pno" required>  
                          </div>
                         <div class="ten wide field" style="margin-right:5%;">
                                <label>Email-ID</label>
                                 <input placeholder="Email-ID" type="text" name="email" required>  
                          </div>
                   </div>
				   <div class="field" style="margin-left:5%;margin-right:5%;">
                         <label>Address</label>
                           <textarea rows="2" required name="address"></textarea>
                   </div>
				   <div class="fields">
         <div class="six wide field" style="margin-left:5%;margin-right:15%;">
                <label>Pincode</label>
                <input placeholder="Pin Code" type="text" name="aid" required>
         </div>
         <div class="ten wide field" style="margin-right:5%;">
         <label>Rate Of Interest</label>
                <input placeholder="Interest" type="text" name="interest" required>
         </div>
        </div>
		<div class="fields" style="margin-left:5%;">
    <div class="six wide field">
      <label>Amount</label>
      <input type="text" placeholder="Amount" name="amount">
    </div>
    <div class="six wide field">
      <label>date of Issue</label>
      <input type="date" name="dat">
    </div>
    <div class="six wide field">
      <label>Estimated return Date</label>
      <input type="date" name="edat" >
    </div>
</div>
<br>
<input class="ui inverted red button"style="margin-left:400px;" type="submit" value="submit" name="submit">
				 </form></div>
		   </div>
	   </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
<script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
</html>
