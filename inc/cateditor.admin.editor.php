<?php

/**
 * pagecattree Plugin for Cotonti CMF
 *
 * @version 2.0.0
 * @author esclkm, http://www.littledev.ru
 * @copyright (c) 2008-2011 esclkm, http://www.littledev.ru
 */
defined('COT_CODE') or die('Wrong URL.');

$tree  = $cot_structure->build_tree();
// max
//str_pad
if($id > 0)
{
	require_once cot_incfile('cateditor', 'plug', 'admin.edit');
	$editor = form_structure_editor($id);
}
else
{
	$parentid = cot_import('parentid', 'G', 'INT');
	require_once cot_incfile('cateditor', 'plug', 'admin.new');
	$editor = form_structure_new($parentid);
}
$t->assign(array(
	'NEWCATEGORY_URL' => cot_url('admin', 'm=other&p=cateditor&n='.$n.'&parentid='.$id),
	'RESYNC_URL' => cot_url('admin', 'm=other&p=cateditor&n='.$n.'&a=resyncall&'.cot_xg()),
	'TREE' => $tree,
	'EDITOR' => $editor
));
