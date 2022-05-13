<?php if (!defined('PmWiki')) exit();
## Page generation timer recipe
$GenerationBegin = explode(' ', microtime());
$GenerationBegin = $GenerationBegin[0] + $GenerationBegin[1];
function GenerationTime(){
	global $GenerationBegin;
	$GenerationEnd = explode(' ', microtime());
	$GenerationEnd = $GenerationEnd[0] + $GenerationEnd[1];
	$GenerationTotal = $GenerationEnd - $GenerationBegin;
	$GenerationTotal = round($GenerationTotal, 5);
	print "$GenerationTotal";
}

function formatBytes($size, $precision = 2)
{
    $base = log($size) / log(1024);
    $suffixes = array('', 'k', 'M', 'G', 'T');   

    return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
}

function MemoryPeakUseage() {
    $mem = memory_get_peak_usage(true);
    print formatBytes($mem);
}