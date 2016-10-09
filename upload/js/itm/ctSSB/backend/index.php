<?php

require_once __DIR__.'/vendor/autoload.php';

use Heise\Shariff\Backend;

/**
 * Demo Application using Shariff Backend
 */
class Application
{
    /**
 	* Sample configuration
 	*
 	* @var array
 	*/
	private static $configuration = [
    	'cacheClass' => 'Heise\\Shariff\\ZendCache',
    	'cache' => [
        	'ttl' => 60,
        	'cacheDir' => '/tmp/shariff/cache',
        	'adapter' => 'Filesystem',
        	'adapterOptions' => [
          	// ...
        	]
    	],
    	'client' => [
      		'timeout' => 4.2
      		// ... (see "Client options")
    	],
    	'domains' => [
        	'www.heise.de',
        	'www.ct.de'
    	],
    	'services' => [
        	'GooglePlus',
        	'Facebook',
        	'LinkedIn',
        	'Reddit',
        	'StumbleUpon',
        	'Flattr',
        	'Pinterest',
        	'Xing',
        	'AddThis'
    	],
    	'Facebook' => [
      		'app_id' => '1234567890',
      		'secret' => 'terces'
    		]
		];
}

Application::run();
