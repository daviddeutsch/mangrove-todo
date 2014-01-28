<?php

// Dont allow direct linking
defined('_JEXEC') or die( 'Direct Access to this location is not allowed.' );

require_once( dirname(__FILE__) . '/autoload.php' );

MangroveTodoApp::init();

if ( !empty( $_GET['task'] ) ) {
	echo MangroveTodoApp::resolve($_GET['task']);
} else {
	MangroveTodoApp::getApp();

	include dirname(__FILE__) . '/templates/main.html';
}
