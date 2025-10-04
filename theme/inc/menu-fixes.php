<?php
/**
 * Menu fixes for the theme.
 *
 * @package Silicon_Beach
 */


add_filter('nav_menu_css_class', function ($classes, $item, $args, $depth) {
	if ($depth === 0) {
		if ($args->menu_id === 'primary-menu' && in_array('menu-item-has-children', $classes)) {
			$classes[] = 'dropdown dropdown-end dropdown-hover -mb-2';
		} 
		// else {
		// 	$classes[] = 'underline-animate';
		// }
	}

	return $classes;
}, 10, 4);

add_filter('nav_menu_submenu_css_class', function ($classes, $args, $depth) {
	if ($args->menu_id === 'primary-menu') {
		if ($depth === 0) {
			// Only first-level submenu gets dropdown classes
			$classes[] = 'dropdown-content menu bg-base-100 rounded-box z-1 min-w-72 p-2 shadow-sm text-primary';
		}
		// Deeper submenus (depth > 0) keep default classes for simple nested lists
	}
	return $classes;
}, 10, 3);

?>