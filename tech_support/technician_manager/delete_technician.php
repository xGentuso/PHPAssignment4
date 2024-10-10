<?php
  session_start();
  if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['error_message'] = "Unauthorized access.";
    error_log("Unauthorized access - role not set or not admin.");
    header("Location: ../errors/error.php");
    exit();
}

  require_once('../model/database_oo.php');
  require_once('../model/technician.php');
  require_once('../model/technician_db_oo.php');

  // Role-Based Access Control: Ensure that only admins can delete technicians
  if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['error_message'] = "Unauthorized access.";
    error_log("Unauthorized access - role not set or not admin.");
    header("Location: ../errors/error.php");
    exit();
  }

  // Retrieve technician ID from POST data
  $tech_id = filter_input(INPUT_POST, 'technician_id', FILTER_VALIDATE_INT);
  error_log("Technician ID received: " . ($tech_id !== false ? $tech_id : 'Invalid technician ID'));

  if ($tech_id === NULL || $tech_id === FALSE) {
    $_SESSION['error_message'] = "Invalid Technician ID. Check all fields and try again.";
    error_log("Invalid Technician ID: $tech_id");
    header("Location: ../errors/error.php");
    exit();
  } else {
    try {
      // instantiate the TechnicianDB class
      $technicianDB = new TechnicianDB();

      // 
      $technician = $technicianDB->getTechnicianByID($tech_id);

      if ($technician === null) {
        $_SESSION['error_message'] = "Technician not found.";
        error_log("Technician with ID $tech_id not found in the database.");
        header("Location: ../errors/error.php");
        exit();
      }

      // delete the technician using the TechnicianDB class
      error_log("Deleting technician with ID: $tech_id");
      $technicianDB->deleteTechnician($tech_id);
  
      // log the successful deletion of a technician
      error_log("Technician '{$technician->getFullName()}' with ID $tech_id has been deleted.");
  
      // redirect to the confirmation page
      header("Location: delete_technician_confirmation.php");
      exit();
  
    } catch (Exception $e) {
      // log the detailed error message for debugging
      error_log("Error deleting technician: " . $e->getMessage());
  
      // set a generic error message for the user
      $_SESSION['error_message'] = "An unexpected error occurred while deleting the technician. Please try again later.";
      header("Location: ../errors/error.php");
      exit();
    }
  }
?>
