<?php
session_start();

$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$version = filter_input(INPUT_POST, 'version', FILTER_VALIDATE_FLOAT);
$release_date_input = filter_input(INPUT_POST, 'release_date');

if ($code == NULL || $name == NULL || $version == NULL || $release_date_input == NULL) {
  $_SESSION['error_message'] = "Invalid product data. Check all fields and try again.";
  $url = '../errors/error.php';
  header("Location: " . $url);
  die();
}

try {
  // convert the user-provided date to a standard format (Y-m-d)
  $date = new DateTime($release_date_input);
  $release_date = $date->format('Y-m-d');
} catch (Exception $e) {
  $_SESSION['error_message'] = "Invalid date format. Please enter a valid date.";
  header("Location: ../errors/error.php");
  exit();
}

try {
  require_once('../model/database.php');
  $query = 'INSERT INTO products (productCode, name, version, releaseDate) 
            VALUES (:code, :name, :version, :release_date)';

  $statement = $db->prepare($query);
  $statement->bindValue(':code', $code);
  $statement->bindValue(':name', $name);
  $statement->bindValue(':version', $version, PDO::PARAM_STR);
  $statement->bindValue(':release_date', $release_date);
  $statement->execute();
  $statement->closeCursor();

  // redirect to confirmation page
  $url = 'add_product_confirmation.php';
  header("Location: " . $url);
  die();

} catch (PDOException $e) {
  // check if the error is due to a duplicate primary key
  if ($e->getCode() == 23000) { 
    $_SESSION['error_message'] = "The product code already exists. Please use a unique product code.";
  } else {
    // if some other database error occurred
    $_SESSION['error_message'] = "Database error: " . $e->getMessage();
  }
  $url = '../errors/error.php';
  header("Location: " . $url);
  die();
}
?>
