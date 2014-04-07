<?php

/*
 * Mock Autoloader to supply the base classes that mangrove needs to boot up
 *
 * Will be replaced during self install
 */

$base = realpath( dirname(__FILE__) . '/../../../libraries' );

$b = 'valanx/mangrove-base/lib/core/';

$t = 'valanx/mangrove-todo/lib/core/';

foreach (
	array(
		'redbean/redbean-adaptive/rb',
		'valanx/saltwater/sw',

		$b . 'Context/Joomla',
		$b . 'MangroveApp',

		$t . 'Context/MangroveTodo',
	) as $path ) {
	include_once( $base . '/' . $path . '.php' );
}
