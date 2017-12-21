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

    public function generateSessionHash($session_time, $domain, $username) {
        $session_hash = md5(time() . $this->generateRandomString());

        // make sure there are no existing cookies with this hash
        $this->connection->query("SELECT * FROM accounts WHERE cookie = ?", array($session_hash), false);
        if ($this->connection->getRowAmount() != 0) {
            $this->generateSessionHash($session_time, $domain, $username);
            return;
        }

        // update the cookie in the database
        $this->connection->query("UPDATE accounts SET cookie = ? WHERE username = ? LIMIT 1", array($session_hash, $username), false);

        $_SESSION['hash'] = $session_hash;

        // use this code for live website!
//        setcookie('account', $cookie_hash, time() + $session_time, '/', $domain,true, true);
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

}