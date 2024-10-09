<?php
  session_start();
  
  // regenerate session ID for security
  session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" type="text/css" href="/PHPAssignment3/tech_support/css/main.css">
    <title>Add Product - Confirmation</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <?php include("header.php"); ?>
    <main>
      <div>
        <h2>Thank you for adding a new product.</h2>
        <p>
          <?php 
            if (isset($_SESSION['name'])) {
              echo htmlspecialchars($_SESSION['name']); 
              unset($_SESSION['name']); // Clear the session variable after use
            } else {
              echo "The product";
            }
          ?> has been added to your contact list.
        </p>
      </div>
      <p>
        <a href="product_list.php">View Contact List</a> | 
        <a href="add_product_form.php">Add Another Product</a> | 
        <a href="index.php">Back to Home</a>
      </p>
    </main>
    <?php include("footer.php"); ?>
  </body>
</html>
