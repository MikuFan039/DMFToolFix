<?php
if (!defined('IN_SCRIPT')) {
    die('Invalid attempt');
}
?>

<div id="gbook_guestbook" align="center">
	<span class="gbook_guestbook"><?php echo $task; ?></span>
</div>

<form action="gbook.php" method="post">
<!--TASK FORM -->
<div id="gbook_entries">

	<?php
    if ($error)
    {
		echo '<div class="gbook_sign_error">'.$error.'</div>';
    }
    ?>

    <div class="gbook_sign_text"><?php echo $task_description; ?></div>

	<div class="gbook_sign_text"><span class="gbook_entries"><b><?php echo $lang['t21']; ?></b></span><br class="clear" />
    <input type="password" name="pass" size="45" /></div>

	<?php
    if (isset($options))
    {
	    ?>
		<div class="gbook_sign_text"><span class="gbook_entries"><b><?php echo $lang['t22']; ?></b></span><br class="clear" />
	    <?php echo $options; ?></div>
		<?php
    }
    ?>

	<div align="center">

	<div class="clear">&nbsp;</div>

    <input type="hidden" name="a" value="<?php echo $action; ?>" />
    <input type="hidden" name="num" value="<?php echo($num); ?>" />
	<input type="submit" value="<?php echo $button; ?>" class="submit" />
	</div>

    <p>&nbsp;</p>

    <div class="gbook_sign_text"><a href="gbook.php"><?php echo $lang['t11']; ?></a></div>

    <p>&nbsp;</p>

</div>
<!--TASK FORM END -->
</form>

