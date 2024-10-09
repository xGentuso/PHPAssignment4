<?php
// technician_manager/index.php

session_start();

require_once('../model/database_oo.php');
require_once('../model/technician.php');
require_once('../model/technician_db_oo.php');

$technicianDB = new TechnicianDB();

try {
  $technicians = $technicianDB->getAllTechnicians();
} catch (Exception $e) {
  $_SESSION['error_message'] = "Unable to retrieve technicians.";
  header("Location: ../errors/error.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Technician Manager</title>
  <link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
  <?php include("../view/header.php"); ?>
  <main>
    <h1>Technicians List</h1>
    <?php if (empty($technicians)): ?>
      <p>No technicians found.</p>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>Technician ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($technicians as $technician): ?>
            <tr>
              <td><?php echo htmlspecialchars($technician->getTechID()); ?></td>
              <td><?php echo htmlspecialchars($technician->getFullName()); ?></td>
              <td><?php echo htmlspecialchars($technician->getEmail()); ?></td>
              <td><?php echo htmlspecialchars($technician->getPhone()); ?></td>
              <td>
                <form action="delete_technician.php" method="post">
                  <input type="hidden" name="technician_id" value="<?php echo htmlspecialchars($technician->getTechID()); ?>">
                  <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                  <input type="submit" value="Delete">
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
    <a href="add_technician_form.php">Add Technician</a>
  </main>
  <?php include("../view/footer.php"); ?>
</body>
</html>
