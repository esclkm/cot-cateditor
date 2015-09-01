<?php

/**
 * pagecattree Plugin for Cotonti CMF
 *
 * @version 2.0.0
 * @author esclkm, http://www.littledev.ru
 * @copyright (c) 2008-2011 esclkm, http://www.littledev.ru
 */
defined('COT_CODE') or die('Wrong URL.');

/* @var $cot_structure structure */
/* @var $db CotDB */
/* @var $cache Cache */
/* @var $t Xtemplate */

// Edit structure for a module


$editconfig = cot_import('editconfig', 'P', 'TXT');
if (!empty($editconfig))
{
	$optionslist = cot_config_list($is_module ? 'module' : 'plug', $n, $editconfig);
	foreach ($optionslist as $key => $val)
	{
		$data = cot_import($key, 'P', sizeof($cot_import_filters[$key]) ? $key : 'NOC');
		if ($optionslist[$key]['config_value'] != $data)
		{
			if (is_null($optionslist[$key]['config_subdefault']))
			{
				$optionslist[$key]['config_value'] = $data;
				$optionslist[$key]['config_subcat'] = $editconfig;
				$db->insert($db_config, $optionslist[$key]);
			}
			else
			{
				$db->update($db_config, array('config_value' => $data), "config_name = ? AND config_owner = ?
					AND config_cat = ?  AND config_subcat = ?)", array($key, $o, $p, $editconfig));
			}
		}
	}
}



$oldrow = $db->query("SELECT * FROM $db_structure WHERE structure_id=".(int)$id)->fetch();
$rstructure['structure_code'] = preg_replace('#[^\w\p{L}\-]#u', '', cot_import('rstructurecode', 'P', 'TXT'));
//	$rstructure['structure_path'] = cot_import('rstructurepath', 'P', 'TXT');
$rstructure['structure_title'] = cot_import('rstructuretitle', 'P', 'TXT');
$rstructure['structure_desc'] = cot_import('rstructuredesc', 'P', 'TXT');
$rstructure['structure_icon'] = cot_import('rstructureicon', 'P', 'TXT');
$rstructure['structure_tpl'] = cot_import('rstructuretpl', 'P', 'TXT');

$rstructure['structure_locked'] = (cot_import('rstructurelocked', 'P', 'BOL')) ? 1 : 0;

foreach ($cot_extrafields[$db_structure] as $exfld)
{
	$rstructure['structure_'.$exfld['field_name']] = cot_import_extrafields('rstructure'.$exfld['field_name'], $exfld, 'P', $oldrow['structure_'.$exfld['field_name']]);
}

($rstructure['structure_code'] != 'all') || cot_error('adm_structure_code_reserved', 'rstructurecode');
$rstructure['structure_title'] || cot_error('adm_structure_title_required', 'rstructuretitle');

if (!cot_error_found())
{
	if (empty($rstructure['structure_code']))
	{
		$rstructure['structure_code'] = $cot_structure->autoalias($rstructure['structure_title']);
	}

	$res = cot_structure_update($n, $id, $oldrow, $rstructure, $is_module);
	if (is_array($res))
	{
		cot_error($res[0], $res[1]);
	}
}

cot_extrafield_movefiles();
cot_auth_clear('all');

if ($cache)
{
	$cache->clear();
}

if (!cot_error_found())
{
	cot_message('Updated');
}
else
{
	cot_error('adm_structure_somenotupdated');
}

cot_redirect(cot_url('admin', 'm=other&p=cateditor&n='.$n.'&id='.$id, '', true));
