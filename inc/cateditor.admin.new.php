<?php

/**
 * pagecattree Plugin for Cotonti CMF
 *
 * @version 2.0.0
 * @author esclkm, http://www.littledev.ru
 * @copyright (c) 2008-2011 esclkm, http://www.littledev.ru
 */
defined('COT_CODE') or die('Wrong URL.');

function form_structure_new($parentid = '')
{
	global $cot_structure,$cot_extrafields, $db_structure, $structure, $L, $R;
	
	$t = new XTemplate(cot_tplfile('cateditor.admin.new', 'plug'));
	$t->assign(array(
		'ADMIN_STRUCTURE_URL_FORM_ADD' => cot_url('admin', 'm=other&p=cateditor&n='.$n.'&a=add'),
		'ADMIN_STRUCTURE_CODE' => cot_inputbox('text', 'rstructurecode', null, 'size="16"'),
		'ADMIN_STRUCTURE_PARENT' => $cot_structure->select($parentid, 'rstructureparent'),
		'ADMIN_STRUCTURE_TITLE' => cot_inputbox('text', 'rstructuretitle', null, 'size="64" maxlength="100"'),
		'ADMIN_STRUCTURE_DESC' => cot_inputbox('text', 'rstructuredesc', null, 'size="64" maxlength="255"'),
		'ADMIN_STRUCTURE_ICON' => cot_inputbox('text', 'rstructureicon', null, 'size="64" maxlength="128"'),
		'ADMIN_STRUCTURE_LOCKED' => cot_checkbox(null, 'rstructurelocked'),
		'ADMIN_STRUCTURE_TPL' => cot_inputbox('text', 'rstructuretpl', null, 'size="10" maxlength="255"'),
	));

	// Extra fields
	foreach ($cot_extrafields[$db_structure] as $exfld)
	{
		$exfld_val = cot_build_extrafields('rstructure'.$exfld['field_name'], $exfld, null);
		$exfld_title = isset($L['structure_'.$exfld['field_name'].'_title']) ? $L['structure_'.$exfld['field_name'].'_title'] : $exfld['field_description'];
		$t->assign(array(
			'ADMIN_STRUCTURE_'.strtoupper($exfld['field_name']) => $exfld_val,
			'ADMIN_STRUCTURE_'.strtoupper($exfld['field_name']).'_TITLE' => $exfld_title,
			'ADMIN_STRUCTURE_EXTRAFLD' => $exfld_val,
			'ADMIN_STRUCTURE_EXTRAFLD_TITLE' => $exfld_title
		));
		$t->parse('MAIN.EXTRAFLD');
	}
	$t->parse('MAIN');

	return $t->text('MAIN');
}
