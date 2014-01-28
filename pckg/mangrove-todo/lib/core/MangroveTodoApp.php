<?php

class MangroveTodoApp
{
	/**
	 * @var RedBean_Instance
	 */
	public static $r;

	/**
	 * Load paths and payload json
	 */
	public static function init()
	{
		$japp = JFactory::getApplication();

		self::getDB($japp);
	}

	public static function resolve( $task )
	{
		if ( empty($task) ) return self::getApp();

		$method = strtolower($_SERVER['REQUEST_METHOD']) . ucfirst($task);

		$service = ucfirst($_REQUEST['service']) . 'Service';

		$input = @file_get_contents('php://input');

		if ( !$input ) {
			$input = '';
		} else {
			$input = json_decode($input);
		}

		if ( class_exists($service) ) {
			$service = new $service();

			$result = $service->call($method, $_REQUEST['path'], $input);

			echo json_encode($result);

			exit;
		}

		return null;
	}

	public static function getApp()
	{
		$csslink = '<link rel="stylesheet" type="text/css" media="all" href="' . JURI::root() . 'media/com_mangrove/css/%s.css" />';

		$document = JFactory::getDocument();

		$v = new JVersion();
		if ( $v->isCompatible('3.0') ) {
			$document->addCustomTag( sprintf($csslink, 'joomla3-override') );
		} else {
			$document->addCustomTag( sprintf($csslink, 'bootstrap.min') );
			$document->addCustomTag( sprintf($csslink, 'font-awesome.min') );
			$document->addCustomTag( sprintf($csslink, 'joomla-override') );
		}

		$document->addCustomTag( sprintf($csslink, 'mangrove') );

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
			'mangroveApp'
		);

		foreach ( $jsfiles as $file ) {
			if ( $file == 'angular.min' ) {
				$document->addScript( 'https://ajax.googleapis.com/ajax/libs/angularjs/1.2.10/angular.js' );
			} else {
				$document->addScript( JURI::root() . 'media/com_mangrove/js/' . $file . '.js' );
			}
		}

		return null;
	}

	/**
	 * @param object $japp JApplication
	 */
	private static function getDB( $japp )
	{
		self::$r = new RedBean_Instance();

		if ( $japp->getCfg('dbtype') == 'mysqli' ) {
			$type = 'mysql';
		} else {
			$type = $japp->getCfg('dbtype');
		}

		self::$r->addDatabase(
			'joomla',
			$type . ':'
			. 'host=' . $japp->getCfg('host') . ';'
			. 'dbname=' . $japp->getCfg('db'),
			$japp->getCfg('user'),
			$japp->getCfg('password')
		);

		self::$r->selectDatabase('joomla');

		self::$r->prefix($japp->getCfg('dbprefix') . 'mangrove_');

		self::$r->setupPipeline($japp->getCfg('dbprefix'));

		self::$r->redbean->beanhelper->setModelFormatter(new MangroveModelFormatter);
	}

}
