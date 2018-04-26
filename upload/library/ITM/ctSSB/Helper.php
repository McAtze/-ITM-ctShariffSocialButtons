<?php

class ITM_ctSSB_Helper
{	
	public static function helperITMctSSBlang($locale)
	{	    
	    return mb_substr($locale, 0, 2);
	}
	
	public static function helperITMctSSBmobile()
	{	    
	    return XenForo_Visitor::isBrowsingWith('mobile');
	}
}