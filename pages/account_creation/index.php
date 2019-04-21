<?php
/**
 * @author Thomas
 */

if (count(get_required_files()) <= 1) {
    header("Location: ?page=main");
    exit;
}

require 'classes/secure/SQLConnection.php';
require 'classes/secure/Config.php';
require 'classes/secure/session/Session.php';

require 'classes/account/Account.php';

require 'classes/account/creation/CreationHandler.php';

$connection = new SQLConnection();

$session = new Session($connection);
$account = new Account($session);
$handler = new CreationHandler($session);

if ($account->isLoggedIn()) {
    $session->redirect('?page=main');
    exit;
}

$error_message = null;

$stage = 0;

$create = false;

if(isset($_POST['age']) && isset($_POST['country'])) {
    if(!in_array($_POST['age'], array('Below 13', '13-18', '19-24', '25-30', '31-36', '36-39', '40+')) || !ctype_digit($_POST['country'])) {
        $error_message = 'Invalid age or country.</br></br> <input type="button" value="Back" onclick="window.location.href=window.location.href"/>';
    } else {
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['country'] = $_POST['country'];
    }
}

if (isset($_POST['email']) && isset($_POST['username'])) {
    if (!$handler->validEmail($_POST['email']))
        $error_message = 'The email <span style="color: #ffbb22;">'. $_POST['email'] .'</span> is currently unavailable.<br><br><input type="button" value="Back" onclick="window.location.href=window.location.href"/>';
    else {
        if (!$handler->validUsername(trim($_POST['username']))) {
            $error_message = 'The username <span style="color: #ffbb22;">'. $_POST['username'] .'</span> is currently unavailable.</br></br> <input type="button" value="Back" onclick="window.location.href=window.location.href"/>';
        } else {
            $_SESSION['email'] = trim($_POST['email']);
            $_SESSION['username'] = trim($_POST['username']);
        }
    }
}

if (isset($_POST['terms'])) {
    $_SESSION['terms'] = true;
}

if (isset($_POST['terms_disagree'])) {
    session_unset();
    $session->redirect('?page=main');
    exit;
}

// uncomment the below code for the live version!
if (/*$_SERVER["REQUEST_METHOD"] == 'POST' &&*/ isset($_POST['password']) && isset($_POST['password_confirm'])) {

    if ($_POST['password'] != $_POST['password_confirm']) {
        $error_message = 'The passwords you have entered do not match.<br><br><input type="button" value="Back" onclick="window.location.href=window.location.href"/>';
    } else {
        $create = true;
    }
}

// set the stage
if (isset($_SESSION['age']) && isset($_SESSION['country'])) {
    $stage = 1;
}
if (isset($_SESSION['age']) && isset($_SESSION['country']) && isset($_SESSION['username'])) {
    $stage = 2;
}
if (isset($_SESSION['age']) && isset($_SESSION['country']) && isset($_SESSION['username']) && isset($_SESSION['terms'])) {
    $stage = 3;
}
if (isset($_SESSION['age']) && isset($_SESSION['country']) && isset($_SESSION['username']) && isset($_SESSION['terms']) && $create) {
    $stage = 4;
    $salt = substr(hash(sha256, sha1(time())), 10);
    $password = $salt.hash(sha256, md5(sha1($_POST['password']))).substr($salt, 0, -51);
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $session_hash = $handler->createAccount($_SESSION['age'], $_SESSION['country'], $_SESSION['username'], $email, $password);
    session_unset();
    $_SESSION['hash'] = $session_hash;
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
    <link rel="shortcut icon" href="img/favicon.ico" />
    <title><?php echo $title; ?></title>
    <link href="css/basic-3.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/register-1.css" rel="stylesheet" type="text/css" media="all">
<!--    uncomment the below code for the live version! -->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<!--    <script src='https://www.google.com/recaptcha/api.js?render=6LcokGkUAAAAAIo1z0lyZ-CO-X0FIy8_5v9ulfTL'></script>-->
<!--    <script src="js/additions.js"></script>-->
</head>
<body>
    <div id="body">
        <div style="text-align: center; background: none;">
            <div class="titleframe e">
                <b>Create account</b><br>
                <a href="?page=main">Main Menu</a>
            </div>
        </div>
        <br>
    </div>

    <div id="reg">
        <table cellspacing="0" cellpadding="0">
            <tbody><tr>
                <?php
                    echo '<td id="ageReg" class="'. $boxes['age_loc'] .'">Indicate Age and Location</td>';
                    echo '<td id="usernameReg" class="'. $boxes['username'] .'">Choose an Email and Username</td>';
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
                require 'includes/age_location.php';
            }
            if ($stage == 1) {
                require 'includes/choose_email_and_username.php';
            }
            else if ($stage == 2) {
                require 'includes/terms_and_conditions.php';
            }
            else if ($stage == 3) {
                require 'includes/password.php';
            }
            else if ($stage == 4) {
                require 'includes/finished.php';
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
