<?php
include('session.php');

$tno=$_POST['TNO'];
$date=$_POST['date'];
$solution=$_POST['sol'];
$pend="pending";


$sql="UPDATE s_task  SET Solution='$solution', TimeClosed='$date' WHERE Ticket_no='$tno'";
$T="SELECT Officer from s_task where Ticket_no='$tno' and Solution='$pend'";
$q="SELECT Officer from s_task where Ticket_no='$tno'";
$query="UPDATE s_ticket SET Status='closed' WHERE Ticket_no='$tno'";
$T1=mysqli_query($db, $T);
$count=mysqli_num_rows($T1);
$q1=mysqli_query($db, $q);
$count1=mysqli_num_rows($q1);


if(empty($date)){$message="Failed.Please select a date!!";}

else{
if($count1==1){
if($count==1){
   $result=mysqli_query($db, $sql);
   if($result){
      mysqli_query($db, $query);
	$message="Ticket closed successfully";
 }
  else{
   $message="Sorry an error occured";
  }
}
else{$message="Ticket Already closed";}
}
else{
   $message="Ticket doesn't exist please confirm ticket number.";
   }

}

?>



<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="user-scalable=0, width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Support-ICT KNH</title>
   <link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css">
	<script type='text/javascript' src='js/mobile.js'></script>
	<script type='text/javascript' src='js/jquery-1.11.1.min.js'></script>
</head>
<body>
	<div id="heade">
       <span style="padding: 30px 0;"><img src="images/logo.png"></span>
       <label style="float:right"><a href="logout.php" >|Logout</a></label>
       <label style="float:right"><a href="Profile.php" >|Profile</a></label>
       <label style="float:right"><span style="color:#000;">Welcome, <?php echo $login_session; ?> </span></label><br>
       <div style="float:right;"> <div class='time-frame'>
    <div id='date-part'></div>
    <div id='time-part'></div>
</div> </div>
	</div>
   
    <div id="head-status" ><P style="">ICT HELPDESK SYSTEM</P></div>
	<div id="header">
		
		<ul id="navigation">
			<li>
				<a href="home.php">Home</a>
			</li>
          <li>
            <a href="contact.php">Ordering</a>
         </li>
			<li>
				<a href="procurement.php">Procurement</a>
			</li>
			<li>
				<a href="dispatch.php">Dispatch</a>
			</li>
			<li class="current">
				<a href="#">Support</a>
				<ul>
					<li>
						<a href="support.php">Helpdesk</a>
					</li>
					
					<li>
						<a href="workshop.php">Workshop</a>
					</li>
				</ul>
			</li>
			
			<li>
				<a href="dashboard.php">Reports</a>
			</li>
		</ul>
	</div>
	<div id="bod">

		<h2>HelpDesk Support</h2> <a href="supplist.php" style="float:right" class="btn btn-primary">List Ticketing activity</a>
		<p> Please enter the details on support</p>
      
		<form method="post" action="supp.php">
		<h3>User Requests</h3>
		<table><tr>
		<td><label for="PNO">
				<span>Personal No.</span>
				<input type="text" id="PNO" name="PNO">
			</label></td><td>
			<label for="PENO">
				<span>Ext. No.</span>
				<input type="text" id="PENO" name="ENO">
			</label></td></tr>
			<tr><td><label for="date">
				<span>Date</span>
				<input type="text" id="date" name="date" readonly="true" style="margin:15px 0 15px 47px;">
			</label></td><td>
			<label for="fault">
				<span>Fault</span>
				<select id="fault" name="fault"style="margin:15px 0 15px 15px;">
				<option></option>
                <option>Computer H/W</option>
                <option>Computer S/W</option>
                <option>Internet Connection</option>
                <option>Network Issues</option>

                <option>Printing Issues</option>
                <option>UPS</option>
                
				</select>
			</label></td></tr></table>
			<div style="width:880px;"><label > Department</label></div>
			<div id="Proc-left1">
			

 <input type="button" id="btn" value="Administration" />
<input type="button" id="btn1" value="Medicine" />
<input type="button" id="btn2" value="Peripheral   " />

    
<br /><br />       
    
