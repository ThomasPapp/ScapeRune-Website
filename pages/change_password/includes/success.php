<?php
/**
 * @author Thomas
 */

if (count(get_required_files()) <= 1 || !((isset($valid) && isset($matches)) && $valid && $matches)) {
    header("Location: ?page=main");
    exit;
}
?>
<table width=500 bgcolor=black cellpadding=4 border=0 class="e">
    <tr>
        <td align="center">
            <b><font color="#FFBB22">Your password been successfully updated.</font></b>
            <br>
            <br>
            The new password you have specified has been updated and you can now use it to login to your account.
            <br>
            <br>
            Please remember that you should <b>never</b> disclose your password to <b>anyone</b> - members of <?php echo $name; ?> staff will <b>never</b> ask for your password in game or via email.
        </td>
    </tr>
</table>
