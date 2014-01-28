<?php

/*
 * Mock Autoloader to supply the base classes that mangrove needs to boot up
 *
 * Will be replaced during self install
 */

$base = realpath( dirname(__FILE__) . '/../../../libraries' );

$c = 'valanx/mangrove-todo/lib/core/';

$includes = array(
	'redbean/redbean-adaptive/rb',
	$c . 'MangroveTodoApp',
	$c . 'MangroveTodoModelFormatter',

	$c . 'Models/TodoModel',
	$c . 'Services/AbstractService',
	$c . 'Services/RestService',
	$c . 'Services/TodoService',
);

foreach ( $includes as $path ) {
	include_once($base . '/' . $path . '.php');
}
