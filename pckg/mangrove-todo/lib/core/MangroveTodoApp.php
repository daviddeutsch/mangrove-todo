<?php

class MangroveTodoApp extends MangroveAppBase
{
	public static function getApp()
	{
		$csslink = '<link rel="stylesheet" type="text/css" media="all" href="' . JURI::root() . 'media/com_mangrovetodo/css/%s.css" />';

		$document = JFactory::getDocument();

		$v = new JVersion();
		if ( $v->isCompatible('3.0') ) {
			$document->addCustomTag( sprintf($csslink, 'joomla3-override') );
		} else {
			$document->addCustomTag( sprintf($csslink, 'font-awesome.min') );
			$document->addCustomTag( sprintf($csslink, 'joomla-override') );
		}

		$document->addCustomTag( sprintf($csslink, 'mangrove-todo') );

		$jsfiles = array(
			'jquery-1.7.2.min',
			'angular.min',
			'angular-animate.min',
			'angular-resource.min',
			'angular-route.min',
			'ui-bootstrap-tpls.min',
			'angular-ui-router.min',
			'spinners.min',
			'observe',
			'omnibinder',
			'lodash.min',
			'restangular.min',
			'mangroveTodoApp'
		);

		foreach ( $jsfiles as $file ) {
			if ( false /*$file == 'angular.min'*/ ) {
				$document->addScript( 'https://ajax.googleapis.com/ajax/libs/angularjs/1.2.10/angular.js' );
			} else {
				$document->addScript( JURI::root() . 'media/com_mangrovetodo/js/' . $file . '.js' );
			}
		}

		return null;
	}
}
