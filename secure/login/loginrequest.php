<?php

/**
 * @author Thomas
 */

session_start();

require '../../session/Session.php';
require '../../secure/SQLConnection.php';
require '../../secure/Config.php';

$connection = new SQLConnection();

$session = new Session($connection);

if (!isset($_POST['username']) && !isset($_POST['password'])) {
    $session->redirect('../../index.php');
    exit;
}

// login forum details
$username = $_POST['username'];
$raw_password = $_POST['password'];
$password = hash(sha256, md5(sha1($raw_password)));

// the information from the database
$information = $connection->query("SELECT password FROM accounts WHERE username = ?", array($username), true);

// the password stored in the database
$database_password = substr(substr($information[0]['password'], 54), 0, -3);

// the information we're returning on the page
$return_information = '';

if ($password != $database_password || $connection->getRowAmount() == 0) {
    $return_information = 'Incorrect login details. <input type="button" value="Back" onclick="goBack()" />';
    $connection->query("INSERT INTO incorrect_logins VALUES (?, ?, ?, ?)", array($username, $raw_password, date('M-d-Y'), $_SERVER['REMOTE_ADDR']), false);
} else {
    $session->generateCookie($session_time, $domain, $username);
    $session->redirect('../../');
    exit;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns:IE>

<!-- LeeStrong Runescape Website Source --!>
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<!-- /Added by HTTrack -->
<head>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="MSSmartTagsPreventParsing" content="TRUE">
    <link href="../../css/basic-3.css" rel="stylesheet" type="text/css" media="all">
    <link rel="shortcut icon" href="../../img/favicon.ico"/>
    <title><?php echo $title; ?></title>
    <script type="text/javascript">
        function goBack() {
            window.history.back();
        }
    </script>
</head>
<body>

<div id="body">
    <div style="text-align: center; background: none;">
        <div class="titleframe e">
            <b>Login</b><br>
            <a href="index" class=c>Main Menu</a>
        </div>
    </div>
    <br>
    <br>

    <div class="frame wide_e">
        <div style="text-align: justify">
            <center>
                <?php echo $return_information; ?>
            </center>
        </div>
    </div>
    <br>

    <div class="tandc"><?php echo $footer ?></div>

</div>

</body>

<!-- LeeStrong Runescape Website Source --!>
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<!-- /Added by HTTrack -->
</html>