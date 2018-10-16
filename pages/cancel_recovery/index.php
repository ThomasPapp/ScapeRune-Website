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

$id = $account->getId();

$connection->query("SELECT * FROM pending_recovery_questions WHERE id = ?", array($id), false);

$pending = $connection->getRowAmount() > 0;
?>
<head>
    <link rel="shortcut icon" href="img/favicon.ico" />
    <title><?php echo $title; ?></title>
    <link href="css/basic-3.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/recovery/main.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/recovery/forum-3.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
<div id="body">
    <?php $account->createNavigation() ?>
    <br>
    <br>
    <center>
        <table bgcolor="black" border="0" cellpadding="4" width="500" class="e">
            <tbody>
            <tr>
                <?php
                    if (!$pending)
                        require 'includes/none_pending.php';
                    else
                        require 'includes/cancel_pending.php'
                ?>
            </tr>
            </tbody>
        </table>
    </center>
</div>
</body>
<footer>
    <div class="tandc">
        <?php echo $footer ?>
    </div>
</footer>
