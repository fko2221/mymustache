<?php
//
// Custom Mustache Class
//
class MyMustache extends Mustache_Engine
{

	function __construct($path="",$extension='.htm') {
	
		if ( ! $path ) {
			$path = dirname($_SERVER['SCRIPT_FILENAME']);
		}
		
		$options =  array('extension' => $extension);
		parent::__construct(array(
			'loader' => new Mustache_Loader_FilesystemLoader($path, $options),
			'pragmas' => array(Mustache_Engine::PRAGMA_FILTERS)
		));
		
		parent::addHelper('$',function($value) { return '$'.@number_format($value,2); });
		parent::addHelper(',',function($value) { return @number_format($value,2); });
		parent::addHelper('%',function($value) { return ($value == 0 ? '' : ($value*100).'%' ); });
		parent::addHelper('UC',function($value) { return @strtoupper((string)$value); });
		parent::addHelper('LC',function($value) { return @strtolower((string)$value); });
		parent::addHelper('MDY',function($value) { return strtotime((string)$value)? @date('m/d/Y',strtotime((string)$value)) : ''; });
		parent::addHelper('NL2BR',function($value) { return @nl2br((string)$value); });
		parent::addHelper('JSON',function($value) { return @json_encode($value); });
		
	}

}
?>