<div id="output"></div> <br><br>
<div style="width:880px;"><tr><td>
         <label for="location">
            <span>Location</span>
            <input type="text" id="loc" name="loc">
         </label></td></tr><div>
    
<div id="overlay" class="web_dialog_overlay"></div>
    
 <div id="dialog" class="web_dialog">
   <table style="width: 100%; border: 0px;" cellpadding="3" cellspacing="0">
      <tr>
         <td class="web_dialog_title">Department Selection</td>
         <td class="web_dialog_title align_right">
            <a href="#" id="btnClose">Close</a>
         </td>
      </tr>
      <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
      </tr>
      <tr>
         <td colspan="2" style="padding-left: 15px;">
          <p> <b>Choose the appropriate department </b></p>
         </td>
      </tr>
      <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
      </tr>
      <tr>
         <td colspan="2" style="padding-left: 15px;">
            <div id="brands">
               <input id="brand1" name="brand" type="radio" checked="checked" value="Finance" /> Finance
               <input id="brand2" name="brand" type="radio" value="Supply Chain" /> Supply Chain
               <input id="brand3" name="brand" type="radio" value="Security" /> Security
               <input id="brand3" name="brand" type="radio" value="Human Resource" /> Human resource
            </div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
      </tr>
      <tr>
         <td colspan="2" style="text-align: center;">
            <input id="btnSubmit" type="button" value="Submit" />
         </td>
      </tr>
   </table>
</div>

<!--Beginning of web_dialog2-->
<div id="dialog2" class="web_dialog2">
   <table style="width: 100%; border: 0px;" cellpadding="3" cellspacing="0">
      <tr>
         <td class="web_dialog_title">Department Selection</td>
         <td class="web_dialog_title align_right">
            <a href="#" id="btn1Close">Close</a>
         </td>
      </tr>
      <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
      </tr>
      <tr>
         <td colspan="2" style="padding-left: 15px;">
          <p> <b>Choose the appropriate department </b></p>
         </td>
      </tr>
      <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
      </tr>
      <tr>
         <td colspan="2" style="padding-left: 15px;">
            <div id="brand">
               <input id="brand1" name="brand" type="radio" checked="checked" value="Level 1" /> Level 1
               <input id="brand2" name="brand" type="radio" value="Level 6" /> Level 6
               <input id="brand3" name="brand" type="radio" value="Casualty" /> Casualty
               <input id="brand3" name="brand" type="radio" value="Radiology" /> Radiology
            </div>
         </td>
      </tr>
      <tr>
         <td colspan="2" style="padding-left: 15px;">
            <div id="brandsh">
               <input id="brand1" name="brand" type="radio" checked="checked" value="Level 2" /> Level 2
               <input id="brand2" name="brand" type="radio" value="Level 7" /> Level 7
               <input id="brand3" name="brand" type="radio" value="Dental" /> Dental
               <input id="brand3" name="brand" type="radio" value="Orthopaedic" /> Orthopaedic
            </div>
         </td>
      </tr>
      <tr>
         <td colspan="2" style="padding-left: 15px;">
            <div id="brandh">
               <input id="brand1" name="brand" type="radio" checked="checked" value="Level 3" /> Level 3
               <input id="brand2" name="brand" type="radio" value="Level 8" /> Level 8
               <input id="brand3" name="brand" type="radio" value="Morgue" /> Morgue
               <input id="brand3" name="brand" type="radio" value="Blood Transfer" /> Blood Transfer
            </div>
         </td>
      </tr>
      <tr>
         <td colspan="2" style="padding-left: 15px;">
            <div id="brandss">
               <input id="brand1" name="brand" type="radio" checked="checked" value="Level 4" /> Level 4
               <input id="brand2" name="brand" type="radio" value="Level 9" /> Level 9
               <input id="brand3" name="brand" type="radio" value="maternity" /> Maternity
               <input id="brand3" name="brand" type="radio" value="Eye Clinic" /> Eye Clinic
            </div>
         </td>
      </tr>
      <tr>
         <td colspan="2" style="padding-left: 15px;">
            <div id="brandsz">
               <input id="brand1" name="brand" type="radio" checked="checked" value="Level 5" /> Level 5
               <input id="brand2" name="brand" type="radio" value="Level 10" /> Level 10
               <input id="brand3" name="brand" type="radio" value="Theatre" /> Theatre
               <input id="brand3" name="brand" type="radio" value="Records" /> Records
            </div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
      </tr>
      <tr>
         <td colspan="2" style="text-align: center;">
            <input id="btn1Submit" type="button" value="Submit" />
         </td>
      </tr>
   </table>
