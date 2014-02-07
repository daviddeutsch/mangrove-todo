<?php

// Dont allow direct linking
defined('_JEXEC') or die( 'Direct Access to this location is not allowed.' );

require_once( dirname(__FILE__) . '/autoload.php' );

MangroveApp::addSimple( dirname(__FILE__), 'mangrovetodo', array('todo') );

MangroveApp::start();
