<?php
class Reservation {
  // (A) CONSTRUCTOR - CONNECT TO DATABASE
  private $pdo; // PDO object
  private $stmt; // SQL statement
  public $error; // Error message
  function __construct() {
    try {
      $this->pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER, DB_PASSWORD, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED
        ]
      );
    } catch (Exception $ex) { exit($ex->getMessage()); }
  }

  // (B) DESTRUCTOR - CLOSE DATABASE CONNECTION
  function __destruct() {
    $this->pdo = null;
    $this->stmt = null;
  }

  // (C) SAVE RESERVATION
  function save ($date, $time, $name, $email, $tel, $type) {
    // (C1) CHECKS & RESTRICTIONS


    // (C2) DATABASE ENTRY
    try {
      $this->stmt = $this->pdo->prepare(
        "INSERT INTO `reservation` (`res_date`, `res_time`, `res_name`, `res_email`, `res_tel`, `res_type`) VALUES (?,?,?,?,?,?)"
      );
      $this->stmt->execute([$date, $time, $name, $email, $tel, $type]);
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }

    // (C3) EMAIL
    // @TODO - REMOVE IF YOU WANT TO MANUALLY CALL TO CONFIRM OR SOMETHING
    // OR EMAIL THIS TO A MANAGER OR SOMETHING
    $subject = "Reservation Received";
    $message = "Thank you, we have received your request and will process it shortly.";
    @mail($email, $subject, $message);
    return true;
  }
  
  // (D) GET RESERVATIONS FOR THE DAY
  function getDay ($day="") {
    // (D1) DEFAULT TO TODAY
    if ($day=="") { $day = date("Y-m-d"); }
    
    // (D2) GET ENTRIES
    $this->stmt = $this->pdo->prepare(
      "SELECT * FROM `reservation` WHERE `res_date`=?"
    );
    $this->stmt->execute([$day]);
    return $this->stmt->fetchAll(PDO::FETCH_NAMED);
  }
}

// (E) DATABASE SETTINGS - CHANGE THESE TO YOUR OWN!
define("DB_HOST", "localhost");
define("DB_NAME", "db_ecommerce");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// (F) NEW RESERVATION OBJECT
$_RSV = new Reservation();