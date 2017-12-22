<?php
/**
 * @author Thomas
 */

if (!isset($account)) {
    require 'classes/account/Account.php';

    $account = new Account($session);
}

?>
<head>
    <title><?php echo $title; ?></title>
    <link href="css/basic-3.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/redirect/main.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/redirect/forum-3.css" rel="stylesheet" type="text/css" media="all">
    <link rel="shortcut icon" href="img/favicon.ico"/>
	 <meta http-equiv="refresh" content="2;URL=?page=main">
</head>
<body>
    <div id="body">
        <?php $account->createNavigation() ?>
        <br>
        <br>
        <center>
            <table class="e" bgcolor="black" border="0" cellpadding="4" width="500">
                <tbody>
                <tr>
                    <td>
                        <br>
                        <center>If you have not been automatically redirected, please <a href="?page=main" class="c">click here</a>.
                            <br>
                            <br>
                        </center>
                    </td>
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
