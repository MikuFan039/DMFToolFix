<?php if (!defined('PmWiki')) exit();
/*
    uploadform.php
    Copyright 2007 Hans Bracker
    Copyright 2007 Knut Alboldt
    Copyright 2004-2007 Patrick Michaud
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published
    by the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.
    
    Script to create alternative upload forms with alternative postupload handler function
    and Input form using (:input file uploadfile:) markup.
    With Firefox drag-drop-upload extension installed use 
    (:input dropfiles uploadfiles:) for uploading multiple files.
*/
$RecipeInfo['UploadForm']['Version'] = '2009-08-26';

# add action 'postupload2'. To be used with (:input hidden action postupload2:) form markup.
# (to REPLACE default postupload action rename 'postupload2' to 'postupload')
$HandleActions['postupload2'] = 'HandlePostUpload2';
SDVA($HandleAuth, array('upload' => 'upload',  'download' => 'read'));
SDV($HandleAuth['postupload2'], $HandleAuth['upload']);

function HandlePostUpload2($pagename, $auth = 'upload') {
  global $UploadVerifyFunction, $UploadFileFmt, $LastModFile, 
    $EnableUploadVersions, $Now, $MessagesFmt, $FmtV;
    UploadAuth($pagename, $auth);
  $page = RetrieveAuthPage($pagename, $auth, true, READPAGE_CURRENT);
  if (!$page) Abort("?cannot upload to $pagename");
  foreach($_FILES as $n=>$v) { 
     # multiple files input with (:input files uploadfiles:)
     $uploadfile = $_FILES[$n];
     $upname = $uploadfile['name'];
     if ($upname=='') break;
     # special case single file input with (:input file uploadfile:) 
     if($_FILES['uploadfile']) {
         $uploadfile = $_FILES['uploadfile'];
         $upname = $_REQUEST['upname'];
         if ($upname=='') $upname=$uploadfile['name'];
     }
     $upname = MakeUploadName($pagename,$upname);
     if (!function_exists($UploadVerifyFunction))
       Abort('?no UploadVerifyFunction available');
     $filepath = FmtPageName("$UploadFileFmt/$upname",$pagename);
     $result = $UploadVerifyFunction($pagename,$uploadfile,$filepath);
     if ($result=='') {
       $filedir = preg_replace('#/[^/]*$#','',$filepath);
       mkdirp($filedir);
       if (IsEnabled($EnableUploadVersions, 0))
         @rename($filepath, "$filepath,$Now");
       if (!move_uploaded_file($uploadfile['tmp_name'],$filepath))
         { Abort("?cannot move uploaded file to $filepath"); return; }
       fixperms($filepath,0444);
       if ($LastModFile) { touch($LastModFile); fixperms($LastModFile); }
       $result = "upresult=success";
     }
     # process results for message
     $re = explode('&',substr($result,9));
     # special cases: 
     if($re[0]=='badtype' OR $re[0]=='toobigext') {
         global $upext, $upmax;
         $r1 = explode('=',$re[1]);
         $upext = $r1[1];
         $r2 = explode('=',$re[2]);
         $upmax = $r2[1];
     }
     $result = $re[0];
     $MessagesFmt[] = "<div class='wikimessage'><i>$upname</i>: $[UL$result]</div>";
  }
  HandleBrowse($pagename);
}


# For use with Firefox drag-drop-upload extension:
# add event handler for javascript for drag-drop multiple files to (:input dropfiles uploadfiles:)
# Note only control (:input dropfiles uploadfiles:) will clone, not (:input file uploadfile:)
# add javascript for cloning input file control 
$InputTags['dropfiles'][':html'] =
     " <div><input onchange=\"cloneAndAppend(null, this)\" type=\"file\" style=\"\" \$InputFormArgs /></div>
       <script type='text/javascript'><!--
         function cloneAndAppend(event, input) {
           if (!input) input = this;
           var newNode = input.parentNode.cloneNode(true);
           var newInput = newNode.getElementsByTagName(\"input\")[0];
           newInput.value = \"\";
           newInput.onchange = cloneAndAppend;
           newInput.name = input.name + \"X\";
           input.parentNode.parentNode.appendChild(newNode);
         }
       //--></script>
";