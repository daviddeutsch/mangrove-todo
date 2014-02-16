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
		$b . 'MangroveAppBase',
		$b . 'MangroveAppInstance',
		$b . 'MangroveModelFormatter',

		$t . 'MangroveTodoApp',

		$b . 'Services/AbstractService',
		$b . 'Services/RestService',
		$b . 'Services/HookService',
	) as $path ) {
	include_once( $base . '/' . $path . '.php' );
}
