<?php
if (!defined('IN_SCRIPT')) {
	die('Invalid attempt');
}
?>

<!--COMMENT BOX -->
<div class="gbook_commentbox">

	<!--LEFT BOX -->
	<div class="gbook_left_box">
	<span class="gbook_submitted gbook_do_not_break_text"><?php echo $lang['t15']; ?></span><br class="clear" />
	<span class="gbook_submitted_by gbook_break_text"><?php echo $lang['t17']; ?> <b><?php echo $name; ?></b></span><br class="clear" />
	<?php
	if ($from)
	{
		echo '<span class="gbook_submitted_by gbook_break_text">'.$lang['t18'].' '.$from.'</span><br class="clear" />';
	}

	if ($url)
	{
		echo '<span class="gbook_submitted_by gbook_break_text">'.$lang['t19'].' '.$url.'</a></span><br class="clear" />';
	}

	if ($email)
	{
		echo '<span class="gbook_submitted_by gbook_break_text">'.$lang['t20'].' '.$email.'</span><br class="clear" />';
	}

	?>
	</div>
	<!--LEFT BOX END -->

	<!--RIGHT BOX -->
	<div class="gbook_right_box gbook_break_text">
	<span class="gbook_comments gbook_do_not_break_text"><?php echo $lang['t16']; ?></span><br class="clear" />
	<span class="gbook_comment"><?php echo $comment; ?></span><br class="clear" />
	<hr align="left" />

		<!--RIGHT BOX 1 -->
		<div class="gbook_right_box_1">
		<span class="gbook_added"><i><?php echo $lang['t31'].' '.$added; ?></i></span>
		</div>
		<!--RIGHT BOX 1 END -->

		<!--RIGHT BOX 2 -->
		<div class="gbook_right_box_2" align="right">
		<a href="gbook.php?a=delete&amp;num=<?php echo $i; ?>"><img src="<?php echo $settings['tpl_path']; ?>images/delete.gif" alt="<?php echo $lang['t32']; ?>" class="gbook_nobrd" title="<?php echo $lang['t32']; ?>" /></a>
		<a href="gbook.php?a=reply&amp;num=<?php echo $i; ?>"><img src="<?php echo $settings['tpl_path']; ?>images/reply.gif" alt="<?php echo $lang['t33']; ?>" class="gbook_nobrd" title="<?php echo $lang['t33']; ?>" /></a>
		<a href="gbook.php?a=viewIP&amp;num=<?php echo $i; ?>"><img src="<?php echo $settings['tpl_path']; ?>images/ip.gif" alt="<?php echo $lang['t09']; ?>" class="gbook_nobrd" title="<?php echo $lang['t09']; ?>" /></a>
		</div>
		<!--RIGHT BOX 2 END -->
	</div>
	<!--RIGHT BOX END -->

</div>
<!--COMMENT BOX END -->
