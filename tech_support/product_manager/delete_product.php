<?php
  session_start();
  require('../model/database.php');

  // Retrieve and sanitize the product code from POST data
  $product_code = filter_input(INPUT_POST, 'product_code');

  if ($product_code == NULL || $product_code == FALSE) {
    $error = "Invalid product code. Check all fields and try again.";
    include('../errors/error.php');
  } else {
    try {
      // prepare the DELETE statement to remove the product
      $query = 'DELETE FROM products WHERE productCode = :product_code';
      $statement = $db->prepare($query);
      $statement->bindValue(':product_code', $product_code, PDO::PARAM_STR);
      $statement->execute();
      $statement->closeCursor();

      // redirect to confirmation page after successful deletion
      $url = 'delete_product_confirmation.php';
      header("Location: " . $url);
      die();
      
    } catch (PDOException $e) {
      // log the error message for debugging (optional)
      error_log("Database Error: " . $e->getMessage());

      // set the error message and include the database error page
      $error_message = "An error occurred while deleting the product. Please try again later.";
      include('../errors/database_error.php');
      exit();
    }
  }
?>
