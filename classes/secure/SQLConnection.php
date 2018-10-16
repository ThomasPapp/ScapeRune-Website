<?php

/**
 * @author Thomas
 */
class SQLConnection
{

    // The SQL connection to the database
    private $connection;

    // The SQL database information
    private $host = 'localhost';
    private $username = 'root';
    private $name = 'scaperune';
    private $password = '';

    // Fields regarding SQL an query
    private $row_amount;

    public function __construct()
    {
        $this->connection = new PDO("mysql:host=$this->host;dbname=$this->name", $this->username, $this->password);
    }

    public function kill() {
        $this->connection = null;
    }

    public function query($query, array $params, $fetch_all) {
        $prepared_statement = $this->connection->prepare($query);
        if (!$prepared_statement->execute($params)) {
            $error = $prepared_statement->errorInfo();
            echo $error[2];
        }

        $this->connection->lastInsertId();

        // set the row amount
        $this->row_amount = $prepared_statement->rowCount();

        if ($fetch_all == true) {
            return $prepared_statement->fetchAll();
        }
        return $prepared_statement->fetch();
    }

    public function getRowAmount() {
        return $this->row_amount;
    }

    public function checkBruteLogin( $username ) {
        $now = time();

        // Timestamp for the past 15 minutes from the current time
        $login_attempts = $now - ( 15 * 60 );

        // Get all login attempts past 15 minutes
        $past_login_attempts = $this->connection->query("SELECT timestamp FROM incorrect_logins WHERE username = ? AND timestamp > ?", array($username, $login_attempts), true);

        // If the user has more than 3 failed login past 15 minutes
        if( count( $past_login_attempts ) > 3 ) {
            return true;
        }

        return false;
    }
}