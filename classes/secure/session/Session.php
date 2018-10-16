<?php

/**
 * @author Thomas
 */
class Session
{

    private $connection;

    function __construct(SQLConnection $connection)
    {
        $this->connection = $connection;
    }

    public function redirect($path) {
        header('Location: '. $path);
        exit();
    }

    public function getConnection() {
        return $this->connection;
    }

    public function generateSessionHash($username) {
        $rand = time() + rand(1, 100000);
        $session_hash = md5($rand . $this->generateRandomString());

        // make sure there are no existing session with this hash
        $this->connection->query("SELECT * FROM accounts WHERE session_hash = ?", array($session_hash), false);
        if ($this->connection->getRowAmount() != 0) {
            $this->generateSessionHash($username);
            return;
        }

        // update the session hash in the database
        $this->connection->query("UPDATE accounts SET session_hash = ? WHERE username = ? LIMIT 1", array($session_hash, $username), false);

        $_SESSION['hash'] = $session_hash;
    }

    private function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getUserAmount() {
        $this->connection->query("SELECT * FROM accounts", array(), false);
        return $this->connection->getRowAmount();
    }

}