</div>


<!--End of web_dialog2-->
<!--Beginning of web_dialog3-->

<div id="dialog3" class="web_dialog">
   <table style="width: 100%; border: 0px;" cellpadding="3" cellspacing="0">
      <tr>
         <td class="web_dialog_title">Department Selection</td>
         <td class="web_dialog_title align_right">
            <a href="#" id="btn2Close">Close</a>
         </td>
      </tr>
      <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
      </tr>
      <tr>
         <td colspan="2" style="padding-left: 15px;">
          <p> <b>Choose the appropriate department </b></p>
         </td>
      </tr>
      <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
      </tr>
      <tr>
         <td colspan="2" style="padding-left: 15px;">
            <div id="brandy">
               <input id="brand1" name="brand" type="radio" checked="checked" value="Maintenance" /> Maintenance
               <input id="brand2" name="brand" type="radio" value="Main Store" /> Main Store
               <input id="brand3" name="brand" type="radio" value="Lower Mess" /> Lower Mess
               <input id="brand3" name="brand" type="radio" value="Boiler" /> Boiler
            </div>
         </td>
      </tr>
      <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
      </tr>
      <tr>
         <td colspan="2" style="text-align: center;">
            <input id="btn2Submit" type="button" value="Submit" />
         </td>
      </tr>
   </table>
</div>


<!--End of web_dialog3-->


		
	<br>	<div style="width:800px;"><input type="submit" id="send" value="submit" style="margin-top:25px;"></div>
		</form></div>
<div style="height:405px;">		
<div id="Proc-right" style="padding-top:60px;">
             <form method="post" action="assign.php">
             <h3>Assignment</h3>	
             <br>
        <label for="Tno">
				<span>Ticket No.</span>
				<input type="text" id="Tno" name="Tno">
			</label>
			<label for="date">
				<span>Date</span>
				<input type="text" name="dateA" id="dat" readonly="true" required>
			</label>
			<label for="Oassign">
				<span>Officer Assigned</span>
				<input type="text" id="Oassign" name="Oassign">
			</label>
			
			<div style="height:100px;width:400px;float:left"><input type="submit" id="send" value="submit" style="margin-top:15px;"></div>
             </form>		 </div> 
<div id="Proc-right" >
             <form method="post" action="close.php">
             <h3>Ticket closing</h3>
             <span style="color:red;"><?php echo $message;?></span>	<br>
        <label for="Tno">
				<span>Ticket No.</span>
				<input type="text" id="Tno" name="TNO">
			</label>
			<label for="date">
				<span>Date and time</span>
				<input type="text" name="datet" required readonly="true">
			</label>
			
			<label for="sol">
				<span>Solution Given</span>
				<input type="text" name="sol">
			</label>
			<div style="height:60px;width:400px;float:left"><input type="submit" id="send" value="submit" style="margin-top:25px;"></div>
             </form></div>	
		 </div> 		 
	</div>
	<div id="footer">
		<div>
			
			<p>
				&copy; 2017 Kenyatta National Hospital . All rights reserved.
			</p>
		</div>
      <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery-1.12.4.js"></script>
