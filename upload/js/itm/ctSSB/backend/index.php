<?php

require_once __DIR__.'/vendor/autoload.php';

use Heise\Shariff\Backend;

/**
 * Demo Application using Shariff Backend.
 */
class Application
{
    /**
     * Sample configuration.
     *
     * @var array
     */
    private static $configuration = array(
        'cache' => array(
            'ttl' => 60,
        ),
        'domains' => array(
            'www.heise.de',
            'www.ct.de',
        ),
        'services' => array(
            'GooglePlus',
            'Facebook',
            'LinkedIn',
            'Reddit',
            'StumbleUpon',
            'Flattr',
            'Pinterest',
            'Xing',
            'AddThis',
            'Vk',
        ),
    );

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
