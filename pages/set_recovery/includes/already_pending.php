<?php
/**
 * @author Thomas
 */
if (count(get_required_files()) <= 1) {
    header("Location: ?page=main");
    exit;
}

?>
<td>
    <p style="text-align: center">
        <b><font color="#FFBB22">You already have a set of pending recovery questions.</font></b>
        <br>
        <br>

        It appears that you already have a set of pending recovery questions. Please cancel them before setting new ones.
        To cancel your pending questions, click <a href="?page=cancel_recovery">here</a>.
        <br>
        <br>
        Click <a href="?page-main">here</a> to return to the main page.
    </p>
</td>
