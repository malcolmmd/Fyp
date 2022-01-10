<?php
require_once("../../include/initialize.php");
//checkAdmin();
	# code...
if(!isset($_SESSION['USERID'])){
	redirect(web_root."admin/index.php");
}

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

	$header=$view;
	$title="Reservation"; 
	switch ($view) {


  	default :
	$title="Reservation";
		$content    = 'ReservationCRUD.php';
	}


   
 
require_once ("../theme/templates.php");
?>
  
