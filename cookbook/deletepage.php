<?php if (!defined('PmWiki')) exit();
/*  Copyright 2005 Patrick R. Michaud (pmichaud@pobox.com)
    This file is part of PmWiki; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published
    by the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.  See pmwiki.php for full details.

    This script provides ?action=delete as an alternate method for
    removing pages from the wiki.  The delete action is controlled
    by a separate delete password (set via ?action=attr) that can
    be set on pages and groups.  To require a different set of
    privileges (e.g, 'admin'), try

        $HandleAuth['delete'] = 'admin';

    In addition, the script disables the $DeleteKeyPattern form of
    deleting, so that the only mechanism for deleting a page is to
    use ?action=delete.  To restore this, simply use

        $DeleteKeyPattern = '/^\\s*delete\\s*$/s';

    To activate this script, copy it into the cookbook/ directory,
    then add the following line to your local/config.php:

        include_once('cookbook/deletepage.php');
   
*/

# disable deletion via ?action=edit
SDV($DeleteKeyPattern, '.^');

# add "delete" password to page attributes
SDV($PageAttributes['passwddelete'], '$[Set new delete password:]');

# set default password for delete action
SDV($DefaultPasswords['delete'], '');

# add "?action=delete"
SDV($HandleActions['delete'], 'HandleDelete');
SDV($HandleAuth['delete'], 'delete');
SDV($AuthCascade['delete'], 'edit');

function HandleDelete($pagename, $auth='delete') {
  global $WikiDir, $LastModFile;
  $page = RetrieveAuthPage($pagename, $auth, true, READPAGE_CURRENT);
  if (!$page) { Abort("?cannot delete $pagename"); return; }
  $WikiDir->delete($pagename);
  if ($LastModFile) { touch($LastModFile); fixperms($LastModFile); }
  Redirect($pagename);
  exit;
}

