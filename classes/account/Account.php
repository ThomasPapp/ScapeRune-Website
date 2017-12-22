<?php

/**
 * @author Thomas
 */
class Account
{

    private $session;

    private $id = null;

    private $username = null;

    private $display_name = null;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function createNavigation() {

        ?>
        <div class="frame e">
        <span style="float: right;">
            <?php
                if ($this->isLoggedIn()) {
                    echo '<a href="?page=main">Main Page</a> | <a href="?page=logout">Logout</a>';
                } else {
                    echo '<a href="?page=main">Main Page</a> | <a href="?page=login">Login</a>';
                }
            ?>
        </span>

            <?php
                if ($this->isLoggedIn()) {
                    $display_name = $this->getDisplayName();
                    echo '<div>You are logged in as <span style="color: rgb(255, 187, 34);">'. $display_name .'</span></div>';
                } else {
                    echo 'You are not logged in.';
                }
            ?>
        </div>
        <?php
    }

    public function getDisplayName() {
        if ($this->display_name != null) {
            return $this->display_name;
        }
        $cookie = isset($_SESSION['hash']) ? $_SESSION['hash'] : null;
        if ($cookie == null) {
            return 'null';
        }
        $information = $this->session->getConnection()->query("SELECT display_name FROM accounts WHERE cookie = ?", array($cookie), true);
        return $this->display_name = $information[0]['display_name'];
    }

    public function isValidPassword($raw_password) {
        $password = hash(sha256, md5(sha1($raw_password)));

        $cookie = isset($_SESSION['hash']) ? $_SESSION['hash'] : null;
        if ($cookie == null) {
            return false;
        }

        // the information from the database
        $information = $this->session->getConnection()->query("SELECT password FROM accounts WHERE cookie = ?", array($cookie), true);

        if ($this->session->getConnection()->getRowAmount() == 0) {
            return false;
        }

        // the password stored in the database
        $database_password = substr(substr($information[0]['password'], 54), 0, -3);
        return $password == $database_password;
    }

    public function updatePassword($raw_password) {
        $salt = substr(hash(sha256, sha1(time())), 10);
        $password = $salt.hash(sha256, md5(sha1($raw_password))).substr($salt, 0, -51);
        $id = $this->getId();
        $this->session->getConnection()->query("UPDATE accounts SET password = ? WHERE id = ?", array($password, $id), false);
    }

    public function getId() {
        if (!isset($_SESSION['hash'])) {
            return -1;
        }

        if ($this->id != null) {
            return $this->id;
        }

        $information = $this->session->getConnection()->query("SELECT id FROM accounts WHERE cookie = ?", array($_SESSION['hash']), true);
        return $this->id = $information[0]['id'];
    }

    public function isLoggedIn() {
        return isset($_SESSION['hash']);
    }

}