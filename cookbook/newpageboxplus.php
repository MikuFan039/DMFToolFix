<?php if (!defined('PmWiki')) exit();
/*  Copyright 2006 Hans Bracker, modified from newpagebox.php
    Copyright 2005 Patrick R. Michaud (pmichaud@pobox.com) and
    newpagebox3.php thanks to code from DaveG.
    This file is newpageboxplus.php; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published
    by the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.  

    To use this script, simply place it into the cookbook/ folder
    and add the line
        include_once('cookbook/newpageboxplus.php');
    to a local customization file. Use it as an alternative to newpagebox.php.
    
    usage: (:newpagebox [parameter=value] [parameter=value] :)
    
    Possible parameters to use inside the markup:
    
    base=Group.PageName -- create page in the same group as Group.PageName 
                           (PageName does not need to exist). base=Group is NOT enough!
    template=Group.PageTemplateName -- use Group.PageTemplateName as template for new page.
    value="Create New Page" -- label or value for the inside of the field, 
                            which disappears when clicking the box. Default is empty: "".
    prefix="nameprefix", suffix="namesuffix" -- prefix or suffix gets added to the name.
    size=number -- size of input box, default is 30.
    label="Button Label" -- label for the button, default "Create a new page called:".
    button=position -- use "left" or "right" to position button (default is "left").
    focus=true -- adds onfocus and onblur javascript which will make any intial value 
                    disappear when clicking on the box. Default is "".
    
*/
# Version date
$RecipeInfo['NewPageBoxPlus']['Version'] = '2009-01-29';

# save=true option disabled by default, but available if authorised at 'edit' level
SDV($EnableAutoSave, false);

# $NewPageProtectedGroups is an array of group names for which creation of new pages is prohibited.
# Example to add group called 'MyGroup':
# add to config: $NewPageProtectedGroups[] = 'MyGroup';
SDVA($NewPageProtectedGroups, array('SiteAdmin','Site'));

# Set$NewPageBaseGroup in config  to limit page creation to a specific group.
# Example: $NewPageBaseGroup = 'Main';

# add markup (:newpagebox:)
Markup('newpagebox', 'directives',
  '/\\(:newpagebox\\s*(.*?):\\)/ei',
  "NewPageBox(\$pagename, PSS('$1'))");
  
# add action=new (the form sends this with the other values)
$HandleActions['new'] = 'HandleNew';

# add form function. The values for parameter defaults can be changed here
function NewPageBox($pagename, $opt) {
  $PageUrl = PageVar($pagename, '$PageUrl');    
  $defaults = array(
#    'size'   => '30',
    'label' => FmtPageName(' $[Create a new page called:] ', $pagename),
    'button' => 'left');
  $opt = array_merge($defaults, ParseArgs($opt));
  $buttonHTML = "    <input class='inputbutton newpagebutton' type='submit' value='{$opt['label']}' /> \n";
  $onfocusHTML = "
      onfocus=\"if(this.value=='{$opt['value']}') {this.value=''}\" onblur=\"if(this.value=='') {this.value='{$opt['value']}'}\" ";
  $out = "\n   <form class='newpage' action='{$PageUrl}' method='post'>
    <input type='hidden' name='n' value='$pagename' />
    <input type='hidden' name='action' value='new' /> \n".
    ($opt['value'] ? "    <input type='hidden' name='value' value='{$opt['value']}' /> \n" : "").
    ($opt['focus'] ? "    <input type='hidden' name='focus' value='{$opt['focus']}' /> \n" : "").
    ($opt['base'] ? "     <input type='hidden' name='base' value='{$opt['base']}' /> \n" : "").
    ($opt['prefix'] ? "    <input type='hidden' name='prefix' value='{$opt['prefix']}' /> \n" : "").
    ($opt['suffix'] ? "    <input type='hidden' name='suffix' value='{$opt['suffix']}' /> \n" : "").
    ($opt['save'] ? "    <input type='hidden' name='save' value='{$opt['save']}' /> \n" : "").
    ($opt['template'] ? "    <input type='hidden' name='template' value='{$opt['template']}' /> \n" : "").
    ($opt['button']=="left" ? $buttonHTML : "") .
    "    <input class='inputbox newpagetext' type='text' name='name' value='{$opt['value']}' size='{$opt['size']}'" .
    ($opt['focus']==1||$opt['focus']=='true' ? $onfocusHTML : "") . 
    "/> \n" .
    ($opt['button']=="right" ? $buttonHTML : "") .
    "  </form>";
    return Keep($out);
}

# handles action=new, i.e. what the form sends, sends new page to edit
function HandleNew($pagename) {
	global $Author, $Now, $EnableAutoSave, $NewPageProtectedGroups, $NewPageBaseGroup, $PageUrl;
	$name = @$_REQUEST['name'];
	if (!$name) Redirect($pagename);
	if(@$_REQUEST['prefix']) $name = $_REQUEST['prefix'].$name;
	if(@$_REQUEST['suffix']) $name = $name.$_REQUEST['suffix'];
	if (@$_REQUEST['focus'] && $name==$_REQUEST['value']) Redirect($pagename);
	if (isset($NewPageBaseGroup)) 
	  $base = MakePageName($pagename, $NewPageBaseGroup.".HomePage");
	else if ($_REQUEST['base'])
		$base = MakePageName($pagename, $_REQUEST['base']);
	$basegroup = PageVar($base, '$Group'); 
	if (isset($NewPageBaseGroup) OR $_REQUEST['base']) {
		$name = str_replace(".", "", $name);
		$newpage = MakePageName($base, "$basegroup.$name");	
	}
	else $newpage = MakePageName($pagename, $name);

	if (in_array(PageVar($newpage, '$Group'),$NewPageProtectedGroups)) Redirect($pagename);
	$urlfmt = '$PageUrl?action=edit';
	if (@$_REQUEST['template']) {
		$urlfmt .= '&template=' . MakePageName($base, $_REQUEST['template']); 
	}
	if ((@$_REQUEST['save']=='1' || @$_REQUEST['save']=='true') AND ($EnableAutoSave==1 OR CondAuth($pagename,'edit'))) { 
		if(PageExists($newpage)) Redirect($newpage, $urlfmt);
		if (@$_REQUEST['template'] && PageExists($_REQUEST['template'])) {
			$p = RetrieveAuthPage($_REQUEST['template'], 'read', false, READPAGE_CURRENT);
			if ($p['text'] > '') $new['text'] = $p['text']; 
			$new['author'] = $Author;
			$new['ctime'] = $Now; 
		}
		SaveAttributes($newpage, $new, $new);
		PostPage($newpage, $new, $new);
		PostRecentChanges($newpage, $new, $new);
		Redirect($newpage);
	}
	Redirect($newpage, $urlfmt);
}

