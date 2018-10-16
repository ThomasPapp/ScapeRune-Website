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
        There are no pending recovery questions to cancel.
        <br>
        <br>

        If you wish, you can set <a href="?page=set_recovery">new recovery questions.</a>
        <br>
        <br>

        To return to the front page, <a href="?page=main">click here</a>.
    </p>
</td>
