<?php
  session_start();
  
  require_once('../model/database_oo.php');
  require_once('../model/technician.php');
  require_once('../model/technician_db_oo.php');

  // optional: Role-Based Access Control
  // ensure that only admins can delete technicians
  if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['error_message'] = "Unauthorized access.";
    header("Location: ../errors/error.php");
    exit();
  }
  
  // retrieve and sanitize the technician ID from POST data
  $tech_id = filter_input(INPUT_POST, 'technician_id', FILTER_VALIDATE_INT);
  
  if ($tech_id === NULL || $tech_id === FALSE) {
    $_SESSION['error_message'] = "Invalid Technician ID. Check all fields and try again.";
    include('../errors/error.php');
  } else {
    try {
      // instantiate the TechnicianDB class
      $technicianDB = new TechnicianDB();

      // delete the technician using the TechnicianDB class
      $technicianDB->deleteTechnician($tech_id);

      if ($technician === null) {
        $_SESSION['error_message'] = "Technician not found.";
        header("Location: ../errors/error.php");
        exit();
      }

      $_SESSION['deleted_technician_name'] = $technician->getFullName();

      $technicianDB->deleteTechnician($tech_id);
  
      // optionally log the deletion of a technician
      error_log("Technician '{$technician->getFullName()}' with ID $tech_id has been deleted.");
  
      // redirect to confirmation page
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
