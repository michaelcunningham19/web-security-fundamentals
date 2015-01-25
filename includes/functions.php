<?php

require('cfg.filesystem.php');

/**
 * Fetches a template file, and returns the parsed version of it
 *
 * @param file     string  - the filename of the template file
 * @param isHeader boolean - is this template expected to be a header?
 * @param title    string  - title of the page
 *
 * @return output string - the parsed markup from the template file
 *
 */
function getTemplate($file, $isHeader = false, $title = '') {
    
    $file = TPL_DIR . $file . TPL_EXT;
	
	// fetch html template and parse inner php
	ob_start('ob_gzhandler');
	include($file);
	$output = ob_get_contents();
	ob_end_clean();
    
    if ($isHeader) {
        $output = str_replace('%TITLE%', $title, $output);
    }
    
	return $output;
}

function getHeader($title) {
	return getTemplate(TPL_HEADER, true, $title);
}

function getFooter() {
	return getTemplate(TPL_FOOTER, false);
}

?>