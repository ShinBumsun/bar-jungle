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

// 시그니처 카드 한 장
if (!function_exists('jungle_card_item')) {
	function jungle_card_item($c, $i)
	{
		$esc = function ($v) { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); };

		$ko = $c['jm_name_ko']; $en = $c['jm_name_en']; $ja = $c['jm_name_ja'];
		$d_ko = $c['jm_desc_ko']; $d_en = $c['jm_desc_en']; $d_ja = $c['jm_desc_ja'];
		$icon  = $c['jm_card_icon'] ? $c['jm_card_icon'] : 'ck1';
		$color = $c['jm_card_color'] ? $c['jm_card_color'] : 'c1';
		$delay = array('', ' f_delay03', ' f_delay06', ' f_delay09', ' f_delay12');
		$dly = $delay[min($i, 4)];

		$attr = ' data-jm="'.(int)$c['jm_id'].'" data-card="1"';
		$attr .= ' data-nm-ko="'.$esc($ko).'"';
		if ($ja !== '')   $attr .= ' data-nm-ja="'.$esc($ja).'"';
		if ($en !== '')   $attr .= ' data-nm-en="'.$esc($en).'"';
		if ($d_ko !== '') $attr .= ' data-ds-ko="'.$esc($d_ko).'"';
		if ($d_en !== '') $attr .= ' data-ds-en="'.$esc($d_en).'"';
		if ($d_ja !== '') $attr .= ' data-ds-ja="'.$esc($d_ja).'"';

		$h  = '<li class="sl_item '.$esc($color).' fade f_up'.$dly.'"'.$attr.'>'."\n";
		$h .= "\t".'<div class="sli_pic">'."\n";
		$h .= "\t\t".'<svg viewBox="0 0 160 200" aria-hidden="true"><use href="#'.$esc($icon).'"></use></svg>'."\n";
		$h .= "\t".'</div>'."\n";
		$h .= "\t".'<div class="sli_txt">'."\n";
		$h .= "\t\t".'<em class="font">'.sprintf('%02d', $i + 1).'</em>'."\n";
		$h .= "\t\t".'<strong class="sli_name">'.$esc($en !== '' ? $en : $ko);
		if ($en !== '' && $ko !== '') $h .= ' <span>'.$esc($ko).'</span>';
		$h .= '</strong>'."\n";
		$h .= "\t\t".'<p class="sli_meta">'.jungle_alc($c['jm_alc']).'<b class="font">'.$esc($c['jm_price']).'</b></p>'."\n";
		if ($d_ko !== '' || $d_en !== '' || $d_ja !== '') {
			$hidden = ($d_ko === '') ? ' hidden' : '';
			$h .= "\t\t".'<p class="sli_note"'.$hidden.'>'.$esc($d_ko).'</p>'."\n";
		}
		$h .= "\t".'</div>'."\n";
		$h .= '</li>'."\n";
		return $h;
	}
}
