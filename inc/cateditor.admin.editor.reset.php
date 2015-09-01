<?php

/**
 * pagecattree Plugin for Cotonti CMF
 *
 * @version 2.0.0
 * @author esclkm, http://www.littledev.ru
 * @copyright (c) 2008-2011 esclkm, http://www.littledev.ru
 */
defined('COT_CODE') or die('Wrong URL.');

cot_config_reset($n, $v, $is_module ? 'module' : 'plug', $structure_code);
cot_redirect(cot_url('admin', 'm=other&p=cateditor&n='.$n, '', true));