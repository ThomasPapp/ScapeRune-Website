<?php
/**
 * @author Thomas
 */
if (count(get_required_files()) <= 1) {
    header("Location: ?page=main");
    exit;
}

$connection->query("DELETE FROM pending_recovery_questions WHERE id = ?", array($id), false);
?>
<td>
    <p style="text-align: center">
        <b>Pending Recovery Details Cancelled</b>
        <br>
        <br>

        You have successfully cancelled the pending recovery details on this account.
        <br>
        <br>We stongly advise that you read our <a href="kbase/viewarticle7564.html?article_id=2087" class="c">Security Tips Guide</a> then <b>once you are sure that your account is secure</b>
        <a href="?page=change_password" class="c">change your password here</a> to secure your account.

        <br>
        <br>
        To return to the front page, <a href="?page=main">click here</a>.
    </p>
</td>
