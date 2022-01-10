<head>
<style type="text/css">
.auto-style1 {
	text-align: center;	
}
.bckgrnd {
background-color:white;
}
.bckgrnd2{
	background-color:white;
}
.bckgrnd3{
	background-color:white;
}
</style>
<title>Reservation</title>
</head>

<?php
// (A) PROCESS RESERVATION
if (isset($_POST["date"])) {
  require "reserve.php";
  if ($_RSV->save(
    $_POST["date"], $_POST["time"], $_POST["name"],
    $_POST["email"], $_POST["tel"], $_POST["type"])) {
     echo "<div class='ok'>Reservation saved.</div>";
  } else { echo "<div class='err'>".$_RSV->error."</div>"; }
}
?>
<fieldset class="bckgrnd3">
<!-- (B) RESERVATION FORM -->
<fieldset class="bckgrnd">
<h2 class="title text-center">Reservation</strong></h2>
        <p class="auto-style1"><strong>We only allow reservations for both Private 
		Dining and Cooking classes</strong></p>
        <p class="auto-style1"><strong>Any cancellation of reservations must be notified 
		at least a week before the reserved date.</strong></p>
<p class="auto-style1"><strong>Payment to be done on the day itself. </strong> </p>
</fieldset>
<fieldset class="bckgrnd2">
<form id="resForm" method="post" target="_self">
    <div class="auto-style1">
  <label for="res_name">Full Name</label>
  <input type="text" required name="name" value="Insert Full Name"/>

  <label for="res_email"><br><br>Email Address</label>
  <input type="email" required name="email" value="example@example.com"/>

  <label for="res_tel"><br><br>Telephone Number</label>
  <input type="text" required name="tel" value="Insert Phone No"/><br><br>&nbsp;
  <label for="res_type">Type of reservation</label>
  <select name="type">
    <option value="Private Dining">Private Dining</option>
    <option value="Private Cooking Class">Cooking Class</option>
  </select>

  <?php
  $min = new DateTime();
  $min->modify("+1 day");
  $max = new DateTime();
  $max->modify("+2 year");
  ?>
  <label><br><br>Reservation Date</label>
  <input type="date" required id="res_date" name="date" value="<?=date("Y-m-d")?>" min=<?=$min->format("Y-m-d")?> max=<?=$max->format("Y-m-d")?>>

  <label><br><br>Reservation Time</label>
  <input type="time" required id="res_time" name="time"> <br><br>

  <input type="submit" value="Submit"/>
  
  <p class="auto-style1">For More information or inquiries, please contact this person via whatsapp or call:</p>
				<p class="auto-style1">
				<img src="images\assets\WhatsApp-Logo.png" height="39" width="68">+60138029039 {Bryan R Law}</p>

</div>
<!-- <button type="button" href="#"><img src="images\assets\Back.png" height="76" width="158"></button> -->
</form>
</fieldset>

</fieldset>

