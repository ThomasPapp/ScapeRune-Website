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
        <td style="text-align: justify; vertical-align: top;">
            Your account <span style="color: #ffbb22;"><?php echo $username ?></span> has now been created with the email and password you have chosen. We recommend you make a note of it on
            a bit of paper and keep it somewhere <b>really</b> safe, in case you forget it.
            <br><br>

            An email has been sent to <span style="color: #ffbb22;"><?php echo $email; ?></span>, you will need to verify it before logging in-game.

            <br><br>
            We have many guides and manuals on the <?php echo $name; ?> website that you will find extremely helpful. The following are some of the
            most important that you will need to be aware of:
            <ul>
                <li><a href="">Read our Rules</a></li>
                <li><a href="">Read our Safety + Security guidelines</a></li>
                <li><a href="">Getting started guide</a></li>
                <li><a href="">Benefits of donating</a></li>
            </ul>
            <center>
                Click below to start playing:
                <div class="buttons"><a href="?page=main" class="button" id="playbutton"><span class="lev1"></span>Play <?php echo $name; ?></a></div>
            </center>
        </td>
    </table>
</div>
