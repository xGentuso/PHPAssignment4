<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Add Technician</title>
    <link rel="stylesheet" type="text/css" href="/PHPAssignment3/tech_support/css/main.css">
  </head>
  <body>
    <?php include('../view/header.php'); ?>
    <main>
      <h1>Add Technician</h1>
      
      <!-- Display Error Messages -->
      <?php if (isset($_SESSION['error_message'])): ?>
        <div class="error">
          <p><?php echo htmlspecialchars($_SESSION['error_message']); ?></p>
        </div>
        <?php unset($_SESSION['error_message']); ?>
      <?php endif; ?>
      
      <form action="add_technician.php" method="post" id="aligned">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br>
        
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        
        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890" required><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters"><br>
        
        <label>&nbsp;</label>
        <input type="submit" value="Add Technician"><br>
      </form>
      
      <p>
        <a href="PHPAssignment3/tech_support/technician_manager">View Technicians List</a> | 
        <a href="add_technician_form.php">Add Another Technician</a> | 
        <a href="index.php">Back to Home</a>
      </p>
      
      <?php include('../view/footer.php'); ?>   
    </main>
  </body>
</html>
