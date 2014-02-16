<?php

class MangroveTodoApp extends MangroveAppInstance
{
	public $name = 'mangrove-todo';

	public function getApp()
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
				'angular.min', 'angular-animate.min',
				'ui-bootstrap-tpls.min', 'angular-ui-router.min',
				'observe', 'omnibinder',
				'mangroveBase',
				'mangroveTodoApp'
			)
		);

		return null;
	}
}
