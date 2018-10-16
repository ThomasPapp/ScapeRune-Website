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

if (isset($_POST['username']) && isset($_POST['type'])) {
    $username = $_POST['username'];
    $recoverType = $_POST['type'];
    $form = $recoverType > 0;
}
?>
<head>
    <link rel="shortcut icon" href="img/favicon.ico" />
    <title><?php echo $title; ?></title>
    <link href="css/basic-3.css" rel="stylesheet" type="text/css" media="all">
    <?php
        if (isset($form) && $form) {
            ?>
            <link href="css/recovery/recover/main.css" rel="stylesheet" type="text/css" media="all">
            <link href="css/recovery/recover/forum-3.css" rel="stylesheet" type="text/css" media="all">
    <?php
        }
        else {
            ?>
            <link href="css/recovery/main.css" rel="stylesheet" type="text/css" media="all">
            <link href="css/recovery/forum-3.css" rel="stylesheet" type="text/css" media="all">
    <?php
        }
    ?>
</head>
<body>
    <div id="body">
        <?php $account->createNavigation() ?>
        <br>
        <br>
        <?php
            if (!isset($recoverType))
                require 'includes/recover.php';
            else {
                if ($recoverType == 0)
                    require 'includes/recover.php';
                else
                    require 'includes/form.php';
            }
        ?>
    </div>
</body>