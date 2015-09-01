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

function cat_reorder($array, $path = null)
{
	$return = array();
	$count = count($array);
	$lenght = mb_strlen($count); 
	//str_pad($max, $lenght, "0", STR_PAD_LEFT); 
	$i = 0;
	foreach ($array as $key => $val)
	{
		$i++;
		$pos = str_pad($i, $lenght, "0", STR_PAD_LEFT); 
		if(!empty($path))
		{
			$pos = $path . "." . $pos;
		}
		$return[$val['id']] = $pos;
		if(!empty($val['children']))
		{
			$rtemp = cat_reorder($val['children'], $pos);
			$return =  $return + $rtemp;
		}
	}
	return $return;
}
$data = cot_import('data', 'P', 'ARR');
$catpathes = cat_reorder($data);
$updated = 0;
foreach($catpathes as $id => $path)
{
	if($cot_structure->get_path($id) != $path)
	{
		$updated++;
		$db->update($db_structure, array("structure_path" => $path), "structure_id='".(int)$id."'");
	}
}
if($updated > 0)
{
	$status = array('status' => 'success', 'message' => $L['updated_order'] . ': ' . $updated);
}
else
{
	$status = array('status' => 'danger', 'message' => $L['updated_order_none']);
}
