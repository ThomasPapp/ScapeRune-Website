<?php
/**
 * @author Thomas
 */
require_once 'classes/secure/Config.php';

if (isset($_SESSION['hash'])) {
    session_unset();
}

header('Location: ?page=main');
exit;