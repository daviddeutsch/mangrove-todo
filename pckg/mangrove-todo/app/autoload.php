<?php

/*
 * Mock Autoloader to supply the base classes that mangrove needs to boot up
 *
 * Will be replaced during self install
 */

$base = realpath( dirname(__FILE__) . '/../../../libraries' );

$b = 'valanx/mangrove-todo/lib/core/';

$c = 'valanx/mangrove-base/lib/core/';

$includes = array(
	'redbean/redbean-adaptive/rb',
	$b . 'MangroveAppBase',
	$b . 'MangroveAppInstance',
	$b . 'MangroveModelFormatter',

	$c . 'MangroveTodoApp',

	$b . 'Services/AbstractService',
	$b . 'Services/RestService',
	$b . 'Services/HookService',
);

foreach ( $includes as $path ) {
	include_once($base . '/' . $path . '.php');
}
