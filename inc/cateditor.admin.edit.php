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
function form_structure_editor($id)
{
	global $cot_structure,$cot_extrafields, $db_structure, $structure, $L, $R;
	$row = $cot_structure->category($id);
	if (empty($row))
	{
		return null;
	}

	$ii++;
	$structure_id = $row['structure_id'];
	$structure_code = $row['structure_code'];
	$n = $row['structure_area'];
	$dozvil = ($row['structure_count'] > 0) ? false : true;
	$is_module = cot_module_active($n);

	$t = new XTemplate(cot_tplfile('cateditor.admin.edit', 'plug'));
	
	$t->assign(array(
		'ADMIN_STRUCTURE_HEADER' => $row['structure_title'],
		'ADMIN_STRUCTURE_DEL_URL' => $dozvil ? cot_confirm_url(cot_url('admin', 'm=other&p=cateditor&n='.$n.'&a=delete&id='.$row['structure_id'].'&'.cot_xg()), 'admin') : '',
		'ADMIN_STRUCTURE_UPDATE_FORM_URL' => cot_url('admin', 'm=other&p=cateditor&n='.$n.'&id='.$structure_id.'&a=update'),
		'ADMIN_STRUCTURE_ID' => $row['structure_id'],
		'ADMIN_STRUCTURE_CODE' => cot_inputbox('text', 'rstructurecode', $structure_code, 'size="10" maxlength="255"'),
		'ADMIN_STRUCTURE_PATHFIELDIMG' => (mb_strpos($row['structure_path'], '.') == 0) ? $R['admin_icon_join1'] : $R['admin_icon_join2'],
		'ADMIN_STRUCTURE_PATH' => cot_inputbox('text', 'rstructurepath', $row['structure_path'], 'size="12" maxlength="255"'),
		'ADMIN_STRUCTURE_TPL' => cot_inputbox('text', 'rstructuretpl', $row['structure_tpl'], 'size="10" maxlength="255"'),
		'ADMIN_STRUCTURE_TITLE' => cot_inputbox('text', 'rstructuretitle', $row['structure_title'], 'size="32" maxlength="255"'),
		'ADMIN_STRUCTURE_DESC' => cot_inputbox('text', 'rstructuredesc', $row['structure_desc'], 'size="64" maxlength="255"'),
		'ADMIN_STRUCTURE_ICON' => cot_inputbox('text', 'rstructureicon', $row['structure_icon'], 'size="64" maxlength="128"'),
		'ADMIN_STRUCTURE_LOCKED' => cot_checkbox($row['structure_locked'], 'rstructurelocked'),
		'ADMIN_STRUCTURE_COUNT' => $row['structure_count'],
		'ADMIN_STRUCTURE_PARENT' => $cot_structure->select($cot_structure->get_parent($id), 'rstructureparent', true, 'disabled="disabled"' ),
		'ADMIN_STRUCTURE_JUMPTO_URL' => cot_url($n, 'c='.$structure_code),
		'ADMIN_STRUCTURE_RIGHTS_URL' => $is_module ? cot_url('admin', 'm=rightsbyitem&ic='.$n.'&io='.$structure_code) : '',
		'ADMIN_STRUCTURE_ODDEVEN' => cot_build_oddeven($ii)
	));

	foreach ($cot_extrafields[$db_structure] as $exfld)
	{
		$exfld_val = cot_build_extrafields('rstructure'.$exfld['field_name'], $exfld, $row['structure_'.$exfld['field_name']]);
		$exfld_title = isset($L['structure_'.$exfld['field_name'].'_title']) ? $L['structure_'.$exfld['field_name'].'_title'] : $exfld['field_description'];
		$t->assign(array(
			'ADMIN_STRUCTURE_'.strtoupper($exfld['field_name']) => $exfld_val,
			'ADMIN_STRUCTURE_'.strtoupper($exfld['field_name']).'_TITLE' => $exfld_title,
			'ADMIN_STRUCTURE_EXTRAFLD' => $exfld_val,
			'ADMIN_STRUCTURE_EXTRAFLD_TITLE' => $exfld_title
		));
		$t->parse('MAIN.EXTRAFLD');
	}


	require_once cot_incfile('configuration');
	$optionslist = cot_config_list($is_module ? 'module' : 'plug', $n, $structure_code);

	/* === Hook - Part1 : Set === */
	$extp = cot_getextplugins('admin.config.edit.loop');
	/* ===== */
	foreach ($optionslist as $row_c)
	{
		list($title, $hint) = cot_config_titles($row_c['config_name'], $row_c['config_text']);

		if ($row_c['config_type'] == COT_CONFIG_TYPE_SEPARATOR)
		{
			$t->assign('ADMIN_CONFIG_FIELDSET_TITLE', $title);
			$t->parse('MAIN.OPTIONS.CONFIG.ADMIN_CONFIG_ROW.ADMIN_CONFIG_FIELDSET_BEGIN');
		}
		else
		{
			$t->assign(array(
				'ADMIN_CONFIG_ROW_CONFIG' => cot_config_input($row_c['config_name'], $row_c['config_type'], $row_c['config_value'], $row_c['config_variants']),
				'ADMIN_CONFIG_ROW_CONFIG_TITLE' => $title,
				'ADMIN_CONFIG_ROW_CONFIG_MORE_URL' => cot_url('admin', 'm=structure&n='.$n.'&d='.$durl.'&id='.$structure_id.'&al='.$structure_code.'&a=reset&v='.$row_c['config_name'].'&'.cot_xg()),
				'ADMIN_CONFIG_ROW_CONFIG_MORE' => $hint
			));
			/* === Hook - Part2 : Include === */
			foreach ($extp as $pl)
			{
				include $pl;
			}
			/* ===== */
			$t->parse('MAIN.CONFIG.ADMIN_CONFIG_ROW.ADMIN_CONFIG_ROW_OPTION');
		}
		$t->parse('MAIN.CONFIG.ADMIN_CONFIG_ROW');
	}
	/* === Hook  === */
	foreach (cot_getextplugins('admin.config.edit.tags') as $pl)
	{
		include $pl;
	}
	/* ===== */
	$t->assign('CONFIG_HIDDEN', cot_inputbox('hidden', 'editconfig', $structure_code));
	$t->parse('MAIN.CONFIG');

	$t->parse('MAIN');
	return $t->text('MAIN');
}
