<?php 
	// session_start();
	$db = mysqli_connect('localhost', 'root', '', 'db_ecommerce');

	// initialize variables
	$name = "";
	$email = "";
    $tel = "";
    $typeRes = "";
    $dateRes = "";
    $timeRes = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
        $tel = $_POST['tel'];
        $typeRes = $_POST['typeRes'];
        $dateRes = $_POST['dateRes'];
        $timeRes = $_POST['timeRes'];

		mysqli_query($db, "INSERT INTO reservation (res_name, res_email, res_tel, res_type, res_date, res_time) VALUES ('$name', '$email', '$tel', '$typeRes', '$dateRes', '$timeRes')"); 
		$_SESSION['message'] = "Reservation saved"; 
		header('location: ReservationCRUD.php');
	}
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $typeRes = $_POST['typeRes'];
        $dateRes = $_POST['dateRes'];
        $timeRes = $_POST['timeRes'];
    
        mysqli_query($db, "UPDATE reservation SET res_name='$name', res_email='$email', res_tel='$tel', res_type='$typeRes', res_date='$dateRes', res_time='$timeRes' WHERE res_id=$id");
        $_SESSION['message'] = "Reservation updated!"; 
        header('location: ReservationCRUD.php');
    }
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($db, "DELETE FROM reservation WHERE res_id=$id");
        $_SESSION['message'] = "Reservation deleted!"; 
        header('location: ReservationCRUD.php');
    }
    $results = mysqli_query($db, "SELECT * From reservation")
?>