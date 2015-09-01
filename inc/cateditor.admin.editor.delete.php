<?php

/**
 * pagecattree Plugin for Cotonti CMF
 *
 * @version 2.0.0
 * @author esclkm, http://www.littledev.ru
 * @copyright (c) 2008-2011 esclkm, http://www.littledev.ru
 */
defined('COT_CODE') or die('Wrong URL.');

cot_check_xg();
/* @var $cot_structure structure */
/* @var $db CotDB */
/* @var $cache Cache */
/* @var $t Xtemplate */
$cat = $cot_structure->category($id);
$c = $cat['structure_code'];
if (cot_structure_delete($n, $cat['structure_code'], $is_module))
{
	/* === Hook === */
	foreach (cot_getextplugins('admin.structure.delete.done') as $pl)
	{
		include $pl;
	}
	/* ===== */
	cot_message('Deleted');
}

cot_redirect(cot_url('admin', 'm=other&p=cateditor&n='.$n, '', true));