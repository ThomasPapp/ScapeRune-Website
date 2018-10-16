<?php
/**
 * @author Thomas
 */
if (count(get_required_files()) <= 1) {
    header("Location: ?page=main");
    exit;
}
?>
<table bgcolor="black" width="400" class="e" align="center">
    <tbody>
        <tr>
            <td align="center">
                <b>Password Support</b>
                <br><a href="?page=main" class="c">Main Menu</a>
            </td>
        </tr>
    </tbody>
</table>
<br>
<br>
<table bgcolor="black" border="0" cellpadding="4" width="500" class="e" align="center">
    <form action="?page=recover" method="post">
        <tbody>
            <tr>
                <td>
                    <p style="text-align: center">
                        To help us be absolutely sure that you are the true owner of
                        your account, please answer as many of the questions below as possible.
                        If you really can't answer a question leave the box blank.
                    </p>
                    <b style="color: #FFBB22;">Your Recovery Questions</b>&#8195;(If you set some, you must try to answer at least 3)
                    <br>
                    <br>
                    <div style="float: left; width: 50%;">Where were you born?</div>
                    <input style="float: right" name="rc1" type="password" id="uid">
                    <br>
                    <br>
                    <div style="float: left; width: 50%;">What was your first teachers name?</div>
                    <input style="float: right" name="rc2" type="password" id="uid">
                    <br>
                    <br>
                    <div style="float: left; width: 50%;">What is your fathers middle name?</div>
                    <input style="float: right" name="rc3" type="password" id="uid">
                    <br>
                    <br>
                    <div style="float: left; width: 50%;">What is your mothers middle name?</div>
                    <input style="float: right" name="rc4" type="password" id="uid">
                    <br>
                    <br>
                    <div style="float: left; width: 50%;">What is your favorite vacation spot?</div>
                    <input style="float: right" name="rc5" type="password" id="uid">
                    <br>
                    <div style="float: left; text-align: center; width: 380px;">
                        <input type="checkbox" name="no_recoveries"> I Did Not Set Any Recovery Questions
                    </div>
                    <br>
                    <br>
                    <div style="background: none repeat scroll 0% 0% rgb(79,70,71); padding: 0px 0px 0px 6px;margin-bottom: 0px; height:60px;">
                        <b style="color: #FFBB22;">Transaction Number</b>&#8195;(Donators only)
                        <div style="margin-top:-10px;">
                            <div style="float:left;width:315px">
                                <p style="line-height:20px">
                                    Please provide the transaction id from the earliest donation.
                                </p>
                            </div>
                            <input style="float: right; text-align: right; width: 160px;" name="transaction_id">
                        </div>
                    </div>
                    <br>
                    <b style="color: #FFBB22;">Previous Passwords</b>&#8195;(You must give at least one)
                    <br>
                    <br>
                    <div style="margin-top:-10px">
                        <div style="float: left; width: 280px;">The first password ever used on this account</div>
                        <input style="float: right" name="first_password" type="password" id="uid">
                        <br>
                        <br>
                        <div style="float: left; width: 50%;">The last previous password used</div>
                        <input style="float: right" name="last_prev_password" type="password" id="uid">
                        <br>
                        <br>
                        <div style="float: left; width: 50%;">Another previously used password</div>
                        <input style="float: right" name="prev_password" type="password" id="uid">
                    </div>
                    <br>
                    <br>
                    <div style="background: none repeat scroll 0% 0% rgb(79,70,71); padding: 0px 0px 0px 6px;margin-bottom: 0px; height:110px;">
                        <b style="color: #FFBB22;">Account Details</b>
                        <br>
                        <br>
                        <div style="margin-top:-10px">
                            <div style="float:left;width:320px;">Approximately when did you last successfully login?</div>
                            <input style="float: right" name="last_login" type="date" id="uid" required>
                            <br>
                            <br>
                            <div style="float:left;width:320px;">Approximately when did you create this account?</div>
                            <input style="float: right" name="creation_date" type="date" id="uid" required>
                        </div>
                    </div>
                    <br>
                    <b style="color: #FFBB22;">Your New Password</b>
                    <br>
                    <br>
                    <div style="margin-top:-10px">
                        <div style="float: left; width: 280px;">Please enter a new password for your account:</div>
                        <input style="float: right" name="new_password" size="20" maxlength="20" type="password" id="uid" required>
                        <br>
                        <br>
                        <div style="float: left; width: 50%;">Type a new password again:</div>
                        <input style="float: right" name="new_password_confirm" size="20" maxlength="20" type="password" id="uid" required>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div style="background: none repeat scroll 0% 0% rgb(79,70,71); padding: 0px 0px 0px 6px;margin-bottom: 0px; height:330px;">
                        <br>
                        <div style="margin-top:-15px;">
                            Lastly, please supply any other details which might help us verify that you are the true owner of this account.
                        </div>
                        <br>
                        <div align="center">
                            <textarea style="alignment: center" cols="45" rows="15" name="textarea"></textarea>
                            <br>
                            You have <span id="charlimit_count_b">250</span> characters <span id="charlimit_info_b" style="display: inline;">remaining.</span>
                        </div>
                    </div>
                    <div align="center">
                        <br>
                        <input class="" name="submit" value="Submit" type="submit" align="center">
                    </div>
                </td>
            </tr>
        </tbody>
    </form>
</table>
