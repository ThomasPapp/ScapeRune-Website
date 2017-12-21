<?php
/**
 * @author Thomas
 */
session_start();

require 'classes/page/PageHandler.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'main';

PageHandler::buildPage($page);