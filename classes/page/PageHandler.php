<?php

/**
 * @author Thomas
 */
class PageHandler {

    public static function buildPage($page) {
        if (!file_exists("pages/$page/index.php")) {
            http_response_code(404);
//            header("HTTP/1.0 404 Not Found");
//            echo "<h1>404 Not Found</h1>";
//            echo "The page that you have requested could not be found.";
            exit;
        }
        require "pages/$page/index.php";
    }

}