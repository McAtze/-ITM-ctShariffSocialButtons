<?php

class ITM_ctSSB_Listener
{
    /**
     * @param $templateName
     * @param $content
     * @param array $containerData
     * @param XenForo_Template_Abstract $template
     */
    
    public static function template_post_render($templateName, &$content, array &$containerData, XenForo_Template_Abstract $template)
    {
        if ($template instanceof XenForo_Template_Admin) {
            $params = $template->getParams();

            switch ($templateName) {
                case 'option_list':
                    if (isset($params['group']['group_id']) &&
                        $params['group']['group_id'] === 'itm_ctSSB') {
                        $content = $template->create('itm_ctSSB_option_list', $params);
                    }
                    break;
            }
        }
    }
}
