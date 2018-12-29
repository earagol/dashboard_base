<?php

// Configure::write('debug', 0);

if( ! isset($name) ) {
	$name = 'Excel ' . time();
}

// header('Pragma: public');
// // header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
// header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
// header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0');
// header('Pragma: no-cache');
// header('Expires: 0');
// header('Content-Transfer-Encoding: none');
// // header('Content-Type: application/x-msexcel; charset=utf-8');
// //echo "\xEF\xBB\xBF";
// //header('Content-Type: application/vnd.ms-excel; charset=utf-8');
// header("Content-Type: application/vnd.ms-excel charset=iso-8859-1");
// header('Content-Disposition: attachment; filename="' . $name . '.xls"');
// //
// // echo utf8_decode($content);

header("Pragma: public");
header("Expires: 0");
// header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0');
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Type: application/force-download");
header("Content-Type: application/download");;
//header("Content-Disposition: inline; filename=\"".$filename.".xls\"");
// Name the file to .xlsx to solve the excel/openoffice file opening problem
header("Content-Disposition: attachment; filename=\"".$name.".xls\"");
echo utf8_decode($this->fetch('content'));

?>

