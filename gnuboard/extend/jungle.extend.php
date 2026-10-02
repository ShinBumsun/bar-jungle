<?php
/**
 * BAR JUNGLE 공용 정의
 * /extend 안의 파일은 그누보드가 모든 페이지에서 자동으로 읽습니다.
 */
if (!defined('_GNUBOARD_')) exit;

define('G5_JUNGLE_MENU_TABLE', G5_TABLE_PREFIX.'jungle_menu');
define('G5_JUNGLE_SIG_TABLE',  G5_TABLE_PREFIX.'jungle_signature');

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
		foreach (jungle_sig_rows() as $row) {
			if ($row['jm_card']) $out[] = $row;
		}
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

		// 시그니처는 전용 표에서 읽으므로 메뉴판 쪽에서는 뺀다.
		$sql = " SELECT * FROM ".G5_JUNGLE_MENU_TABLE."
		          WHERE jm_use = 1 AND jm_tab <> 'signature'
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

		// SIGNATURE 탭은 전용 표가 채웁니다. 관리하는 곳이 한 군데여야
		// 이름을 고칠 때 메뉴판과 카드가 따로 놀지 않습니다.
		if (isset($tree['signature'])) {
			foreach (jungle_sig_rows() as $row) {
				$cat = $row['jm_cat'];
				if (!isset($tree['signature']['groups'][$cat])) {
					$tree['signature']['groups'][$cat] = array('cat' => $cat, 'items' => array());
				}
				$tree['signature']['groups'][$cat]['items'][] = $row;
			}
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

/**
 * 시그니처 전용 표
 *
 * 시그니처는 메뉴판 항목에 체크를 켜는 방식이었는데, 전용 화면에서 따로
 * 관리하도록 표를 분리했습니다. 열 이름을 메뉴판과 똑같이 두는 것은 일부러
 * 그렇게 한 것입니다. 화면을 그리는 jungle_card_item() / jungle_menu_item()
 * 이 jm_* 키를 그대로 읽으므로, 이름을 맞춰 두면 그 코드를 건드릴 일이 없습니다.
 *
 * 표가 없으면 처음 읽을 때 만들고, 메뉴판에 있던 시그니처 항목을 옮겨 옵니다.
 * 관리자가 화면을 열기 전이라도 사이트가 비어 보이지 않게 하려는 것입니다.
 */
if (!function_exists('jungle_sig_setup')) {
	function jungle_sig_setup()
	{
		static $tried = false;
		if ($tried) return false;
		$tried = true;

		try {
			$res = sql_query(" SHOW TABLES LIKE '".G5_JUNGLE_SIG_TABLE."' ", false);
			if ($res && sql_num_rows($res)) return true;

			// 메뉴판 표와 같은 모양으로 만든다. 글자셋·열 구성이 저절로 맞는다.
			sql_query(" CREATE TABLE IF NOT EXISTS ".G5_JUNGLE_SIG_TABLE."
			            LIKE ".G5_JUNGLE_MENU_TABLE." ", false);

			// 비어 있을 때만 옮긴다. 두 번 눌러도 중복되지 않게.
			$cnt = sql_fetch(" SELECT COUNT(*) AS cnt FROM ".G5_JUNGLE_SIG_TABLE, false);
			if ($cnt && (int)$cnt['cnt'] === 0) {
				sql_query(" INSERT INTO ".G5_JUNGLE_SIG_TABLE."
				            SELECT * FROM ".G5_JUNGLE_MENU_TABLE."
				             WHERE jm_tab = 'signature' ", false);
			}
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
}

/**
 * 시그니처 항목을 순서대로 읽습니다.
 * $only_use 가 참이면 '화면에 보이기' 가 켜진 것만 돌려줍니다.
 */
if (!function_exists('jungle_sig_rows')) {
	function jungle_sig_rows($only_use = true)
	{
		// 한 페이지에서 메인 카드와 메뉴판 양쪽이 부르므로 한 번만 읽는다.
		static $cache = array();
		$ck = $only_use ? 'use' : 'all';
		if (isset($cache[$ck])) return $cache[$ck];

		$out  = array();
		$cond = $only_use ? " WHERE jm_use = 1 " : " ";

		$res = sql_query(" SELECT * FROM ".G5_JUNGLE_SIG_TABLE.$cond."
		                    ORDER BY jm_order ASC, jm_id ASC ", false);

		if (!$res) {
			// 아직 표가 없다면 만들어 보고 한 번 더 시도한다.
			if (jungle_sig_setup()) {
				$res = sql_query(" SELECT * FROM ".G5_JUNGLE_SIG_TABLE.$cond."
				                    ORDER BY jm_order ASC, jm_id ASC ", false);
			}
		}
		if (!$res) {
			// 그래도 안 되면 예전 자리에서 읽어 화면이 비지 않게 한다.
			$res = sql_query(" SELECT * FROM ".G5_JUNGLE_MENU_TABLE."
			                    WHERE jm_tab = 'signature' ".($only_use ? " AND jm_use = 1 " : "")."
			                    ORDER BY jm_order ASC, jm_id ASC ", false);
		}
		if (!$res) return $cache[$ck] = $out;

		while ($row = sql_fetch_array($res)) $out[] = $row;
		return $cache[$ck] = $out;
	}
}

/**
 * 관리자 첫 화면을 메뉴판 관리로
 *
 * /adm/ 의 기본 화면은 신규가입회원·최근게시물·포인트 내역인데 이 사이트에서는
 * 쓰지 않습니다. 들어오자마자 메뉴판 관리가 뜨도록 넘깁니다.
 *
 * 코어 파일(adm/index.php)은 건드리지 않습니다. adm/_common.php 끝에서 부르는
 * admin_common 훅을 씁니다. 이 훅은 admin.lib.php 의 로그인·권한 검사를 모두
 * 지난 뒤에 돌기 때문에, 로그인하지 않은 사람이 엉뚱한 곳으로 튕기지 않습니다.
 */
if (!function_exists('jungle_admin_home')) {
	function jungle_admin_home()
	{
		$self = isset($_SERVER['SCRIPT_FILENAME']) ? $_SERVER['SCRIPT_FILENAME'] : '';
		if (!$self) return;

		// 파일 경로로 견주어 본다. /adm/ 로 들어오든 /adm/index.php 로 들어오든 같다.
		$self = @realpath($self);
		$home = @realpath(G5_ADMIN_PATH.'/index.php');
		if (!$self || !$home || $self !== $home) return;

		goto_url(G5_ADMIN_URL.'/jungle_menu.php');
	}
}
add_event('admin_common', 'jungle_admin_home');
