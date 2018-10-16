<?php
/**
 * @author Thomas
 */

if (!isset($_GET['id'])) {
    header("Location: ?page=main");
    exit;
}

require 'classes/secure/SQLConnection.php';
require 'classes/secure/session/Session.php';
require 'classes/secure/Config.php';

require 'classes/account/Account.php';
require 'classes/news/NewsArticleHandler.php';

$connection = new SQLConnection();

$session = new Session($connection);
$account = new Account($session);
$article_handler = new NewsArticleHandler($session);

$id = $_GET['id'];

$article = $article_handler->getArticle($id);

if ($article == null) {
    $session->redirect("?page=main");
    exit;
}

$title = $article[0]['title'];
$date = $article[0]['post_date'];
$content = $article[0]['content'];

?>
<head>
    <link rel="shortcut icon" href="img/favicon.ico" />
    <title><?php echo $title; ?></title>
    <link href="css/basic-3.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/view_article.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
    <div id="body">
        <?php $account->createNavigation(); ?>
        <br>
        <br>
        <div style="text-align: center;">
            <div class="newstitlebground">
                <div class="newstitleframe">
                    <b>Website News</b>
                    <br>
                    <a href="?page=main">Main Menu</a> - <a href="#">News List</a>
                </div>
            </div>
        </div>

        <img class="widescroll-top" src="img/scroll/backdrop_765_top.gif">

        <div class="widescroll">
            <div class="widescroll-bgimg">
                <div class="widescroll-content">

                    <hr class="trails_top">
                    <b style="float: left;">Location:</b>
                    <div style="margin-left: 6em">
                        <a href="?page=main">Home</a> > <a href="#">News List</a> > <?php echo $title; ?>
                    </div>
                    <hr class="trails">

                    <div style="font-weight: bold; text-align: center; margin-top: 10px; margin-bottom: 10px">
                        <?php echo $date; ?> - <?php echo $title; ?>
                    </div>

                    <div style="text-align: justify; clear: both">
                        <?php echo $content; ?>
                    </div>

                </div>
            </div>
        </div>

        <img class="widescroll-bottom" src="img/scroll/backdrop_765_bottom.gif">

        <div class="tandc">
            <?php echo $footer ?>
        </div>
    </div>
</body>