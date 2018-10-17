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

    public function redirect($path)
    {
        header('Location: ' . $path);
        exit();
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function generateSessionHash($username)
    {
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

    private function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getUserAmount()
    {
        $this->connection->query("SELECT * FROM accounts", array(), false);
        return $this->connection->getRowAmount();
    }


    public function checkBruteForce($username)
    {
        $currentTime = time();

        // 15 minutes prior to the current time
        $timeToCheck = $currentTime - (1 * 60);

        // all of the incorrect login attempts in the past 15 minutes for the user
        $incorrectAttempts = $this->connection->query("SELECT timestamp FROM incorrect_logins WHERE username = ? AND timestamp > ?", array($username, $timeToCheck), true);

        $amount = count($incorrectAttempts);

        // if the user has no incorrect attempts in the past 15 minutes we clear all
        // previous attempts
        if ($amount < 1)
            $this->connection->query("DELETE FROM incorrect_logins WHERE username = ?", array($username), false);

        return $amount > 1;
    }

    public function lockAccount($username, $time)
    {
        // the timestamp of the current lock
        $timestamp = $this->connection->query("SELECT timestamp FROM locked_accounts WHERE username = ?", array($username), true);

        $currentTime = time();

        $exists = $this->connection->getRowAmount() > 0;

        // the account is not currently locked, so lets lock it
        if (!$exists || $timestamp[0]['timestamp'] < $currentTime) {
            $lockTime = $currentTime + ($time * 60);
            if ($exists)
                $this->connection->query("UPDATE locked_accounts SET timestamp = ? WHERE username = ?", array($lockTime, $username), false);
            else
                $this->connection->query("INSERT INTO locked_accounts VALUES (?, ?)", array($username, $lockTime), false);
        }
    }

    public function unlockAccount($username) {
        $this->connection->query("DELETE FROM locked_accounts WHERE username = ?", array($username), false);
    }

    public function getRemainingLockTime($username) {
        $timestamp = $this->connection->query("SELECT timestamp FROM locked_accounts WHERE username = ?", array($username), true);

        $exists = $this->connection->getRowAmount() > 0;

        return !$exists ? null : round(($timestamp[0]['timestamp'] - time()) / 60);
    }

    public function isLocked($username) {
        return $this->getRemainingLockTime($username) < 1;
    }
}