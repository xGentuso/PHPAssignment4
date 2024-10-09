<?php
  session_start();

  require_once('../model/database_oo.php');
  require_once('../model/technician.php');
  require_once('../model/technician_db_oo.php');

  // Retrieve and sanitize input data
  $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
  $last_name  = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
  $email      = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $phone      = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
  $password   = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

  // Validate input data
  if (
    empty($first_name) ||
    empty($last_name) ||
    empty($email) ||
    empty($phone) ||
    empty($password)
  ) {
    $_SESSION['error_message'] = "Invalid technician data. Check all fields and try again.";
    header("Location: ../errors/error.php");
    exit();
  }

  try {
    // Hash the password before storing it for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Create a new Technician object (techID is null as it's auto-incremented)
    // **Important:** Pass the hashed password, not the plain-text password
    $technician = new Technician(null, $first_name, $last_name, $email, $phone, $hashed_password);

    // Instantiate the TechnicianDB class to handle database operations
    $technicianDB = new TechnicianDB();

    // Add the new technician to the database
    $technicianDB->addTechnician($technician);

    // Optionally log the addition of a new technician
    error_log("New technician added: " . $first_name . " " . $last_name . " (" . $email . ")");

    // Set the technician's full name in session for confirmation
    $_SESSION['name'] = $technician->getFullName();

    // Redirect to the confirmation page
    header("Location: add_technician_confirmation.php");
    exit();

  } catch (Exception $e) { // Changed to catch generic Exception for broader coverage
    // Log the detailed error message for debugging
    error_log("Error adding technician: " . $e->getMessage());

    // Set a generic error message for the user
    $_SESSION['error_message'] = "An unexpected error occurred while adding the technician. Please try again later.";
    header("Location: ../errors/error.php");
    exit();
  }
?>
