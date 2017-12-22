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

$connection = new SQLConnection();

$session = new Session($connection);
$account = new Account($session);

$online = $account->isLoggedIn();
?>
<head>
    <meta name="MSSmartTagsPreventParsing" content="TRUE">
    <title><?php echo $title; ?></title>
    <link href="css/basic-3.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/main/title-5.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/forum-3.css" rel="stylesheet" type="text/css" media="all"/>
    <link rel="shortcut icon" href="img/favicon.ico"/>
</head>
<body>
<div id="body">
    <?php $account->createNavigation() ?>
    <br>
    <div>
        <div style="text-align: center; margin-bottom: 10px; position:relative;">
            <img src="img/title2/srlogo1.gif" alt="ScapeRune">
            <body onload="countdown(year,month,day,hour,minute)">
            <table id="table" border="0">
                <tr>
                    <td align="center" colspan="6"><div class="numbers" id="count2" style="padding: 10px; "></div></td>
                </tr>

            </table>
            <?php
            $amount = 0;
            echo 'There are currently '. $amount ." people playing!";
            ?>
        </div>
    </div>

    <div class="left">
        <fieldset class="menu rs">
            <legend><?php echo $name; ?></legend>
            <ul>
                <li class="i-create"><a href="?page=account_creation">Create a free account (New user)</a></li>
                <li class="i-play"><a href="..">Play RuneScape (Existing user)</a></li>
                <li class="i-screen"><a href="..">View in-game screenshots</a></li>
                <li class="i-youtube"><a style="margin-left: 3pt;" href="https://www.youtube.com/channel/UCYXUtjB7bO_QWJKYImXJorA" target="_blank">ScapeRune Youtube</a></li>
                <li class="i-disc"><a style="margin-left: 1.5pt" href="https://discord.gg/YmbBp8U" target='_blank'>Discord Channel</a></li>
            </ul>
        </fieldset>

        <fieldset style="border: gold solid .1em" class="menu">
            <legend>Donate</legend>
            <ul>
                <li class="i-subext"><a href="/services/donation">Donate</a></li>
            </ul>
        </fieldset>

        <fieldset class="menu" style="background-image: url('img/title2/gamehelp.gif');">
            <legend>Knowledge Base</legend>
            <ul>
                <li class="i-answer"><a href="kbase/index.html">Knowledge Base Home</a></li>
                <li class="i-started"><a href="kbase/viewarticleeb73.html?article_id=2058">Getting Started</a></li>
                <li class="i-rules"><a href="kbase/viewcategory8e26.html?ref=main&amp;cat_id=823">Rules</a></li>
                <li class="i-manual"><a href="kbase/viewcategory44ca.html?ref=main&amp;cat_id=775">Manual</a></li>
                <li class="i-quest"><a href="kbase/viewcategory30d1.html?cat_id=7">QuestHelp</a></li>
                <li class="i-parents"><a href="kbase/viewcategoryb995.html?ref=main&amp;cat_id=884">Parents' Guide</a>
                </li>
                <li class="i-safety"><a href="kbase/viewcategoryabc1.html?ref=main&amp;cat_id=827">Safety & Security</a>
                </li>
                <li class="i-support"><a href="kbase/viewcategorydf1c.html?ref=main&amp;cat_id=9">Customer Support</a>
                </li>
                <li class="i-comment"><a href="kbase/viewarticle79b3.html?ref=main&amp;article_id=2509">Comment on our
                        service</a></li>
                <li class="i-bug"><a href="support/bugs/">Report a bug/fault</a></li>
            </ul>
        </fieldset>

        <fieldset class="menu poll">
            <legend>Latest Poll</legend>
            Reaching out to the community!
            <ul>
                <li class="i-vote"><a href="index.php">Vote in this poll (Free/Member)</a></li>
                <li class="i-polls"><a href="index.php">View previous polls</a></li>
            </ul>
        </fieldset>

        <fieldset class="menu web">
            <legend>Website Features</legend>
            <ul>
                <li class="i-world"><a href="map/">World map</a></li>
                <li class="i-score"><a href="/hiscores">Hiscores</a></li>
                <li class="i-forum"><a href="/forums">Forums</a></li>
                <li class="i-files"><a href="/download.php">Downloads</a></li>
            </ul>
        </fieldset>

        <?php
            if ($online) {
                ?>
                <fieldset class="menu acc">
                    <legend>Account Management</legend>
                    <ul>
                        <li style="white-space: nowrap" class="i-msg"><a href="msgcenter/index">Read your messages from <?php echo $name; ?></li>
                        <li class="i-pw"><a href="?page=change_password">Change your password</a></li>
                        <li class="i-recset"><a href="?page=set_recovery">Set new recovery questions</a></li>
                        <li class="i-reccan"><a href="/account/cancel_recoveries">Cancel recovery questions</a></li>
                    </ul>
                </fieldset>
                <?php
            }
        ?>

        <fieldset class="menu rec">
            <legend>Account Recovery</legend>
            <ul>
                <li class="i-rec"><a href="">Recover a lost password</a></li>
                <li class="i-rec"><a href="">Recover a locked account</a></li>
                <li class="i-track"><a href="">Track a recovery request</a></li>
                <li class="i-appeal"><a href="">Appeal an Offence/Ban</a></li>
            </ul>
        </fieldset>

        <fieldset class="menu pmod">
            <legend>Player Moderators</legend>
            <ul>
                <li class="i-pmod"><a href="">Visit the player moderator centre</a></li>
                <li class="i-pmod"><a href="">Find out about player mods</a></li>
            </ul>
            <br>
        </fieldset>
    </div>

    <div class="newscontainer">
        <div class="buttons">
            <a href="?page=account_creation" class="button" id="button-left"><span class="create"></span><br style="line-height: 200%">Create a free account<br>(New user)</a>
            <a href="" class="button" id="button-right"><span class="play"></span><br style="line-height: 200%">Play ScapeRune <?php echo $name; ?><br>(Existing user)</a>
        </div>
    </div>

</div>
</body>
<footer>
    <div class="tandc">
        <?php echo $footer ?>
    </div>
</footer>
