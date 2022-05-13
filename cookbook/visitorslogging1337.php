<?php if (!defined('PmWiki')) exit();

/*  This file is visitorslogging1337.php; you can redistribute it and/or 
    modify it under the terms of the GNU General Public License as published
    by the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

        //                                               \\
       //  |\ |\ ||  Piotr Szczepanski                    \\
      //-- ||\||\|| ---------------------------------------\\
     //    ||/||/||  www.piotr.szczepanski.name            //
    //     |/ |/ ||                                       //

    Based on work by Christophe David (www.christophedavid.org) in 2005.

    Modified by Piotr Szczepanski (www.piotr.szczepanski.name)
    in September 2006 for more configurability, including customized
    log format strings.

    This script creates a log file for the wiki usage.

    For documentation, instructions or newer versions, see:

    http://www.pmwiki.org/wiki/Cookbook/VisitorsLogging1337

    To use this script, simply copy it into the cookbook/ directory
    and add the following line to config.php or a per-page/per-group
    customization file.

        include_once $FarmD . 'cookbook/visitorslogging1337.php';

    Then, create the VisitorsLog directory in your $UploadsDir.

*/

// Define version
define(VISITORS_LOGGING, '1.3.37');

// Set default config values (can be overriden in farmconfig.php, config.php, etc.

// Log directory and filename format
SDV($VisitorsLoggingDirectory, "$UploadDir/VisitorsLog");
SDV($VisitorsLoggingFileName, "%Y-%m-%d.txt"); // further parsed by strftime

// Set to number of days after which the logs should be removed (0 means never)
SDV($VisitorsLoggingPurgeAfterDays, 0);

// Log format (see the source below for allowed values)
SDV($VisitorsLoggingFormat, '%Date %Time %RemoteAddr:pad %Action:pad %HttpHost %WikiGroup.%WikiPage "%HttpReferer" "%HttpUserAgent"' . "\n");
SDV($VisitorsLoggingDateFormat, '%Y-%m-%d'); // parsed by strftime
SDV($VisitorsLoggingTimeFormat, '%H:%M:%S'); // parsed by strftime

// The following addresses will not be logged
SDV($VisitorsLoggingIgnoreList, array('127.0.0.1'));

// Only act if the directory already exists and is writeable
if (is_dir($VisitorsLoggingDirectory) && is_writeable($VisitorsLoggingDirectory))
{

    // Find out the log file name
    $TimeNow = time();
    $VisitorsLoggingFileName = $VisitorsLoggingDirectory . '/' . strftime($VisitorsLoggingFileName, $TimeNow);

    /* Task: Cleanup */

    // Cleanup (only if enabled) and only once a day
    if($VisitorsLoggingPurgeAfter > 0 && !file_exists($VisitorsLoggingFileName))
    {

	// Only if the directory opens correctly
	if (is_writeable($VisitorsLoggingDirectory) && ($DirectoryHandle = @opendir($VisitorsLoggingDirectory)) === true)
	{

	    // Recurse through all files in this directory, but skip directories
	    while ($file = readdir($DirectoryHandle) === true) if (!is_dir($file))
	    {
		// Retrieve last modification date, calculate age
        	$FileFullPath = $VisitorsLoggingDirectory . '/' . $file;
        	$FileStat = stat($FileFullPath);
    		$FileAge = $TimeNow - $FileStat['mtime'];

		// Compare to config value: if older than allowed -- delete it
		// NOTE: this is potentially dangerous if you wanted to keep some other
		// files in the log directory -- they would get deleted as well
		if ($FileAge > ($VisitorsLoggingPurgeAfterDays * 86400))
		    unlink($FileFullPath);
	    }
	    closedir($DirectoryHandle);
	}
    }


    /* Task: Write Log Entry */

    // Only if log file can be opened for appending
    // and the remote address is not on the ignore list
    if(($FileHandle = @fopen($VisitorsLoggingFileName, 'a')) !== false 
    && !in_array($_SERVER['REMOTE_ADDR'], $VisitorsLoggingIgnoreList))
    {
	// Variables available to VisitorLoggingFormat
	$ReplacementArray = 
	array(
	    '%Date' => strftime($VisitorsLoggingDateFormat, $TimeNow),
	    '%Time' => strftime($VisitorsLoggingTimeFormat, $TimeNow),
	    '%RemoteAddr:pad' => sprintf('%-15s', $_SERVER['REMOTE_ADDR']),
	    '%RemoteAddr' => $_SERVER['REMOTE_ADDR'],
	    '%Action:pad' => sprintf('%-8s', $action),
	    '%Action' => $action,
	    '%HttpHost' => $_SERVER['HTTP_HOST'],
	    '%HttpReferer' => $_SERVER['HTTP_REFERER'],
	    '%HttpUserAgent' => $_SERVER['HTTP_USER_AGENT'],
	    '%WikiGroup' => FmtPageName('$Group', $pagename),
	    '%WikiPage' => FmtPageName('$Name',  $pagename),
	);

	// Provide the resolved hostname only if it is needed
	// (resolving hostnames may be time-consuming)
	if (strstr($VisitorsLoggingFormat, '%RemoteHost'))
	{
	    if(!empty($_SERVER['REMOTE_HOST']))
		// This checks if you have "HostnameLookups (on|double)" in httpd.conf
		// most people don't as this is a resource hog
		$ReplacementArray['%RemoteHost'] = $_SERVER['REMOTE_HOST'];
	    else
		$ReplacementArray['%RemoteHost'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	}

	// Create the log entry
	$VisitorsLoggingEntry = $VisitorsLoggingFormat;
	foreach($ReplacementArray as $Variable => $Replacement)
	{
	    $VisitorsLoggingEntry = str_replace($Variable, $Replacement, $VisitorsLoggingEntry);
	}

	// Write the log entry to file
	fwrite($FileHandle, $VisitorsLoggingEntry);

	// Close the log file
	fclose($FileHandle);
    }

}
