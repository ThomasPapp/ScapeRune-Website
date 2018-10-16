<?php
/**
 * @author Thomas
 */
require 'classes/secure/SQLConnection.php';
require 'classes/secure/Config.php';

$connection = new SQLConnection();

$connection->query("INSERT INTO news_articles VALUES(null, ?, ?, ?, ?, ?)",
    array("ScapeRune's Website Rework!", 0, 1, date("d-F-Y", time()),
        "This is a test news post. ScapeRune's website is currently being reworked and this news post is just to make sure that the basic HTML of the posts is working. Cheers!"), false);