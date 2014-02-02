<?php

class MangroveTodoApp extends MangroveAppBase
{
	public static function getApp()
	{
		$v = new JVersion();

		self::addAssets(
			'css',
			array(
				'font-awesome.min',
				'joomla' . ($v->isCompatible('3.0') ? '3' : '') . '-override',
				'mangrove-todo'
			)
		);

		self::addAssets(
			'js',
			array(
				'jquery-1.7.2.min',
				'angular.min', 'angular-animate.min', 'angular-resource.min', 'angular-route.min',
				'ui-bootstrap-tpls.min', 'angular-ui-router.min',
				'lodash.min', 'restangular.min',
				'observe', 'omnibinder',
				'mangroveTodoApp'
			)
		);

		return null;
	}
}
