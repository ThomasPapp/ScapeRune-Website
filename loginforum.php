<?php
/**
 * @author Thomas
 */

require 'secure/Config.php';

if (isset($_SESSION['hash']) || isset($_COOKIE['account'])) {
    header('Location: /');
    exit;
}

?>
<head>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="MSSmartTagsPreventParsing" content="TRUE">
    <title>ScapeRune - the massive online adventure game</title>
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <link href="css/basic-3.css" rel="stylesheet" type="text/css" media="all">

    <link href="css/extra-1.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/loginforum.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>

<div id="body">
    <div style="text-align: center; background: none;">
        <div class="titleframe e">
            <b>Secure Login</b><br>
            <a href="index.php" target="_self">Main Menu</a>
        </div>
    </div>
    <img style="margin-top:-25px;" class="widescroll-top" src="img/scroll/backdrop_765_top.gif" alt="" width="765"
         height="50">

    <div class="widescroll" style="text-align:center;">
        <div class="widescroll-bgimg">
            <div style="padding-top:0px;" class="widescroll-content">
				<span style="display:block;padding:25px 0 0 0;"><img title="Login to Access this Feature"
                                                                     alt="Login to Access this Feature"
                                                                     style="display:block; margin:auto;"
                                                                     src="img/loginpage/log-in.gif"></span>

                <div style="font-size: 8pt;margin:auto;">
                    &nbsp;
                </div>
                <div style="position:relative;height:214px;width:414px;margin:auto;margin-top:4px;">
                    <table cellpadding="0" cellspacing="0" style="height:214px; width:414px">
                        <tr>
                            <td colspan="3" height="7" width="400">
                                <img style="position:absolute; left:0; top:0" src="img/loginpage/shadow_top.gif"></td>
                        </tr>
                        <tr>
                            <td height="200" width="7">
                                <img style="position:absolute; left:0; top:7px;" src="img/loginpage/shadow_left.gif">
                            </td>
                            <td height="200" width="400">
                                <div
                                    style="background-color:#3e434d; opacity: 0.5; -moz-opacity:0.5;height: 200px; width: 400px; position:absolute; left:7px; top:7px;z-index:0;filter:alpha(opacity=50);"></div>
                                <div style="z-index:2; top:70px;left:40px;position:absolute;">
                                    <form action="secure/login/loginrequest.php" method="post" autocomplete="off">
                                        <table style="-moz-opacity:1.0; opacity:1.0; filter:alpha(opacity=100);">
                                            <tr>
                                                <td>ScapeRune username:</td>
                                                <td><input size="20" type="text" name="username" maxlength="12" required></td>
                                            </tr>
                                            <tr>
                                                <td>ScapeRune password:</td>
                                                <td><input size="20" type="password" name="password" maxlength="20" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td align="center"><input type="submit" value="Secure Login"></td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </td>
                            <td style="position:absolute; left:407px; top:7px" height="200" width="7">
                                <img src="img/loginpage/shadow_right.gif"></td>
                        </tr>
                        <tr>
                            <td colspan="3" height="7" width="400">
                                <img style="position:absolute; left:0; top:207px" src="img/loginpage/shadow_bottom.gif">
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="margin:auto;">
                    <img id="dont" src="img/loginpage/scaperune_only_ie6_2.gif" style="margin:auto;padding-top:5px;"
                         title="Only Enter Your Password On ScapeRune.net"
                         alt="Only Enter Your Password On ScapeRune.net">
                </div>
                <br> <br>

                <div class="buttons">
                    <a href="account/creation/" class="button" id="button-left"><span class="lev1"></span>Create a New
                        Account!<br> Click Here!</a>
                    <a href="../recover" class="button" id="button-right"><span class="lev1"></span>Lost
                        Your Password?<br> Click Here!</a>
                </div>
            </div>
        </div>
    </div>
    <img class="widescroll-bottom" src="img/scroll/backdrop_765_bottom.gif" alt="" width="765" height="50">
</div>

</body>
<footer>
    <div class="tandc">
        <?php echo $footer ?>
    </div>
</footer>
