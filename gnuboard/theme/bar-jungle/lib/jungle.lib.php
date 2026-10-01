<?php
/**
 * BAR JUNGLE 테마 공용 함수
 */
if (!defined('_GNUBOARD_')) exit;

// 도수 표시 (0~5)
if (!function_exists('jungle_alc')) {
	function jungle_alc($n)
	{
		$n = (int)$n;
		if ($n <= 0) return '';
		$dots = '';
		for ($i = 0; $i < 5; $i++) {
			$dots .= '<b'.($i < $n ? '' : ' class="off"').'></b>';
		}
		return '<span class="mgli_alc" title="도수 '.$n.'/5"><span class="blind">도수 '.$n.'단계</span>'.$dots.'</span>';
	}
}

// 와인 지표 (sweetness / body / acidity)
if (!function_exists('jungle_meter')) {
	function jungle_meter($pair)
	{
		if (!is_array($pair) || count($pair) < 2) return '';
		list($label, $n) = $pair;
		$dots = '';
		for ($i = 0; $i < 5; $i++) {
			$dots .= '<b'.($i < (int)$n ? '' : ' class="off"').'></b>';
		}
		return '<span class="mgli_meter">'.htmlspecialchars($label).$dots.'</span>';
	}
}

// 메뉴 한 줄
if (!function_exists('jungle_menu_item')) {
	function jungle_menu_item($it)
	{
		$ko = isset($it['ko']) ? $it['ko'] : '';
		$en = isset($it['en']) ? $it['en'] : '';
		$name = $ko !== '' ? $ko : $en;

		$html  = '<li class="mgl_item">'."\n";
		$html .= "\t".'<div class="mgli_row">'."\n";
		$html .= "\t\t".'<strong class="mgli_name">'.$name;
		if ($ko !== '' && $en !== '') $html .= ' <span>'.$en.'</span>';
		if (!empty($it['vol']))       $html .= ' <span class="mgli_vol">'.$it['vol'].'</span>';
		$html .= '</strong>'."\n";
		$html .= "\t\t".'<i></i>'."\n";
		if (!empty($it['alc'])) $html .= "\t\t".jungle_alc($it['alc'])."\n";
		if (!empty($it['m1']))  $html .= "\t\t".jungle_meter($it['m1']).jungle_meter($it['m2'])."\n";
		$html .= "\t\t".'<em class="font">'.$it['price'].'</em>'."\n";
		if (!empty($it['note'])) $html .= "\t\t".'<span class="mgli_note">'.$it['note'].'</span>'."\n";
		$html .= "\t".'</div>'."\n";
		if (!empty($it['desc'])) $html .= "\t".'<p class="mgli_desc">'.$it['desc'].'</p>'."\n";
		$html .= '</li>'."\n";
		return $html;
	}
}
