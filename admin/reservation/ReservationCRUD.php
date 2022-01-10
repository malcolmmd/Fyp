<?php  include('server.php'); 
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM reservation WHERE res_id=$id");
    $n = mysqli_fetch_array($record);
    $name = $n['res_name'];
    $email = $n['res_email'];
    $tel = $n['res_tel'];
    $typeRes = $n['res_type'];
    $dateRes = $n['res_date'];
    $timeRes = $n['res_time'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <h1 class="page-header">Reservation</h1>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style type="text/css">
        body {
    font-size: 19px;
}
table{
    width: 50%;
    margin: 30px auto;
    border-collapse: collapse;
    text-align: left;
}
tr {
    border-bottom: 1px solid #cbcbcb;
}
th, td{
    border: none;
    height: 30px;
    padding: 2px;
}
tr:hover {
    background: #F5F5F5;
}

form {
    width: 45%;
    margin: 50px auto;
    text-align: left;
    padding: 20px; 
    border: 1px solid #bbbbbb; 
    border-radius: 5px;
}

.input-group {
    margin: 10px 0px 10px 0px;
}
.input-group label {
    display: block;
    text-align: left;
    margin: 3px;
}
.input-group input {
    height: 30px;
    width: 93%;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid gray;
}
.btn {
    padding: 10px;
    font-size: 15px;
    color: white;
    background: #5F9EA0;
    border: none;
    border-radius: 5px;
}
.edit_btn {
    text-decoration: none;
    padding: 2px 5px;
    background: #2E8B57;
    color: white;
    border-radius: 3px;
}

.del_btn {
    text-decoration: none;
    padding: 2px 5px;
    color: white;
    border-radius: 3px;
    background: #800000;
}
.msg {
    margin: 30px auto; 
    padding: 10px; 
    border-radius: 5px; 
    color: #3c763d; 
    background: #dff0d8; 
    border: 1px solid #3c763d;
    width: 50%;
    text-align: center;
}
    .auto-style1 {
	text-align: center;
}
    </style>
</head>
<body>

<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>
<?php $results = mysqli_query($db, "SELECT * FROM reservation"); ?>

<table style="width: 77%">
	<thead>
		<tr>
			<th style="width: 162px">Name</th>
			<th style="width: 170px">Email</th>
            <th>Telephone No.</th>
            <th style="width: 159px">RSVP Type</th>
            <th>RSVP Date</th>
            <th style="width: 132px">RSVP Time</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td style="width: 162px"><?php echo $row['res_name']; ?></td>
			<td style="width: 170px"><?php echo $row['res_email']; ?></td>
            <td><?php echo $row['res_tel']; ?></td>
            <td style="width: 159px"><?php echo $row['res_type']; ?></td>
            <td><?php echo $row['res_date']; ?></td>
            <td style="width: 132px"><?php echo $row['res_time']; ?></td>
			<td>
				<a href="ReservationCRUD.php?edit=<?php echo $row['res_id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td style="width: 97px">
				<a href="server.php?del=<?php echo $row['res_id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>

	<form  style="width: 600px" method="post" action="server.php" >
    <input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="input-group">
			<label>Name</label>
			<input style="width: 550px" type="text" name="name" value="<?php echo $name; ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input style="width: 550px" type="text" name="email" value="<?php echo $email; ?>">
		</div>
        <div class="input-group">
        <label>Telephone Number</label>
        <input style="width: 550px" type="text" required name="tel" value="<?php echo $tel; ?>"/>
		</div>
        <div class="input-group">
        <label>Type of RSVP</label>
        <select style="width: 550px" name="typeRes" required>
        <option value="Private Dining">Private Dining</option>
        <option value="Private Cooking Class">Cooking Class</option>
        </select>
		</div>

        <?php
        $min = new DateTime();
        $min->modify("+1 day");
        $max = new DateTime();
        $max->modify("+2 Year");
        ?>

        <div class="input-group">
        <label>RSVP Date</label>
        <input style="width: 550px" type="date" required id="dateRes" name="dateRes" value="<?=date("Y-m-d")?>" min=<?=$min->format("Y-m-d")?> max=<?=$max->format("Y-m-d")?>>
		</div>
        <div class="input-group">
        <label>RSVP Time</label>
        <input style="width: 550px" type="time" required id="timeRes" name="timeRes" value="<?php echo $timeRes; ?>">
		</div>
		<div class="input-group">
        <?php if ($update == true): ?>
            <button class="btn" type="submit" name="update" style="background: #556B2F;" >Update</button>
            <?php else: ?>
                <button class="btn" type="submit" name="save" >Save</button>
            <?php endif ?>
		</div>
		<div class="input-group">
		</div>
	</form>



</body>
</html>