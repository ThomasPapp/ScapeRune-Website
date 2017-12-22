<?php
/**
 * @author Thomas
 */
if (count(get_required_files()) <= 1) {
    header("Location: ?page=main");
    exit;
}

$possible_questions = [
    0 => "Where were you born?",
    1 => "What was your first teachers name?",
    2 => "What is your fathers middle name?",
    3 => "What is your mothers middle name?",
    4 => "What is your favorite vacation spot?"
];

$questions = array_rand($possible_questions, 5);
?>
<td>
    <center><b> Set Recovery Questions</b></center>
    <br>Use this form to change or set your recovery questions.
    <br>
    <br>If you do not wish to set new recovery questions at this time, please use the link in the top
    right of the site to return to the <a href="?page=main">front page</a>.
    <br>
    <br>
    The answers to your recovery questions can be used to set a new password
    on your account, so please make sure that you set these to <b>sensible values</b> that no-one else will be able to work out or guess.
    <br>
    <br>
    If you don't like the default questions that we have suggested, then please enter your own questions to answer.
    <br>

    <br>
    <center>
        <font size="1"><font color="#FFFFFF">If you only see a large grey box below, click<a href="?page=set_recovery"> here</a></font></font>
        <br>
    </center>
    <br>
    <br>
    <form action="?page=set_recovery" method="POST">
        <div style="margin-top:-20px;">
            Current Password:
        </div>
        <center>
            <div style="margin-top:-20px;">
                <input size="" id="textbox2" name="password" value="" type="password" minlength="5" maxlength="20" autocomplete="off" required>
            </div>
        </center>
        <?php
        for ($i = 0; $i < 5; $i ++) {
            echo '
                <br>
                <b>Recovery Question '. ($i + 1) .'</b>
                <br>
                <br>
                Question:
                &#8195;<input id="textbox3" value="'. $possible_questions[$questions[$i]] .'" type="text" readonly> 
                <input type="hidden" name="question'. $i .'" value="'. $questions[$i] .'">
                <input id="button" value="New Question" type="submit">
                <br>
                <br>Answer:
                <div style="margin-top:-18px;">&#8195;&#8195;&#8195;&#8195;&#8195;&nbsp;&nbsp;<input id="textbox" name="answer'. $i .'" type="password" required><br></div>
            ';
        }
        ?>
        <br><center><input value="Submit" id="submit" name="submit" type="submit"></center>
    </form>
</td>
