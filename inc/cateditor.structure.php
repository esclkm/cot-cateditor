<?php

/**
 * [BEGIN_COT_EXT]
 * Hooks=header.tags
 * [END_COT_EXT]
 */
/**
 * pagecattree Plugin for Cotonti CMF
 *
 * @version 2.0.0
 * @author esclkm, http://www.littledev.ru
 * @copyright (c) 2008-2011 esclkm, http://www.littledev.ru
 */
defined('COT_CODE') or die('Wrong URL.');

require_once cot_incfile('page', 'module');

class structure
{
	private $data = array();
	private $parent = array();
	private $childs_null = array();
	private $childs = array();
	private $nav = array();
	private $positions = array();
	private $area = 'page';
	
	public function __construct($area)
	{
		$this->area = $area;
		global $structure, $cfg, $db_structure, $db, $sys, $R;
		$sql = $db->query("SELECT * FROM $db_structure WHERE structure_area='".$db->prep($area)."' ORDER BY structure_path ASC, structure_code ASC");
		$totalitems = $db->query("SELECT COUNT(*) FROM $db_structure WHERE structure_area='".$db->prep($area)."'")->fetchColumn();
		foreach ($sql->fetchAll() as $row)
		{
			$this->data[$row['structure_id']] = $row;
			$this->nav[$row['structure_path']] = $row['structure_id'];
			$parent = $this->last_exist_parent($row['structure_path']);
			$this->parent[$row['structure_path']] = $parent;
			if($parent != null)
			{
				$this->childs[$parent][] = $row['structure_id'];
			}
			else
			{
				$this->childs_null[] = $row['structure_id'];
			}
			preg_match('/^((.+)\.)?(.+)$/i', $row['structure_path'], $mt);
			$mt[3];
			$this->positions[$row['structure_id']] = $mt[3];
			
		}
	//	cot_print($this->positions);
	}

	private function last_exist_parent($path)
	{
		preg_match('/^(.+)\.(.+)$/i', $path, $mt_curr);
		if(empty($mt_curr[1]))
		{
			return null;
		}
		elseif(isset($this->nav[$mt_curr[1]]))
		{
			return $this->nav[$mt_curr[1]];
		}
		return $this->last_exist_parent($mt_curr[1]);
	}
	public function get_parent($category)
	{
		$path = $this->data[$category]['structure_path'];
		return $this->parent[$path];
	}
	public function get_path($category)
	{
		return $this->data[$category]['structure_path'];
	}	
	public function nextposition($parent = null)
	{
		$positions = array();
		$array = array();
		$array = (empty($parent)) ? $this->childs_null : $this->childs[$parent];
		if(empty($array))
		{
			return "001";
		}
		foreach($array as $id)
		{	
			$positions[] = $this->positions[$id];
		}	
		$max = max($positions);
		$max++;
		$lenght = mb_strlen($max); 
		return str_pad($max, $lenght, "0", STR_PAD_LEFT); 
	}
	public function nextpath($parent = null)
	{
		$position = $this->nextposition($parent);
		if(empty($parent))
		{
			return $position;
		}
		return $this->data[$parent]['structure_path'].'.'.$position;
	}
	
