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
        <tr>
            <form action="?page=account_creation" method="POST">
                <table width="100%" cellpadding="16">
                    <tbody>
                    <tr>
                        <td align="left" colspan="2">
                            Creating an account for <?php echo $name; ?> is a very simple process.<br><br>
                            To begin you must first select an email and a username. Once you have found an email and username that is not already taken, you will
                            be asked to choose a password.<br><br>
                            When you have done that, you are ready to play!<br><br>
                            Remember creating an account is totally free, you can keep playing on our worlds for as long as you like with
                            no obligation to donate anything.<br><br>
                            Emails cannot be reused and must be verified before being able to play <?php echo $name; ?>. Emails are only used for verification and
                            sending updates regarding your account, along with our message centre.<br><br>
                            Usernames can be a maximum of 12 characters long and may contain letters, numbers and underscores.<br><br>
                            It should not contain your real name, bis can be a maximum of 12 characterth date, or other personally identifiable information, to better protect your identity.<br><br>
                            It should not be offensive or break our <a href="">Terms+Conditions.</a><br><br>
                            The Username you choose here is used as your Character name in the game. When playing <?php echo $name; ?>, underscores
                            in usernames are translated into spaces and first letters are capitalised. For example the username <b>red_rooster</b> would appear
                            as <b>Red Rooster</b>.<br>
                            <center>
                                Desired Email: <input style="margin-left:25px;" id="email" name="email" autocomplete="off" required><br><br>
                                Desired Username: <input id="username" name="username" autocomplete="off" maxlength="12" required><br><br>
                                <input type="submit" align="relative" value="Check Availability">
                            </center>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </tr>
        </tbody>
    </table>
</div>
