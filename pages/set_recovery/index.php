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

// check if the recovery form was actually submitted
if (isset($_POST['password'])) {
    // set the flag indicating that the forum has been submitted
    $submitted = true;

    // now check their if the password submitted is valid
    $valid = $account->isValidPassword($_POST['password']);

    $submitted_questions = [
        0 => $_POST['question0'],
        1 => $_POST['question1'],
        2 => $_POST['question2'],
        3 => $_POST['question3'],
        4 => $_POST['question4'],
    ];

    $submitted_answers = [
        0 => $_POST['answer0'],
        1 => $_POST['answer1'],
        2 => $_POST['answer2'],
        3 => $_POST['answer3'],
        4 => $_POST['answer4'],
    ];
}
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
                        if (!isset($submitted)) {
                            require 'includes/set_recoveries.php';
                        } else {
                            if (isset($valid)) {
                                if (!$valid) {
                                    require 'includes/invalid_password.php';
                                } else {
                                    require 'includes/success.php';
                                }
                            }
                        }
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
