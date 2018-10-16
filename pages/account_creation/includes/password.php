<?php
/**
 * @author Thomas
 */

if (count(get_required_files()) <= 1) {
    header("Location: ?page=main");
    exit;
}

?>
<div class="frame wide_e">
    <table width="100%">
        <tbody>
            <td style="text-align: justify; vertical-align: top;">
                <form action="?page=account_creation" method="post">
<!--                    uncomment the below code for the live version! -->
<!--                <form action="?page=account_creation" method="post" class="verify-form" data-action-name="verify_creation">-->
                    <ul><li><b>NEVER</b> give anyone your password, not even to <?php echo $name; ?> staff.</li>
                        <li><?php echo $name; ?> staff will never ask you for your password.</li>
                        <li>Passwords must be between 5 and 20 characters long. We recommend you use a mixture of numbers and letters in your
                        password to make it harder for someone to guess.</li>
                    </ul>

                    <center>
                        <table>
                            <tbody>
                                <tr>
                                    <td align="right">
                                        Desired Email:
                                    </td>
                                    <td>
                                        <?php echo $_SESSION['email']; ?> (<a href="">Change</a>)
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        Desired Username:
                                    </td>
                                    <td>
                                        <?php echo $_SESSION['username']; ?> (<a href="">Change</a>)
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        Desired Password:
                                    </td>
                                    <td>
                                        <input id="password" name="password" type="password" minlength="5" maxlength="20" autocomplete="off" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        Confirm Password:
                                    </td>
                                    <td>
                                        <input id="password_confirm" name="password_confirm"  type="password" minlength="5" maxlength="20" autocomplete="off" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        I have read and agree with the <a href="">Privacy Policy</a>.
                                    </td>
                                    <td>
                                        <input value="yes" name="agree" id="agree" type="checkbox" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input value="Create Account" id="create" name="create" type="submit">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </center>
                </form>
            </td>
        </tbody>
    </table>
</div>