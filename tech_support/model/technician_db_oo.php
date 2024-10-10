<?php 

require_once('database_oo.php');
require_once('technician.php');

class TechnicianDB {
  private $db;

  public function __construct() {
    $this->db = Database::getDB();
  }

  // method to retrieve all technicians from the database
  public function getAllTechnicians() {
    try {
      $query = 'SELECT * FROM technicians ORDER BY lastName, firstName';
      $statement = $this->db->prepare($query);
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      $statement->closeCursor();
  
      $technicians = [];
      foreach ($rows as $row) {
        $technicians[] = new Technician(
          $row['techID'],
          $row['firstName'],
          $row['lastName'],
          $row['email'],
          $row['phone'],
          $row['password']
        );
      }
      return $technicians; 
    } catch (PDOException $e) {
      $this->handleDatabaseError($e, "Unable to retrieve technicians. Please try again.");
    }
  }

  // method to add a technician to the database
  public function addTechnician(Technician $technician) {
    try {
      $query = 'INSERT INTO technicians (firstName, lastName, email, phone, password)
                VALUES (:first_name, :last_name, :email, :phone, :password)';
      $statement = $this->db->prepare($query);
      $statement->bindValue(':first_name', $technician->getFirstName(), PDO::PARAM_STR);
      $statement->bindValue(':last_name', $technician->getLastName(), PDO::PARAM_STR);
      $statement->bindValue(':email', $technician->getEmail(), PDO::PARAM_STR);
      $statement->bindValue(':phone', $technician->getPhone(), PDO::PARAM_STR);
      $statement->bindValue(':password', $technician->getPassword(), PDO::PARAM_STR);
      $statement->execute();
      $statement->closeCursor();
    } catch (PDOException $e) {
      $this->handleDatabaseError($e, "Unable to add technician. Please try again.");
    }
  }

  // method to delete a technician from the database by techID
  public function deleteTechnician($techID) {
    try {
      $query = 'DELETE FROM technicians WHERE techID = :techID';
      $statement = $this->db->prepare($query);
      $statement->bindValue(':techID', $techID, PDO::PARAM_INT);
      if ($statement->execute()) {
        error_log("Technician with ID $techID deleted successfully.");
      } else {
        error_log("Technician with ID $techID deletion failed.");
      }
      $statement->closeCursor();
    } catch (PDOException $e) {
      $this->handleDatabaseError($e, "Unable to delete technician. Please try again.");
    }
  }

  // method to get a technician by ID
  public function getTechnicianByID($techID) {
    try {
      $query = 'SELECT * FROM technicians WHERE techID = :techID';
      $statement = $this->db->prepare($query);
      $statement->bindValue(':techID', $techID, PDO::PARAM_INT);
      $statement->execute();
      $row = $statement->fetch(PDO::FETCH_ASSOC);
      $statement->closeCursor();
  
      if ($row) {
        return new Technician(
          $row['techID'],
          $row['firstName'],
          $row['lastName'],
          $row['email'],
          $row['phone'],
          $row['password']
        );
      } else {
        return null;
      }
    } catch (PDOException $e) {
      $this->handleDatabaseError($e, "Unable to retrieve technician details. Please try again.");
    }
  }

  // method to update a technician's details
  public function updateTechnicians(Technician $technician) {
    try {
      $query = 'UPDATE technicians
                SET firstName = :first_name, lastName = :last_name, email = :email, phone = :phone, password = :password
                WHERE techID = :techID';
      $statement = $this->db->prepare($query);
      $statement->bindValue(':first_name', $technician->getFirstName(), PDO::PARAM_STR);
      $statement->bindValue(':last_name', $technician->getLastName(), PDO::PARAM_STR);
      $statement->bindValue(':email', $technician->getEmail(), PDO::PARAM_STR);
      $statement->bindValue(':phone', $technician->getPhone(), PDO::PARAM_STR);
      $statement->bindValue(':password', $technician->getPassword(), PDO::PARAM_STR);
      $statement->bindValue(':techID', $technician->getTechID(), PDO::PARAM_INT);
      $statement->execute();
      $statement->closeCursor();
    } catch (PDOException $e) {
      $this->handleDatabaseError($e, "Unable to update technician. Please try again.");
    }
  }

 
  private function handleDatabaseError($exception, $userMessage) {
    error_log("Database Error: " . $exception->getMessage());
    $_SESSION['error_message'] = $userMessage;

    header("Location: ../errors/database_error.php");
    exit();
  }
}

?>
