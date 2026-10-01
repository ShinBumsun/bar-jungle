<?php
/**
 * BAR JUNGLE 공용 정의
 * /extend 안의 파일은 그누보드가 모든 페이지에서 자동으로 읽습니다.
 */
if (!defined('_GNUBOARD_')) exit;

define('G5_JUNGLE_MENU_TABLE', G5_TABLE_PREFIX.'jungle_menu');

// 메뉴판 탭. key 는 화면 id, label 은 버튼에 찍히는 글자입니다.
$g5['jungle_tabs'] = array(
	'signature' => 'SIGNATURE',
	'highball'  => 'HIGHBALL',
	'gin'       => 'GIN &amp; TONIC',
	'tropical'  => 'TROPICAL',
	'classic'   => 'CLASSIC',
	'milkshot'  => 'MILK &amp; SHOT',
	'nonalc'    => 'NON-ALCOHOL',
	'beer'      => 'BEER &amp; SNACK',
	'bottle'    => 'BOTTLE',
	'wine'      => 'WINE',
);

/**
 * 메뉴판 전체를 탭 → 소분류 → 항목 순으로 묶어 돌려줍니다.
 * 노출(jm_use=1) 항목만 가져옵니다.
 */
if (!function_exists('jungle_menu_tree')) {
	function jungle_menu_tree()
	{
		global $g5;

		$tabs = $g5['jungle_tabs'];
		$tree = array();
		foreach ($tabs as $key => $label) {
			$tree[$key] = array('key' => $key, 'label' => $label, 'groups' => array());
		}

		$sql = " SELECT * FROM ".G5_JUNGLE_MENU_TABLE."
		          WHERE jm_use = 1
		          ORDER BY jm_order ASC, jm_id ASC ";
		$res = sql_query($sql, false);
		if (!$res) return array();

		while ($row = sql_fetch_array($res)) {
			$tab = $row['jm_tab'];
			if (!isset($tree[$tab])) continue;
			$cat = $row['jm_cat'];
			if (!isset($tree[$tab]['groups'][$cat])) {
				$tree[$tab]['groups'][$cat] = array('cat' => $cat, 'items' => array());
			}
			$tree[$tab]['groups'][$cat]['items'][] = $row;
		}

		// 항목이 하나도 없는 탭은 버립니다.
		foreach ($tree as $k => $t) {
			if (!count($t['groups'])) unset($tree[$k]);
			else $tree[$k]['groups'] = array_values($t['groups']);
		}
		return array_values($tree);
	}
}

/**
 * 와인 지표 문자열(sweetness:1|body:3)을 배열로 바꿉니다.
 */
if (!function_exists('jungle_parse_meter')) {
	function jungle_parse_meter($str)
	{
		$out = array();
		if (!trim($str)) return $out;
		foreach (explode('|', $str) as $part) {
			$kv = explode(':', $part);
			if (count($kv) < 2) continue;
			$out[] = array(trim($kv[0]), (int)trim($kv[1]));
		}
		return $out;
	}
}
