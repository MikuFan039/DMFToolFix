<?php
if (!defined('IN_SCRIPT')) {
	die('Invalid attempt');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $settings['gbook_title']; ?></title>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo $lang['enc']; ?>" />
<script type="text/javascript"><!--
function openSmiley()
{
	w=window.open("smileys.php", "smileys", "fullscreen=no,toolbar=no,status=no,menubar=no,scrollbars=yes,resizable=yes,directories=no,location=no,width=500,height=300");
	if(!w.opener)
	{
		w.opener=self;
	}
}
//-->
</script>
<link href="<?php echo $settings['tpl_path']; ?>style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<!--CUSTOM HEADER -->
<?php
include_once 'header.txt';
?>
<!--CUSTOM HEADER END -->

<!--HEADER -->
<div id="gbook_header">
        <h1 align="center"><?php echo $settings['gbook_title']; ?></h1>
        <!--TOP LINKS -->
        <div id="gbook_top_links">

                <a href="<?php echo $settings['website_url']; ?>"><?php echo $settings['website_title']; ?></a> |
		<a href="gbook.php"><?php echo $lang['t60']; ?></a> |
		<a href="gbook.php?a=sign"><?php echo $lang['t48']; ?></a>
		<br class="clear" />

                <span class="gbook_entries_top"><?php echo $settings['number_of_entries']; ?> <?php echo $settings['number_of_pages']; ?></span>
		<br class="clear" />
                <?php echo $settings['pages_top']; ?>

        </div>
        <!--TOP LINKS -->
</div>
<!--HEADER END -->

<!--NOTICE -->
<?php
if (isset($settings['notice']) && !empty($settings['notice']))
{
	echo '<div class="gbook_sign_notice">'.$settings['notice'].'</div>';
}
?>
<!--NOTICE END -->

