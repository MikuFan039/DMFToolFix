<?php if (!defined('PmWiki')) exit();
/*  Copyright 2007 Patrick R. Michaud (pmichaud@pobox.com)
    This file is fplcount.php; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published
    by the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.  

    This recipe adds a "fmt=count" option to (:pagelist:), to return a
    simple count of the number of pages in the list.  Examples:

    (:pagelist fmt=count:)                    # pages on the wiki
    (:pagelist group=Main fmt=count:)         # pages in group Main
    (:pagelist link={*$FullName} fmt=count:)  # links to current page
    
    To use this recipe, simply copy it into the cookbook/ directory, and
    add the following line to a local customization:

        include_once('cookbook/fplcount.php');

*/

$RecipeInfo['PagelistCount']['Version'] = '2007-03-29';

SDVA($FPLFormatOpt['count'], array('fn' => 'FPLCount'));

function FPLCount($pagename, &$matches, $opt) {
  $matches = array_values(MakePageList($pagename, $opt, 0));
  return count($matches);
}


