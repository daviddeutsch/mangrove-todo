<?php

// Dont allow direct linking
defined('_JEXEC') or die( 'Direct Access to this location is not allowed.' );

require_once( dirname(__FILE__) . '/autoload.php' );

MangroveTodoApp::add( dirname(__FILE__), 'mangrovetodo', array('todo') );

MangroveTodoApp::start();
