<?php

/**
 * @author Thomas
 */
class Account
{

    private $session;

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

    public function isLoggedIn() {
        return isset($_SESSION['hash']);
    }

}