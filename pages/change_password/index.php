<?php
/**
 * @author Thomas
 */
if (count(get_required_files()) <= 1) {
    header("Location: ?page=main");
    exit;
}

require 'classes/secure/SQLConnection.php';
require 'classes/secure/session/Session.php';
require 'classes/secure/Config.php';

require 'classes/account/Account.php';

$connection = new SQLConnection();

$session = new Session($connection);
$account = new Account($session);

if (!$account->isLoggedIn()) {
    $session->redirect('?page=login');
    exit;
}

if (isset($_POST['current']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
    $valid = $account->isValidPassword($_POST['current']);
    $matches = $_POST['password'] == $_POST['confirm_password'];
    if ($valid && $matches) {
        $account->updatePassword($_POST['password']);
    }
}

?>
<head>
    <link rel="shortcut icon" href="img/favicon.ico" />
    <title><?php echo $title; ?></title>
    <link href="css/basic-3.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/change_password/main.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/change_password/forum-3.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
    <div id="body">
        <?php $account->createNavigation() ?>
        <br>
        <br>
        <center>
            <?php
                if (isset($valid) && isset($matches)) {
                    if ($valid && $matches) {
                        require 'includes/success.php';
                    } else {
                        require 'includes/invalid.php';
                    }
                } else {
                    require 'includes/change.php';
                }
            ?>
        </center>
    </div>
</body>
<footer>
    <div class="tandc">
        <?php echo $footer ?>
    </div>
</footer>
