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

	
$rstructure['structure_code'] = preg_replace('#[^\w\p{L}\-]#u', '', cot_import('rstructurecode', 'P', 'TXT'));
$rstructure['structure_title'] = cot_import('rstructuretitle', 'P', 'TXT');		
$rstructure['structure_path'] = cot_import('rstructurepath', 'P', 'TXT');
$parent = cot_import('rstructureparent', 'P', 'TXT');

$rstructure['structure_desc'] = cot_import('rstructuredesc', 'P', 'TXT');
$rstructure['structure_icon'] = cot_import('rstructureicon', 'P', 'TXT');
$rstructure['structure_locked'] = (cot_import('rstructurelocked', 'P', 'BOL')) ? 1 : 0;
$rstructure['structure_area'] = $n;
$rstructure['structure_tpl'] = cot_import('rstructuretpl', 'P', 'TXT');

foreach ($cot_extrafields[$db_structure] as $exfld)
{
	$rstructure['structure_'.$exfld['field_name']] = cot_import_extrafields('rstructure'.$exfld['field_name'], $exfld);
}

($rstructure['structure_code'] != 'all') || cot_error('adm_structure_code_reserved', 'rstructurecode');
$rstructure['structure_title'] || cot_error('adm_structure_title_required', 'rstructuretitle');

/* === Hook === */
foreach (cot_getextplugins('admin.structure.add.first') as $pl)
{
	include $pl;
}
/* ===== */

if (!cot_error_found())
{

	if(empty($rstructure['structure_code']))
	{
		$rstructure['structure_code'] = $cot_structure->autoalias($rstructure['structure_title']);
	}
	if(empty($rstructure['structure_path']))
	{
		$rstructure['structure_path'] = $cot_structure->nextpath($parent);
	}

	$res = cot_structure_add($n, $rstructure, $is_module);
	if ($res === true)
	{
		cot_extrafield_movefiles();
		/* === Hook === */
		foreach (cot_getextplugins('admin.structure.add.done') as $pl)
		{
			include $pl;
		}
		$id = $db->query("SELECT structure_id FROM $db_structure WHERE structure_area=? AND structure_code=?", array($n, $rstructure['structure_code']))->fetchColumn();
		cot_message('Added');
	}
	elseif (is_array($res))
	{
		cot_error($res[0], $res[1]);
	}
	else
	{
		cot_error('Error');
	}
}		

cot_redirect(cot_url('admin', 'm=other&p=cateditor&n='.$n.'&id='.$id, '', true));