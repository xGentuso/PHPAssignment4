<?php
class Database {
  private static $dsn = 'mysql:host=localhost;dbname=tech_support';
  private static $username = 'root';
  private static $password = 'Shineteam00';
  private static $db;

  private function __construct() {
  }

  public static function getDB() {
    if (!isset(self::$db)) {
      try {
        self::$db = new PDO(self::$dsn, self::$username, self::$password);
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit();
      }
    }
    return self::$db;
  }
}
?>
