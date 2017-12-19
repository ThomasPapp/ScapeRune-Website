<?php
/**
 * @author Thomas
 */

session_start();

require '../../secure/SQLConnection.php';
require '../../secure/Config.php';
require '../../session/Session.php';
require '../../account/Account.php';
require '../../account/creation/CreationHandler.php';

$connection = new SQLConnection();

$session = new Session($connection);
$account = new Account($session);
$handler = new CreationHandler($session);

if ($account->isLoggedIn()) {
    $session->redirect('../../');
    exit;
}

$error_message = null;

$stage = 0;

if(isset($_POST['age']) && isset($_POST['country'])) {
    if($stage == 0 && !in_array($_POST['age'], array('Below 13', '13-18', '19-24', '25-30', '31-36', '36-39', '40+')) || !ctype_digit($_POST['country'])) {
        $error_message = 'Invalid age or country.</br></br> <input type="button" value="Back" onclick="window.location.href=window.location.href"/>';
    } else {
        $stage = 1;
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['country'] = $_POST['country'];
    }
}

if (isset($_POST['username'])) {
    if ($stage == 1 && !$handler->validUsername(trim($_POST['username']))) {
        $error_message = 'This username is not available.</br></br> <input type="button" value="Back" onclick="window.location.href=window.location.href"/>';
    } else {
        $stage = 2;
        $_SESSION['username'] = $_POST['username'];
    }
}

if (isset($_POST['terms'])) {
    $stage = 3;
}

if (isset($_POST['password']) && isset($_POST['password_confirm'])) {
    if ($_POST['password'] != $_POST['password_confirm']) {

    } else {
        $stage = 4;
        $salt = substr(hash(sha256, sha1(time())), 10);
        $password = $salt.hash(sha256, md5(sha1($_POST['password']))).substr($salt, 0, -51);
        $username = $_SESSION['username'];
        $session_hash = $handler->createAccount($_SESSION['age'], $_SESSION['country'], $_SESSION['username'], $password);
        session_unset();
        $_SESSION['hash'] = $session_hash;
    }
}

$boxes = [
    'age_loc' => $stage == 0 ? 'cur' : 'fin',
    'username' => $stage > 1 ? 'fin' : ($stage == 1 ? 'cur' : 'box'),
    'terms' => $stage > 2 ? 'fin' : ($stage == 2 ? 'cur' : 'box'),
    'password' =>  $stage > 3 ? 'fin' : ($stage == 3 ? 'cur' : 'box'),
    'finish' => $stage == 4 ? 'cur' : 'box'
];
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="MSSmartTagsPreventParsing" content="TRUE">
    <link rel="shortcut icon" href="../../img/favicon.ico" />
    <title><?php echo $title; ?></title>
    <link href="../../css/basic-3.css" rel="stylesheet" type="text/css" media="all">
    <link href="../../css/register-1.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
    <div id="body">
        <div style="text-align: center; background: none;">
            <div class="titleframe e">
                <b>Create account</b><br>
                <a href="../../">Main Menu</a>
            </div>
        </div>
        <br>
    </div>

    <div id="reg">
        <table cellspacing="0" cellpadding="0">
            <tbody><tr>
                <?php
                    echo '<td id="ageReg" class="'. $boxes['age_loc'] .'">Indicate Age and Location</td>';
                    echo '<td id="usernameReg" class="'. $boxes['username'] .'">Choose a Username</td>';
                    echo '<td id="termsReg" class="'. $boxes['terms'] .'">Terms and Conditions</td>';
                    echo '<td id="passwordReg" class="'. $boxes['password'] .'">Choose a Password</td>';
                    echo '<td id="finishReg" class="'. $boxes['finish'] .'">Finish</td>';
                ?>
            </tr>
            </tbody></table>
    </div>

    <?php
        if ($error_message != null) {
            ?>
    <div class="frame wide_e">
        <table width="100%">
            <tbody>
            <tr>
                <td style="text-align: justify; vertical-align: top;">
                    <center> <?php echo $error_message; ?></center>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <?php
        } else {
            if ($stage == 0) {
                include_once '../../account/creation/includes/agelocation.php';
            }
            if ($stage == 1) {
                include_once '../../account/creation/includes/chooseusername.php';
            }
            else if ($stage == 2) {
                include_once '../../account/creation/includes/termsandconditions.php';
            }
            else if ($stage == 3) {
                include_once '../../account/creation/includes/password.php';
            }
            else if ($stage == 4) {
                include_once '../../account/creation/includes/finished.php';
            }
        }
    ?>
</body>
<footer>
    <br>
    <div class="tandc">
        <?php echo $footer ?>
    </div>
</footer>
