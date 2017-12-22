<?php
/**
 * @author Thomas
 */
if (count(get_required_files()) <= 1 || !(isset($submitted_questions) && isset($submitted_answers))) {
    header("Location: ?page=main");
    exit;
}

$id = $account->getId();

$connection->query("SELECT * FROM recovery_questions WHERE id = ?", array($id), false);

$update = $connection->getRowAmount() > 0;

if (!$update) {
    $connection->query("INSERT INTO recovery_questions VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array($id, $submitted_questions[0], $submitted_questions[1], $submitted_questions[2], $submitted_questions[3], $submitted_questions[4],
        $submitted_answers[0], $submitted_answers[1], $submitted_answers[2], $submitted_answers[3], $submitted_answers[4]), false);
}
?>
<td>
    <?php
        if ($update) {
            ?>
            <center>
                <b><font color="#FFBB22">Your Recovery Questions and Answers have been successfully updated.</font></b>
                <br>
                <br>

                The new questions you have specified are set as pending and will become
                active in 14 days. During this time you will be only be able to recover
                your account with your previous recovery questions.
                <br>
                <br>

                Please remember that you should <b>never</b> disclose your recovery questions or answers to <b>anyone</b> - members of <?php echo $name; ?> staff will <b>never</b> ask for your details in game or via email.
            </center>
            <?php
        } else {
            ?>
            <center>
                <b><font color="#FFBB22">Your Recovery Questions and Answers have been successfully set.</font></b>
                <br>
                <br>

                The questions you have specified are now active and may be used to recover this account.
                <br>
                <br>

                Please remember that you should <b>never</b> disclose your recovery questions or answers to <b>anyone</b> - members of <?php echo $name; ?> staff will <b>never</b> ask for your details in game or via email.
            </center>
            <?php
        }
    ?>
</td>
