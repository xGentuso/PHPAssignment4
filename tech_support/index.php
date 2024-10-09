<!DOCTYPE html>
<html lang="en">
<!-- the head section -->
<head>
  <meta charset="UTF-8">
  <title>SportProp</title>
  <link rel="stylesheet" href="/PHPAssignment3/tech_support/css/main.css" />
</head>

<!-- the body section -->
<body>
  <?php include 'view/header.php'; ?>
  <main>
    <nav>
      <section>
        <h2>Administrators</h2>
        <ul>
          <li><a href="product_manager">Manage Products</a></li>
          <li><a href="technician_manager">Manage Technicians</a></li>
          <li><a href="under_construction.php">Manage Customers</a></li>
          <li><a href="under_construction.php">Create Incident</a></li>
          <li><a href="under_construction.php">Assign Incident</a></li>
          <li><a href="under_construction.php">Display Incidents</a></li>
        </ul>
      </section>

      <section>
        <h2>Technicians</h2>    
        <ul>
          <li><a href="under_construction.php">Update Incident</a></li>
        </ul>
      </section>

      <section>
        <h2>Customers</h2>
        <ul>
          <li><a href="under_construction.php">Register Product</a></li>
        </ul>
      </section>
    </nav>
  </main>
  <footer>
    <?php include 'view/footer.php'; ?>
  </footer>
</body>
</html>
