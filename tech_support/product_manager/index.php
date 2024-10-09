<?php
  require('../model/database.php');

  try {
    $query = 'SELECT * FROM products';
    $statement = $db->prepare($query);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
  } catch (PDOException $e) {
    echo 'Database Error: ' . $e->getMessage();
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Product Manager</title>
    <link rel="stylesheet" type="text/css" href="/PHPAssignment3/tech_support/css/main.css">
  </head>
  <body>
    <?php include('../view/header.php'); ?>
    <main>
      <h1>Product List</h1>
      <table>
        <thead>
          <tr>
            <th>Product Code</th>
            <th>Name</th>
            <th>Version</th>
            <th>Release Date</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $product) : ?>
            <?php $date = new DateTime($product['releaseDate']);
                  $formattedDate = $date->format('n-j-Y'); 
            ?>

            
          <tr>
            <td><?php echo htmlspecialchars($product['productCode']); ?></td>
            <td><?php echo htmlspecialchars($product['name']); ?></td>
            <td><?php echo htmlspecialchars($product['version']); ?></td>
            <td><?php echo htmlspecialchars($formattedDate); ?></td>
            <td>
              <form action="delete_product.php" method="post">
                <input type="hidden" name="product_code" value="<?php echo htmlspecialchars($product['productCode']); ?>">
                <input type="submit" value="Delete">
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <a href="/PHPAssignment3/tech_support/product_manager/add_product_form.php">Add product</a>
    </main>
    <?php include('../view/footer.php'); ?>
  </body>
</html>
