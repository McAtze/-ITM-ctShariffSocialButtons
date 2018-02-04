<?php

require_once __DIR__.'/vendor/autoload.php';

use Heise\Shariff\Backend;
use Zend\Config\Reader\Json;

class Application
{
    private static $configuration = [
        'cache' => [
            'ttl' => 60
        ],
        'domains' => [
            'demo.it-maku.com',
            'it-maku.com'
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
      		'app_id' => '346819142103427',
      		'secret' => '1085ebfaad7edb32e56b9dde3389a0e3'
    	]
    ];

    public static function run()
    {
        header('Content-type: application/json');

        $url = isset($_GET['url']) ? $_GET['url'] : '';
        if ($url) {
            $shariff = new Backend(self::$configuration);
            echo json_encode($shariff->get($url));
        } else {
            echo json_encode(null);
        }
    }
}

Application::run();
