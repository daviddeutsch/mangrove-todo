<?php

// Dont allow direct linking
defined('_JEXEC') or die( 'Direct Access to this location is not allowed.' );

require_once( dirname(__FILE__) . '/autoload.php' );

MangroveTodoApp::init();

if ( !empty( $_GET['path'] ) ) {
	echo MangroveTodoApp::resolve( substr($_GET['path'], 1) );
} else {
	MangroveTodoApp::getApp();

	include dirname(__FILE__) . '/templates/main.html';
}
