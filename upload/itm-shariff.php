<?php

/**
 * [ITM] c't Shariff Buttons 3.0.1
 *
 * @author      McAtze
 * @copyright   (c) 2018 IT-MaKu. All rights reserved!
 * @link        https://www.it-maku.com/
 * @package     imt-shariff.php
 */

header('Content-type: application/json');

if (!isset($_GET["url"])) {
    echo json_encode(null);
    return;
}
else 
{
    $u = $_GET["url"];
}

$_GET = array();
$_POST = array();
$_COOKIE = array();
$_REQUEST = array();

$startTime = microtime(true);
$fileDir = dirname(__FILE__);

require($fileDir . '/library/XenForo/Autoloader.php');
XenForo_Autoloader::getInstance()->setupAutoloader($fileDir . '/library');

XenForo_Application::initialize($fileDir . '/library', $fileDir);
XenForo_Application::set('page_start_time', $startTime);

// get options
$o = XenForo_Application::getOptions()->getOptions();

if (empty($o['itm_ctSSB_countersCache_ttl']) || $o['itm_ctSSB_countersCache_ttl'] < 30 || $o['itm_ctSSB_countersCache_ttl'] > 86400 ) $o['itm_ctSSB_countersCache_ttl'] = 3600;

$url = @parse_url($o['boardUrl']);
$d = $url['host'];

$options = [
        "domains"   => array($d),
        "cache"    	=> array("ttl" => $o['itm_ctSSB_countersCache_ttl'], "cacheDir" => XenForo_Helper_File::getTempDir()),
        "services" 	=> array("Facebook", "LinkedIn", "Reddit", "StumbleUpon", "Flattr", "Pinterest", "AddThis", "Vk", "Xing"),
        "client" 	=> array("timeout" => 10)
];

if (!empty($o['facebookAppId']) && !empty($o['facebookAppSecret']))
{
    $options['Facebook'] = array("app_id" => $o['facebookAppId'], "secret" => $o['facebookAppSecret']);
}

if ( !empty($sc['backend']) && !empty($sc['backendOptions']['servers'][0]['host']) )
{
    $options['cache']['adapter'] = $sc['backend'];
    $options['cache']['adapterOptions'] = $sc['backendOptions'];
}

require_once $fileDir . '/library/ITM/ctSSB/shariff-backend/vendor/autoload.php';

use Heise\Shariff\Backend;

$shariff = new Backend($options);

if ($shariff)
{
    $counts = $shariff->get($u);
}

$default_counts = array("facebook" => 2230, "linkedin" => 584, "pinterest" => 480, "xing" => 799, "reddit" => 898, "stumbleupon" => 1850, "flattr" => 250, "addthis" => 182, "vk" => 285);

if (!empty($counts) && is_array($counts))
{
    $counts = array_merge($default_counts, $counts);
}
else 
{
    $counts = $default_counts;
}

echo json_encode($counts);