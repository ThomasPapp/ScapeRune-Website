<?php
/**
 * @author Thomas
 */
if (count(get_required_files()) <= 1 || !(isset($valid) && isset($matches))) {
    header("Location: ?page=main");
    exit;
}
?>
<form action="?page=change_password" method="post">
    <table width=500 bgcolor=black cellpadding=4 border=0 class="e">
        <tr>
            <td>
                <center>
                    Password Change Form
                </center>
                <br>
                Use this form if you want to change your <?php echo $name; ?> Password for logging into the game and our website. Alternatively, click <a href="?page=main">here</a> to return to the main menu.
                <br>
                <br>
                Please be absolutely sure that you only ever enter or change your password at <?php echo $domain_uc; ?>
                <br>
                <br>
                Please note that passwords must be between 5 and 20 characters long. We recommend you use a mixture of numbers and letters in your password to make it harder for someone to guess.
                <br>
                <br>
                <font size="4"><font color="#FFFFFF">Change Password</font></font>
                <br>
                <br>
                <div style="margin-top:-10px;">
                    <?php
                        if (isset($valid) && !$valid) {
                            echo '
                                <br>
                                <br>
                                <div style="margin-top:-20px; color: red;">
                                    Invalid password - please enter the correct password.
                                </div>
                            ';
                        }
                    ?>
                    <div style="float:left;width:200px;">
                        Enter your current password:
                    </div>
                    <div style="text-align: center; width: 350px;">
                        <?php
                            if (!$valid) {
                                echo '<input size="2" id="uid" type="password" name="current" style="border-color: red" required>';
                            } else {
                                echo '<input size="2" id="uid" type="password" name="current" required>';
                            }
                        ?>
                    </div>
                    <br>
                    <?php
                        if (isset($matches) && !$matches) {
                            echo '
                                    <br>
                                     <div style="margin-top:-20px; color: red;">
                                        Passwords do not match - please enter matching passwords.
                                    </div>
                                ';
                        }
                    ?>
                    <div style="float:left;width:200px;">
                        Enter your new password:
                    </div>
                    <div style="text-align: center; width: 350px;">
                        <?php
                            if (!$matches) {
                                echo '<input size="2" id="uid" type="password" name="password" style="border-color: red" required>';
                            } else {
                                echo '<input size="2" id="uid" type="password" name="password" required>';
                            }
                        ?>
                    </div>
                    <br>
                    <div style="float:left;width:200px;">Enter it again:</div>
                    <div style="text-align: center; width: 350px;">
                        <?php
                            if (!$matches) {
                                echo '<input size="2" id="uid" type="password" name="confirm_password" style="border-color: red" required>';
                            } else {
                                echo '<input size="2" id="uid" type="password" name="confirm_password" required>';
                            }
                        ?>
                    </div>
                </div>
                <br><center><input class="" name="submit" value="Submit" type="submit"></center>
            </td>
        </tr>
    </table>
</form>