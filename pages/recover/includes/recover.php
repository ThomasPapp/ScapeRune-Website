<?php
/**
 * @author Thomas
 */
if (count(get_required_files()) <= 1) {
    header("Location: ?page=main");
    exit;
}
?>
<div style="text-align: center; background: none;">
    <div class="titleframe e">
        <b>Password Support</b>
        <br>
        <a href="?page=main" class="c">Main Menu</a>
    </div>
</div>
<br>
<div class="frame wide_e" align="center">
    <br>
        This section will help you to <span style="color:#ffbb22;">recover your password</span> if it has been lost or changed, or <span style="color:#ffbb22;">recover your account</span> if it has become locked.
        <br>
        <br>
        <span style="color:#ffbb22;">If you need to update your recovery questions</span>, you can do so from the account management section on the <a href="?page=main" class="c">Main Menu</a>.
        <br>
        <br>
        If your problem is related to your <span style="color:#ffbb22;">Bank PIN</span> or isn't related to recovering your account then please <a href="" class="c">ask a question</a>.
        <br>
        <br>
        <table cellpadding="0" cellspacing="0" width="90%">
            <tbody>
                <tr>
                    <td>
                        <span style="color:#f00;">IMPORTANT:</span>
                        If your password has changed, or your account has become locked, and you don't know how, then your
                        computer may have a virus or trojan. There is little point us issuing
                        you with a new password or unlocking your account if there is still rogue software on your
                        computer which could steal it again. As such, please read our <a href="" class="c">Tips to avoid having your account stolen</a><b> and </b><a href="" class="c">Security Tips</a> guides following all the advice BEFORE completing this form.
                    </td>
                </tr>
            </tbody>
    </table>
    <br>
</div>
<br>
<div class="titleframe e" style="text-align: left">
    To begin the password recovery process, first enter the details below:
    <br>
    <br>
    <table>
        <form action="?page=recover" method="post">
            <tbody>
            <tr>
                <td>ScapeRune username:</td>
                <td>
                    <?php
                        if ((isset($recoverType) && $recoverType == 0) && isset($username)) {
                            ?>
                            <input size="20" name="username" maxlength="12" type="text" value=<?php echo '"'. $username .'"' ?> required>
                        <?php
                        }
                        else {
                            ?>
                            <input size="20" name="username" maxlength="12" type="text" required>
                        <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>Type of query:</td>
                <td>
                    <?php
                        if (isset($recoverType) && $recoverType == 0){
                    ?>
                            <select name="type" style="border-color: red" required>
                    <?php
                        } else {
                        ?>
                            <select name="type" required>
                    <?php
                        }
                    ?>
                        <option value="0" selected="selected">- Please select an option -</option>
                        <option value="1">I have forgotten my password</option>
                        <option value="2">Someone else has changed my password</option>
                        <option value="3">Someone else knows my recovery answers</option>
                        <option value="4">My account is locked</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input name="submit" value=" Submit " type="submit">
                </td>
            </tr>
            </tbody>
        </form>
    </table>
</div>
