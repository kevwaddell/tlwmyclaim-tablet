<?php 
/*
Template Name: XML Processor
*/
?>

<?php 
$path = $_SERVER['DOCUMENT_ROOT'];
$xml_files = glob($path."/tlw-XMLProcessor/*.xml");
//echo '<pre class="debug">';print_r($xml_files);echo '</pre>';
if ( empty($xml_files) ) {
echo "There are no files to process\n";	
} else {
	if (count($xml_files) == 1) {
	echo "There is ". count($xml_files) ." file to be processed<br>\n";	
	} else {
	echo "There are ". count($xml_files) ." files to be processed<br>\n";	
	}
}
?>