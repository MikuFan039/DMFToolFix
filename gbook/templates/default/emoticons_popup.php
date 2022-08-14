<?php
if (!defined('IN_SCRIPT')) {
	die('Invalid attempt');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $lang['t70']; ?></title>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo $lang['enc']; ?>" />
<script type="text/javascript"><!--
function insertSmiley(text)
{
	var space=" ";
	parent.opener.document.getElementById('cmnt').value += space + text + space;
}
//-->
</script>
<link href="<?php echo $settings['tpl_path']; ?>style.css" rel="stylesheet" type="text/css" />
</head>

<body class="gbook_emoticons">

<div class="gbook_emoticons">

<?php echo $lang['t71']; ?>
<br class="clear" />
<br class="clear" />

<?php echo $list_emoticons; ?>
<br class="clear" />
<br class="clear" />


<a href="javascript:void(0)" onclick="Javascript:self.close()"><?php echo $lang['t72']; ?></a>
<br class="clear" />
<br class="clear" />

</div>

</body>

</html>

