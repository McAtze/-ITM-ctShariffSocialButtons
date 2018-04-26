<?php

class ITM_ctSSB_Listener
{

	/**
	 * @param $templateName
	 * @param $content
	 * @param array $containerData
	 * @param XenForo_Template_Abstract $template
	 */
	public static function extendInitDependencies(XenForo_Dependencies_Abstract $dependencies, array $data)
	{
	    // Get the static variable $helperCallbacks and add a new item in the array.   
	    XenForo_Template_Helper_Core::$helperCallbacks += array(
	            'itm_ctSSB_lang' => array('ITM_ctSSB_Helper', 'helperITMctSSBlang'),
	            'itm_ctSSB_mobile' => array('ITM_ctSSB_Helper', 'helperITMctSSBmobile')
	          );
	}
	
	public static function template_post_render($templateName, &$content, array &$containerData, XenForo_Template_Abstract $template)
	{
		if ($template instanceof XenForo_Template_Admin)
		{
			$params = $template->getParams();

			switch ($templateName)
			{
				case 'option_list':
					if (isset($params['group']['group_id']) &&
						$params['group']['group_id'] === 'itm_ctSSB')
					{
						$content = $template->create('itm_ctSSB_option_list', $params);
					}
					break;
			}
		}
	}
}