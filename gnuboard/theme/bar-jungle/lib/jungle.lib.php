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
// DB 행 하나를 받아 출력합니다. 언어별 이름/설명은 data 속성에 담아두고
// 화면에서 언어를 바꾸면 js/lib.js 가 꺼내 씁니다.
if (!function_exists('jungle_menu_item')) {
	function jungle_menu_item($it)
	{
		$esc = function ($v) { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); };

		$ko  = isset($it['jm_name_ko']) ? $it['jm_name_ko'] : '';
		$en  = isset($it['jm_name_en']) ? $it['jm_name_en'] : '';
		$ja  = isset($it['jm_name_ja']) ? $it['jm_name_ja'] : '';
		$vol = isset($it['jm_vol']) ? $it['jm_vol'] : '';
		$d_ko = isset($it['jm_desc_ko']) ? $it['jm_desc_ko'] : '';
		$d_en = isset($it['jm_desc_en']) ? $it['jm_desc_en'] : '';
		$d_ja = isset($it['jm_desc_ja']) ? $it['jm_desc_ja'] : '';

		$name = $ko !== '' ? $ko : $en;

		$attr = ' data-jm="'.(int)$it['jm_id'].'"';
		$attr .= ' data-nm-ko="'.$esc($name).'"';
		if ($ja !== '') $attr .= ' data-nm-ja="'.$esc($ja).'"';
		if ($en !== '') $attr .= ' data-nm-en="'.$esc($en).'"';
		if ($vol !== '') $attr .= ' data-nm-vol="'.$esc($vol).'"';
		if ($d_ko !== '') $attr .= ' data-ds-ko="'.$esc($d_ko).'"';
		if ($d_en !== '') $attr .= ' data-ds-en="'.$esc($d_en).'"';
		if ($d_ja !== '') $attr .= ' data-ds-ja="'.$esc($d_ja).'"';

		$html  = '<li class="mgl_item"'.$attr.'>'."\n";
		$html .= "\t".'<div class="mgli_row">'."\n";
		$html .= "\t\t".'<strong class="mgli_name">'.$esc($name);
		if ($ko !== '' && $en !== '') $html .= ' <span>'.$esc($en).'</span>';
		if ($vol !== '')             $html .= ' <span class="mgli_vol">'.$esc($vol).'</span>';
		$html .= '</strong>'."\n";
		$html .= "\t\t".'<i></i>'."\n";
		if (!empty($it['jm_alc'])) $html .= "\t\t".jungle_alc($it['jm_alc'])."\n";
		if (!empty($it['jm_meter'])) {
			$m = '';
			foreach (jungle_parse_meter($it['jm_meter']) as $pair) $m .= jungle_meter($pair);
			if ($m !== '') $html .= "\t\t".$m."\n";
		}
		$html .= "\t\t".'<em class="font">'.$esc($it['jm_price']).'</em>'."\n";
		if (!empty($it['jm_note'])) $html .= "\t\t".'<span class="mgli_note">'.$esc($it['jm_note']).'</span>'."\n";
		$html .= "\t".'</div>'."\n";

		// 세 언어 중 하나라도 설명이 있으면 자리를 만들어 둡니다.
		if ($d_ko !== '' || $d_en !== '' || $d_ja !== '') {
			$hidden = ($d_ko === '') ? ' hidden' : '';
			$html .= "\t".'<p class="mgli_desc"'.$hidden.'>'.$esc($d_ko).'</p>'."\n";
		}
		$html .= '</li>'."\n";
		return $html;
	}
}
