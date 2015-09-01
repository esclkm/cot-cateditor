<?php

/**
 * pagecattree Plugin for Cotonti CMF
 *
 * @version 2.0.0
 * @author esclkm, http://www.littledev.ru
 * @copyright (c) 2008-2011 esclkm, http://www.littledev.ru
 */
defined('COT_CODE') or die('Wrong URL.');

$adminpath[] = array(cot_url('admin', 'm=structure'), $L['Structure']);
// Show available module list

if (is_array($extension_structure) && count($extension_structure) > 0)
{
	foreach ($extension_structure as $code)
	{
		$parse = false;
		if (cot_plugin_active($code))
		{
			$is_module = false;
			$parse = true;
		}
		if (cot_module_active($code))
		{
			$is_module = true;
			$parse = true;
		}
		if ($parse)
		{
			$ext_info = cot_get_extensionparams($code, $is_module);
			$t->assign(array(
				'ADMIN_STRUCTURE_EXT_URL' => cot_url('admin', 'm=other&p=cateditor&n='.$code),
				'ADMIN_STRUCTURE_EXT_ICO' => $ext_info['icon'],
				'ADMIN_STRUCTURE_EXT_NAME' => $ext_info['name']
			));
			$t->parse('MAIN.ADMIN_STRUCTURE_EXT');
		}
	}
}
else
{
	$t->parse('MAIN.ADMIN_STRUCTURE_EMPTY');
}

$t->assign(array(
	'ADMIN_STRUCTURE_EXFLDS_URL' => cot_url('admin', 'm=extrafields')
));

