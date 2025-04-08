<?php

function buildMenu() {
  // create an array of URLs and labels
	$menu = array(
		'index' => 'actors',
		'movies' => 'movies',
		'movie-actors' => 'movie actors',
		'quick-add' => 'quick add'
	);
	// construct the menu, setting the current menu item 'selected' if 
	// we are on the page that matches the URL
	$menuOutput = '<ul id="menu">';
	foreach ($menu as $key => $value) {
		// Get the current script name without the full path
		$currentScript = basename($_SERVER['PHP_SELF']);
		if($currentScript == "$key.php") {
			$selected = ' class="selected"';
		} else {
			$selected = '';
		}
		// Add the correct path to the links
		$menuOutput .= '<li' . $selected . '><a href="' . $key . '.php" title="' . $value . '">' . $value . '</a></li>';
	}
	$menuOutput .= '</ul>';
  return $menuOutput;
}

?>