	public function build_tree($parent = null, $depth = 0, $tpl = 'cateditor.tree' , $selectedid = null)
	{
		
		$array = array();
		$array = (empty($parent)) ? $this->childs_null : $this->childs[$parent];
		
		$is_module =cot_module_active($this->area);
		if(!empty($parent))
		{
	//		cot_print($parent, );
		}
		if(empty($array))
		{
			return false;
		}
		else
		{
			$t = new XTemplate(cot_tplfile($tpl, 'plug'));
			foreach($array as $id)
			{
				$row = $this->data[$id];
				$t->assign(array(
					'ADMIN_STRUCTURE_EDIT_URL' => cot_url('admin', 'm=other&p=cateditor&n='.$this->area.'&id='.$row['structure_id']),
					'ADMIN_STRUCTURE_AJAX_EDIT_URL' => cot_url('index', 'r=cateditor&n='.$this->area.'&id='.$row['structure_id']),
					'ADMIN_STRUCTURE_RIGHTS_URL' => $is_module ? cot_url('admin', 'm=rightsbyitem&ic='.$this->area.'&io='.$row['structure_code']) : '',
					'ADMIN_STRUCTURE_OPEN_URL' => cot_url($n, 'c='.$row['structure_code']),
					'ADMIN_STRUCTURE_ID' => $row['structure_id'],
					'ADMIN_STRUCTURE_CODE' => $row['structure_code'],
					'ADMIN_STRUCTURE_TITLE' => $row['structure_title'],
					'ADMIN_STRUCTURE_DESC' => $row['structure_desc'],
					'ADMIN_STRUCTURE_SELECTED' => $row['structure_id'] == $selectedid ? 1 : 0,
					'ADMIN_STRUCTURE_ICON' => $row['structure_icon'],
					'ADMIN_STRUCTURE_CHILDREN' => $this->build_tree($row['structure_id'], $depth+1, $tpl),
					'ADMIN_STRUCTURE_COUNT' => $row['structure_count'],
					'ADMIN_STRUCTURE_DEPTH' => $depth,
				));
				$t->parse("MAIN.CATS.ROW");
			}
			$t->parse("MAIN.CATS");
			if(empty($parent))
			{
				$t->parse("MAIN");
				return $t->text("MAIN");
			}
			return $t->text("MAIN.CATS");
		}
			
	}
	public function select($chosen, $name, $add_empty=true, $attrs = '')
	{
		require_once cot_incfile('forms');
		$values = array();
		foreach ($this->data as $id => $row)
		{
			$values[$id] = $this->depthpreffix($row['structure_path']).$row['structure_title'];
		}
		return cot_selectbox($chosen, $name, array_keys($values), array_values($values), $add_empty, $attrs);
	}
	private function depthpreffix($data)
	{
		$count = mb_substr_count($data, '.');
		$substr = '';
		for($i = 0; $i < $count-1; $i++)
		{
			//$substr .=  "— ├";
			$substr .=  " │";
		}
		if($count > 0)
		{
			$substr .=" │-- ";
		}
		return $substr;
		
	}
	
	function autoalias($title, $id = 0)
	{
		global $cfg, $cot_translit, $cot_translit_custom;

		if(file_exists(cot_langfile('translit', 'core')))
		{
			include cot_langfile('translit', 'core');
			if (is_array($cot_translit_custom))
			{
				$title = strtr($title, $cot_translit_custom);
			}
			elseif (is_array($cot_translit))
			{
				$title = strtr($title, $cot_translit);
			}
		}
		$title = preg_replace('#[^\p{L}0-9\-_ ]#u', '', $title);
		$title = str_replace(' ', '-', $title);
		$title = mb_strtolower($title);

		$duplicate = false;
		foreach($this->data as $d_id => $d_cat)
		{
			if($id != $d_id && $title == $d_cat['structure_code'])
			{
				$duplicate = true;
			}
		}
		if ($duplicate)
		{
			if (!empty($id))
			{
					$title .= '-' . $id;
			}
			else
			{
				$title .= '-' . rand(2, 99);
			}
		}

		return $title;
	}

	public function category($id)
	{
		if(!empty($this->data[$id]))
		{
			return $this->data[$id];
		}
		return false;
	}
	/*
	public function categoryid($id)
	{
		foreach ($this->data as $id => $row)
		{
					if(!empty($this->data[$id]))
		{
			return $this->data[$id];
		}
			$values[$id] = $this->depthpreffix($row['structure_path']).$row['structure_title'];
		}
		if(!empty($this->data[$id]))
		{
			return $this->data[$id];
		}
		return false;
	}	*/
}
