<?php

/**
 * @author Thomas
 */
class CreationHandler {

    private $session;

    public function __construct(Session $session) {
        $this->session = $session;
    }

    public function validEmail($email) {
        $this->session->getConnection()->query("SELECT * FROM accounts WHERE email = ? LIMIT 1", array($email), true);

        if($this->session->getConnection()->getRowAmount() > 0)
            return false;

        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function validUsername($username) {
        $this->session->getConnection()->query("SELECT * FROM accounts WHERE username = ? LIMIT 1", array($username), true);

        if($this->session->getConnection()->getRowAmount() > 0) {
            return false;
        }
        else if(strlen($username) > 12 || strlen($username) == '') {
            return false;
        }
        else {
            $err = 0;

            //make sure word doesn't contain a illegal character
            if(preg_match('/[^a-zA-Z0-9_ ]/', $username)) $err = 1;

            //make sure their username doesn't start with these restricted words
            $restricted = array('mod', 'admin', 'fuck', 'f u c k', 'f  u  c  k', 'f  u  c   k', 'f   uc k', 'f  u   c  k', 'f   u  c   k', 'fucker', 'f  u  c  k  e  r', 'queer',
                'cunt', 'bitch', 'biatch', 'slut', 'nigger', 'n1gger', 'kike', 'sloot', 'shit', 'shite', '2006scape', 'ass', 'cock', 'pussy', 'vagina', 'scrotum', 'dick', 'd1ck',
                'penis', 'pen1s', 'p3n1s', 'tit', 'tits', 'homo', 'homosexual', 'fudgepacker', 'jizz', 'cum', 'bellend', 'penis', 'anal', 'anus', 'labia', 'bum-fucker', 'asshole',
                'clit', 'fanny', 'porno', 'scaperune', 'runescape');

            foreach($restricted as $word) {
                if(substr_count(strtolower($username), $word, 0) && strlen($username) >= strlen($word)) $err = 1;
            }

            return ($err == 0) ? true : false;
        }
    }

    private function generateSessionHash() {
        $hash = md5(time() . $this->generateRandomString());

        // make sure there are no existing sessions with this hash
        $this->session->getConnection()->query("SELECT * FROM accounts WHERE session_hash = ?", array($hash), false);
        if ($this->session->getConnection()->getRowAmount() != 0) {
            return $this->generateSessionHash();
        }
        return $hash;
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

    public function createAccount($age, $country, $username, $email, $password) {
        $session_hash = $this->generateSessionHash();
        $this->session->getConnection()->query("INSERT INTO accounts VALUES(null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            array($username, $username, $email, $password, 0, $age, $country, $_SERVER['REMOTE_ADDR'], date('M-d-Y'), $_SERVER['REMOTE_ADDR'], time(), $session_hash), false);
        return $session_hash;
    }


}