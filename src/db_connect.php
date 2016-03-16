<?php
 
/**
 * A class file to connect to database
 */
class DB_CONNECT {

    private $con = null;
 
    // constructor
    function __construct() {
        // connecting to database
        $this->connect();
    }
 
    // destructor
    function __destruct() {
        // closing db connection
        $this->close();
    }
 
    /**
     * Function to connect with database
     */
    function connect() {
        // import database connection variables
        require_once __DIR__ . '/db_config.php';

        try {
            // Connecting to mysql database
            $this->con = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

        // returning connection
        return $this->con;
    }

    /**
     * Function get con object
     */
    function getCon() {
        return $this->con;
    }
 
    /**
     * Function to close db connection
     */
    function close() {
        // setting connection null
        $this->con = null;
    }
}