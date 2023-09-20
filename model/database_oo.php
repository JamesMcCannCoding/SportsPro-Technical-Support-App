<?php
    $dsn = 'mysql:host=localhost;dbname=tech_support';
    $username = 'ts_user';
    $password = 'pa55word';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }

    class Database {
        private $host = 'localhost';
        private $dbname = 'tech_support';
        private $username = 'ts_user';
        private $password = 'pa55word';
        public $db;
    
        public function __construct() {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
            try {
                $this->db = new PDO($dsn, $this->username, $this->password);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include('../errors/database_error.php');
                exit();
            }
        }
    
        public function getDB() {
            return $this->db;
        }
    }
    
// Include the Database class
require_once('database.php');

// Create a new Database object
$database = new Database();

// Get the database connection
$db = $database->getDB();
?>