<script src="js/moment.min.js"></script>
<link href="css.jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
     <script type="text/javascript">

     $(document).ready(function() {
    var interval = setInterval(function() {
        var momentNow = moment();
        $('#date-part').html(momentNow.format('YYYY MMMM DD') + ' '
                            + momentNow.format('dddd')
                             .substring(0,3).toLowerCase());
        $('#time-part').html(momentNow.format('A hh:mm:ss'));
    }, 100);
    
    $('#stop-interval').on('click', function() {
        clearInterval(interval);
    });

      var dateobj = new Date(); //Get today's date
var today = new Date(dateobj.getFullYear(),dateobj.getMonth(),dateobj.getDate() );
var lastDate = new Date(dateobj.getFullYear(), dateobj.getMonth() + 1, 0);  //To get the last date of today's month

$("#date").datepicker({
    startDate: today,
    todayBtn: "linked",
   keyboardNavigation: false,
   forceParse: false,
   calendarWeeks: true,
   autoclose: true,
   format: 'yyyy-mm-dd'


});
$("#dat").datepicker({
    startDate: today,
    todayBtn: "linked",
   keyboardNavigation: false,
   forceParse: false,
   calendarWeeks: true,
   autoclose: true,
   format: 'yyyy-mm-dd'


});
$("#datet").datepicker({
    startDate: today,
    todayBtn: "linked",
   keyboardNavigation: false,
   forceParse: false,
   calendarWeeks: true,
   autoclose: true,
   format: 'yyyy-mm-dd'


});

});


     </script>
		<script type="text/javascript">
        $(document).ready(function ()
   {
      $("#btn").click(function (e)
      {
         ShowDialog(false);
         e.preventDefault();
      });

      $("#btn1").click(function (e)
      {
         ShowDialog2(true);
         e.preventDefault();
      });

      $("#btn2").click(function (e)
      {
         ShowDialog3(true);
         e.preventDefault();
      });

      $("#btnClose").click(function (e)
      { 
         HideDialog();
         e.preventDefault();
      });

      $("#btn1Close").click(function (e)
      { 
         HideDialog2();
         e.preventDefault();
      });
      $("#btn2Close").click(function (e)
      { 
         HideDialog3();
         e.preventDefault();
      });

      $("#btnSubmit").click(function (e)
      {  
          var region=$
         var brand = $("#brands input:radio:checked").val();
         $("#output").html("<br><b>You have Selected: </b>" + brand);
         HideDialog();
         e.preventDefault();
      });

      $("#btn2Submit").click(function (e)
      {  
          var region=$
         var brand = $("#brandy input:radio:checked").val();
         $("#output").html("<br><b>You have Selected: </b>" + brand);
         HideDialog3();
         e.preventDefault();
      });

      $("#btn1Submit").click(function (e)
      {  
          var region=$
         var brand = $("#brand input:radio:checked").val()||$("#brandsh input:radio:checked").val()||$("#brandh input:radio:checked").val()||$("#brandss input:radio:checked").val()||$("#brandsz input:radio:checked").val();
         $("#output").html("<br><b>You have Selected: </b>" + brand);
         HideDialog2();
         e.preventDefault();
      });

   });

   function ShowDialog(modal)
   {
      $("#overlay").show();
      $("#dialog").fadeIn(300);

      if (modal)
      {
         $("#overlay").unbind("click");
      }
      else
      {
         $("#overlay").click(function (e)
         {
            HideDialog();
         });
      }
   }

   function ShowDialog2(modal)
   {
      $("#overlay").show();
      $("#dialog2").fadeIn(300);

      if (modal)
      {
         $("#overlay").unbind("click");
      }
      else
      {
         $("#overlay").click(function (e)
         {
            HideDialog();
         });
      }
   }
   function ShowDialog3(modal)
   {
      $("#overlay").show();
      $("#dialog3").fadeIn(300);

      if (modal)
      {
         $("#overlay").unbind("click");
      }
      else
      {
         $("#overlay").click(function (e)
         {
            HideDialog();
         });
      }
   }

   function HideDialog()
   {
      $("#overlay").hide();
      $("#dialog").fadeOut(300);
   } 
        
   function HideDialog2()
   {
      $("#overlay").hide();
      $("#dialog2").fadeOut(300);
   } 
   function HideDialog3()
   {
      $("#overlay").hide();
      $("#dialog3").fadeOut(300);
   } 
     </script>
		<div id="connect">
			<a href="https:://www.facebook.com/Kenyatta-National-Hospital-222808627792716/" id="facebook" target="_blank">Facebook</a>
			<a href="https:://twitter.com/knh_hospital?lang=en" id="twitter" target="_blank">Twitter</a>
			<a href="https://knh.or.ke/" id="googleplus" target="_blank">Google&#43;</a>
		</div>
	</div>
</body>
</html>