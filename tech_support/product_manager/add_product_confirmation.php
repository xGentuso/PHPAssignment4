<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" type="text/css" href="tech_support/css/main.css">
    <title>Product Added</title>
  </head>
  <body>
    <?php include("header.php"); ?>
    <main>
      <div>
        <h2>
          Thank You for adding a new product.
        </h2>
        <p>
          <?php echo htmlspecialchars($_SESSION['name']); ?> has been added to your product list.
        </p>
      </div>
      <p><a href="index.php">Back to home</a></p>
    </main>
    <?php include("footer.php"); ?>
  </body>
</html>
