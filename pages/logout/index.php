<?php
/**
 * @author Thomas
 */
require_once 'classes/secure/Config.php';

// this is only used for localhost!
if (isset($_COOKIE['account'])) {
    setcookie('account', null, time() - $session_time, '/');
}


//        setcookie('account', $cookie_hash, time() + $session_time, '/', $domain,true, true);

if (isset($_SESSION['hash'])) {
    unset($_SESSION['hash']);
}

header('Location: ?page=main');
exit;