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
$res = false;
$area_sync = 'cot_'.$n.'_sync';
if (function_exists($area_sync))
{
	$res = true;
	$sql = $db->query("SELECT structure_code FROM $db_structure WHERE structure_area='".$db->prep($n)."'");
	foreach ($sql->fetchAll() as $row)
	{
		$cat = $row['structure_code'];
		$items = $area_sync($cat);
		$db->update($db_structure, array("structure_count" => (int)$items), "structure_code='".$db->prep($cat)."' AND structure_area='".$db->prep($n)."'");
	}
	$sql->closeCursor();
}

/* === Hook === */
foreach (cot_getextplugins('admin.structure.resync.done') as $pl)
{
	include $pl;
}
/* ===== */

$res ? cot_message('Resynced') : cot_message("Error: function $area_sync doesn't exist."); // TODO i18n
($cache && $cfg['cache_'.$n]) && $cache->page->clear($n);
cot_redirect(cot_url('admin', 'm=other&p=cateditor&n='.$n, '', true));