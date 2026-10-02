<?php
/**
 * BAR JUNGLE 공용 정의
 * /extend 안의 파일은 그누보드가 모든 페이지에서 자동으로 읽습니다.
 */
if (!defined('_GNUBOARD_')) exit;

define('G5_JUNGLE_MENU_TABLE', G5_TABLE_PREFIX.'jungle_menu');

// 메뉴판 탭. key 는 화면 id, label 은 버튼에 찍히는 글자입니다.
// 적어 둔 순서가 곧 화면의 탭 순서입니다.
$g5['jungle_tabs'] = array(
	'signature' => 'SIGNATURE',
	'bottle'    => 'BOTTLE',
	'wine'      => 'WINE',
	'highball'  => 'HIGHBALL',
	'gin'       => 'GIN &amp; TONIC',
	'tropical'  => 'TROPICAL',
	'classic'   => 'CLASSIC',
	'milkshot'  => 'MILKY',
	'nonalc'    => 'NON-ALCOHOL',
	'beer'      => 'BEER &amp; SNACK',
	'shot'      => 'SHOT',
);

// 시그니처 카드에 쓸 잔 그림과 배경색 (관리자 선택지)
$g5['jungle_card_icons'] = array(
	'ck1' => '마티니 잔',
	'ck2' => '온더락 잔',
	'ck3' => '크림/티키 잔',
	'ck4' => '하이볼 잔',
	'ck5' => '샷 잔',
	'ck6' => '쿠페 잔',
);
$g5['jungle_card_colors'] = array(
	'c1' => '초록',
	'c2' => '진초록',
	'c3' => '주황',
	'c4' => '베리',
	'c5' => '청록',
	'c6' => '머스타드',
);

/**
 * 시그니처 섹션에 띄울 카드 목록.
 * 메뉴판과 같은 표를 쓰므로 가격·도수·3개 국어가 자동으로 따라옵니다.
 */
if (!function_exists('jungle_signature_cards')) {
	function jungle_signature_cards()
	{
		$out = array();
		$res = sql_query(" SELECT * FROM ".G5_JUNGLE_MENU_TABLE."
		                    WHERE jm_card = 1 AND jm_use = 1
		                    ORDER BY jm_order ASC, jm_id ASC ", false);
		if (!$res) return $out;
		while ($row = sql_fetch_array($res)) $out[] = $row;
		return $out;
	}
}

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

/**
 * 관리자 좌측 메뉴 정리
 *
 * 설치된 그누보드에는 쇼핑몰·SMS·게시판처럼 이 사이트가 쓰지 않는 메뉴가
 * 함께 들어 있습니다. 실제로 쓰는 것만 남깁니다.
 *
 * 코어 파일은 건드리지 않습니다. 그누보드가 adm/admin.menu*.php 를 모두
 * 읽어들인 뒤 호출하는 admin_amenu 훅에서 거릅니다. 거르는 대상은 메뉴 목록
 * ($amenu) 뿐이고 메뉴 정의($menu)는 그대로 둡니다. 관리권한설정 화면이
 * 그 정의를 읽어 쓰기 때문에 같이 지우면 권한 지정이 비어 버립니다.
 *
 * 다시 보이게 하려면 아래 배열에 번호를 넣으세요.
 *   '100' 환경설정   '200' 회원관리   '300' 게시판관리
 *   '400' 쇼핑몰관리 '500' 쇼핑몰현황/기타   '900' SMS 관리
 *   '950' 정글 사이트
 */
$g5['jungle_admin_menu'] = array('950');

if (!function_exists('jungle_admin_amenu')) {
	function jungle_admin_amenu($amenu)
	{
		global $g5;

		if (!is_array($amenu) || !$amenu) return $amenu;

		$keep = isset($g5['jungle_admin_menu']) ? (array)$g5['jungle_admin_menu'] : array();
		if (!$keep) return $amenu;

		$kept = array();
		foreach ($amenu as $no => $file) {
			if (in_array((string)$no, $keep, true)) $kept[$no] = $file;
		}

		/* 하나도 안 남으면 거르는 쪽이 잘못된 것이다.
		   관리자가 아무 데도 못 가는 상태가 되지 않도록 원래 목록을 돌려준다. */
		return $kept ? $kept : $amenu;
	}
}
add_replace('admin_amenu', 'jungle_admin_amenu');
