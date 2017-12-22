<?php
/**
 * @author Thomas
 */
if (count(get_required_files()) <= 1) {
    header("Location: ?page=main");
    exit;
}

if (isset($_SESSION['hash'])) {
    session_unset();
}

header('Location: ?page=main');
exit;