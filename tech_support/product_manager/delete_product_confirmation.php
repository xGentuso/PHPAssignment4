<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" type="text/css" href="/PHPAssignment3/tech_support/css/main.css">
    <title>Delete - Confirmation</title>
  </head>
  <body>
    <?php include ("header.php"); ?>
    <main>
      <div>
        <h2>
          Production has been deleted.    
        </h2>
        <p>
          <?php echo htmlspecialchars($_SESSION['name']); ?> has been deleted from your product list.
        </p>
      </div>
      <p><a href="index.php">Back to home</a></p>
    </main>
    <?php include ("footer.php"); ?>
  </body>
</html>
