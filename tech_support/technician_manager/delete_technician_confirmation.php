<?php
  session_start();
  
  // optional: Role-Based Access Control (RBAC)
  // ensure that only admins can access this confirmation page
  if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['error_message'] = "Unauthorized access.";
    header("Location: ../errors/error.php");
    exit();
  }
  
  // regenerate session ID for security (optional)
  session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Delete - Confirmation</title>
    <link rel="stylesheet" type="text/css" href="main.css">
  </head>
  <body>
    <?php include("header.php"); ?>
    <main>
      <div>
        <h2>Technician has been deleted.</h2>
        <p>
          <?php 
            if (isset($_SESSION['deleted_technician_name'])) {
              echo htmlspecialchars($_SESSION['delete_technician_name']);
              unset($_SESSION['deleted_technician_name']);
            } else {
              echo "The technician";
            }
          ?> has been deleted from your technician list.
        </p>
      </div>
      <p>
        <a href="product_list.php">View Technicians List</a> | 
        <a href="add_product_form.php">Add Another Technician</a> | 
        <a href="index.php">Back to Home</a>
      </p>
    </main>
    <?php include("footer.php"); ?>
  </body>
</html>
