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
                <form action="?page=account_creation" method="POST">
                    <p>The email <span style="color: #ffbb22;"><?php echo $_SESSION['email']; ?></span> and username <span style="color: #ffbb22;"><?php echo $_SESSION['username']; ?></span> is currently available. To sign up to an account you must agree to our Terms and Conditions:</p>

                    <b>Terms and Conditions</b>
                    <br>

                    <p>
                        <u>Username</u><br>
                        You must not choose a Username that infringes the rights of any third
                        party, impersonates ScapeRune staff of other users, or which is deliberately
                        confusing or which is offensive, racist, obscene or otherwise unlawful.
                        We reserve the right to change any Username for any reason.</p>

                    <p>
                        <u>Password</u><br>
                        You agree to keep your Password safe at all times and not to disclose it
                        to any other person. You must ensure that your computer is kept free of
                        viruses and Trojans to ensure the safety of your password. Real ScapeRune
                        staff will never ask you for your current password.</p>

<!--                    <p>-->
<!--                        <u>Subscription</u><br>-->
<!--                        Some contents and/or services on this website are subscription-based. If-->
<!--                        you elect to purchase subscription-based content/services and transmit-->
<!--                        to us a subscription purchase request, you warrant that all the-->
<!--                        information that you submit is true and accurate (including without-->
<!--                        limitation your credit card number and expiration date, and other-->
<!--                        payment details), and you agree to pay all subscription fees you incur-->
<!--                        including all applicable taxes. </p>-->

<!--                    <p>-->
                        <u>ScapeRune Account</u><br>
                        You agree that your ScapeRune character and account and items are and
                        remain the property of ScapeRune. You may not sell, transfer or lend your
                        account to anyone else, or permit anyone else to use your account, and
                        you may not accept an account which anybody else offers you.</p>

                    <p>You may create more than one ScapeRune account, but if you do, you
                        may not log into more than one account at any time, and they must not
                        interact with each other in any way. Using one account to drop objects
                        for transfer to another of your accounts is not allowed.</p>

                    <p>We reserve the right to delete all your accounts, block your access
                        to our website and services, and/or take further legal action if you
                        violate any of these terms and conditions. We may delete or modify any
                        account at any time for any reason.</p>

                    <p>
                        <u>Sign-Up</u><br>
                        By signing-up for an account you are opting-in to allow us to store
                        personal information, cookies, etc. as described in our Privacy Policy. </p>

                    <p>
                        <u>Chat facility</u><br>
                        When using the chat facility you must not use any language which may be
                        considered by others to be offensive, racist or obscene, or otherwise
                        infringes the rights of third parties. You must not use the chat
                        facility to harass, threaten, scam or deceive other players. You agree
                        that the chat facility is only for role-playing in the game, and is not
                        designed or intended to be used as a forum for other types of
                        discussion. You must not use the chat facility to advertise other
                        websites or products.</p>

                    <p>You agree that for the purpose of preventing offensive language and
                        cheating we may automatically or manually censor the chat as we see fit,
                        and that we may record or monitor the chat to help us identify
                        offenders. Sexually harassing, threatening, stalking or otherwise
                        harassing others may result in legal action being taken against you.</p>

                    <p>If you are the victim of the sort of behaviour described above, or
                        receive any other unwanted communications you must use the built in
                        facilities to block the messages. If there is a particular user causing a
                        problem then use the ignore function to block further messages (to do
                        this point at the friends menu, click on the 'ignore' tab, click where
                        it says 'click here to add a name' and enter the name of the user to
                        block). If you continue to receive unwanted messages, or receive
                        harassment from multiple players you must use the privacy controls to
                        block all messages from everyone except your friends (to do this point
                        at the configuration menu, and ensure all four privacy settings are
                        switched to 'on'). If you continue to suffer problems, or are not
                        satisfied then you must stop using this web site.</p>


                    <p>
                        <u>Cheating</u><br>
                        You must not exploit any cheats or errors which you find in ScapeRune. Any cheats or errors which you discover
                        must be reported immediately to us.</p>

                    <p>You must not attempt to use other programs in conjunction with ScapeRune to give yourself an unfair advantage. You
                        may not use any bots or macros to control your character for you. When
                        you are not playing a Game you must logout. You may not circumvent any
                        of our mechanisms designed to logout inactive users automatically.</p>

                    <p>You must not misuse any of our customer service facilities. You must
                        not deliberately enter false information into any of the forms on our
                        website, or in our games. You must not encourage, or attempt to trick
                        other players into breaking our rules.</p>


                    <p>
                        <u>Provision of service</u><br>
                        You must not reverse-engineer, decompile or modify the ScapeRune client
                        in any way. You must not use a modified/customised version of the
                        ScapeRune client. You must not create or provide any other means by
                        which any of the Games provided by this web site may be played by others
                        (including, without limitation, replacement or modified client/server
                        software, server emulators).  </p>

                    <center>
                        <input value="I Agree" id="terms" name="terms" type="submit"> <input value="I Do Not Agree" id="terms_disagree" name="terms_disagree" type="submit">
                    </center>
                </form>
            </td>
        </tbody>
    </table>
</div>
