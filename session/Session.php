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

    public function generateCookie($session_time, $domain, $username) {
        $cookie_hash = md5(time() . $this->generateRandomString());

        // make sure there are no existing cookies with this hash
        $this->connection->query("SELECT * FROM accounts WHERE cookie = ?", array($cookie_hash), false);
        if ($this->connection->getRowAmount() != 0) {
            $this->generateCookie($session_time, $domain, $username);
            return;
        }

        // update the cookie in the database
        $this->connection->query("UPDATE accounts SET cookie = ? WHERE username = ? LIMIT 1", array($cookie_hash, $username), false);

        // this is only used for localhost!
        setcookie('account', $cookie_hash, time() + $session_time, '/');


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