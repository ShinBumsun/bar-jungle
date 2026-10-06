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
	'shot'      => 'SHOTS',
	'whisky'    => 'WHISKY SHOT',
);

/**
 * 탭 맨 위에 띄우는 한 줄 공지
 *
 * 분류 제목 뒤에 붙여 두면 묻혀서 안 보입니다. 탭을 열자마자 보이도록
 * 목록 위에 따로 한 줄을 둡니다. 비어 있는 탭은 아무것도 나오지 않습니다.
 */
$g5['jungle_tab_notice'] = array(
	'whisky' => array(
		'ko' => '하이볼로 변경 +2,000',
		'en' => 'Make it a highball +2,000',
		'ja' => 'ハイボールに変更 +2,000',
	),
);

/**
 * 메뉴판 소분류 제목의 영어·일본어
 *
 * 분류 42개 중 한국어가 섞인 것은 아래 다섯뿐이고, 나머지(VODKA, Red Wine …)는
 * 세 언어에서 그대로 둬도 읽힙니다. 그래서 항목처럼 DB 열을 늘리지 않고
 * 여기에 모아 둡니다. 한 분류가 여러 줄에 걸쳐 있어서, 열로 두면 같은 말을
 * 줄마다 다시 입력해야 합니다.
 *
 * 분류 제목을 새로 만들거나 글자를 고치면 여기 왼쪽 글자도 똑같이 맞춰 주세요.
 * 맞는 줄이 없으면 한국어가 그대로 나갑니다.
 */
$g5['jungle_cat_i18n'] = array(
	'SHOT COCKTAIL · 2샷 주문 시 할인' => array(
		'en' => 'SHOT COCKTAIL · Discount when you order 2',
		'ja' => 'SHOT COCKTAIL · 2ショット注文で割引',
	),
	'정글 추천 위스키 · Chapter 1 입문' => array(
		'en' => 'JUNGLE\'S WHISKY PICKS · Chapter 1 Beginner',
		'ja' => 'ジャングルおすすめウイスキー · Chapter 1 入門',
	),
	'정글 추천 위스키 · Chapter 2 오크향 가득한 버번' => array(
		'en' => 'JUNGLE\'S WHISKY PICKS · Chapter 2 Bourbon, rich with oak',
		'ja' => 'ジャングルおすすめウイスキー · Chapter 2 オークの香り豊かなバーボン',
	),
	'정글 추천 위스키 · Chapter 3 스모키한 피트' => array(
		'en' => 'JUNGLE\'S WHISKY PICKS · Chapter 3 Smoky peat',
		'ja' => 'ジャングルおすすめウイスキー · Chapter 3 スモーキーなピート',
	),
	'정글 추천 위스키 · Chapter 4 50도 이상 하이 프루프' => array(
		'en' => 'JUNGLE\'S WHISKY PICKS · Chapter 4 High proof, 50% ABV and up',
		'ja' => 'ジャングルおすすめウイスキー · Chapter 4 50度以上のハイプルーフ',
	),
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

		jungle_menu_fix_1006();
		jungle_menu_add_soup();

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
 * 시그니처 사진이 올라가는 곳
 * data 밑에 두면 그누보드가 쓰기 권한을 보장하고, 배포 때 덮어쓰이지도 않습니다.
 */
if (!function_exists('jungle_sig_dir')) {
	function jungle_sig_dir() { return G5_DATA_PATH.'/jungle_sig'; }
	function jungle_sig_url() { return G5_DATA_URL.'/jungle_sig'; }
}

/**
 * 처음 한 번, 미리 올려 둔 사진을 이름으로 짝지어 붙입니다.
 *
 * 사진은 FTP 로 먼저 올려 두고 이 표와 이어 주기만 하면 됩니다. 관리자가
 * 열 장을 손으로 다시 올리지 않아도 되도록 둔 장치입니다.
 * 왼쪽은 이름에서 띄어쓰기·쉼표를 뺀 것이고(메뉴에는 '시나, 브로' 처럼
 * 적혀 있습니다), 사진이 이미 붙어 있는 줄은 건드리지 않습니다.
 */
if (!function_exists('jungle_sig_seed_images')) {
	function jungle_sig_seed_images()
	{
		/* 한 번 붙이고 나면 다시 하지 않는다. 표시를 파일로 남기는 것은
		   페이지마다 DB 를 뒤지지 않기 위해서다. 파일 하나 보는 값이 가장 싸다. */
		$flag = jungle_sig_dir().'/.seeded';
		if (is_file($flag)) return;

		$seed = array(
			'하쿠나마타타'   => 'hakuna-matata.jpg',
			'럭키정글'       => 'lucky-jungle.jpg',
			'정글몬스터'     => 'jungle-monster.jpg',
			'그레이트그레이프' => 'great-grapes.jpg',
			'트레져'         => 'treasure.jpg',
			'정글쥬스'       => 'jungle-juice.jpg',
			'뱀부브리즈'     => 'bamboo-breeze.jpg',
			'크림달래'       => 'cream-dalae.jpg',
			'레인보우딜라이트' => 'rainbow-delight.jpg',
			'시나브로'       => 'cinna-bro.jpg',
		);

		$res = sql_query(" SELECT jm_id, jm_name_ko FROM ".G5_JUNGLE_SIG_TABLE."
		                    WHERE jm_image = '' ", false);
		if (!$res) return;

		while ($row = sql_fetch_array($res)) {
			$key = preg_replace('/[^0-9A-Za-z가-힣]/u', '', $row['jm_name_ko']);
			$file = '';
			foreach ($seed as $k => $v) {
				// '레인보우딜라이트' 와 '레인보우 딜라이트 샷 세트' 처럼
				// 뒤에 말이 더 붙은 이름도 같은 것으로 본다.
				if ($key === $k || strpos($key, $k) === 0) { $file = $v; break; }
			}
			if (!$file) continue;
			if (!is_file(jungle_sig_dir().'/'.$file)) continue;

			sql_query(" UPDATE ".G5_JUNGLE_SIG_TABLE."
			              SET jm_image = '".sql_escape_string($file)."'
			            WHERE jm_id = '".(int)$row['jm_id']."' ", false);
		}

		if (is_dir(jungle_sig_dir())) @file_put_contents($flag, date('Y-m-d H:i:s')."\n");
	}
}

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
			if (!$res || !sql_num_rows($res)) {
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
			}

			// 사진 열. 표가 이미 있던 설치에도 붙여야 하므로 따로 본다.
			// MySQL 은 ADD COLUMN 에 IF NOT EXISTS 가 없어 먼저 있는지 확인한다.
			$col = sql_query(" SHOW COLUMNS FROM ".G5_JUNGLE_SIG_TABLE." LIKE 'jm_image' ", false);
			if ($col && !sql_num_rows($col)) {
				sql_query(" ALTER TABLE ".G5_JUNGLE_SIG_TABLE."
				            ADD jm_image VARCHAR(255) NOT NULL DEFAULT '' ", false);
			}

			jungle_sig_seed_images();
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

		$sql = " SELECT * FROM ".G5_JUNGLE_SIG_TABLE.$cond."
		          ORDER BY jm_order ASC, jm_id ASC ";
		$res = sql_query($sql, false);

		/* 표가 아직 없거나, 있어도 사진 열이 안 붙어 있으면 한 번 손보고 다시 읽는다.
		   열이 붙은 뒤에는 첫 줄에 jm_image 가 보이므로 두 번 들어오지 않는다. */
		$need = !$res;
		if ($res) {
			$peek = sql_fetch_array($res);
			if ($peek !== null && !array_key_exists('jm_image', $peek)) $need = true;
			else sql_data_seek($res, 0);
		}
		if ($need && jungle_sig_setup()) {
			$res = sql_query($sql, false);
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

/**
 * 메뉴판 한 번짜리 손질 (2026-10-06)
 *
 * SHOT 탭 한 곳에 100 항목이 22 묶음으로 들어 있어 끝없이 길었습니다.
 * 위스키를 따로 떼어 SHOTS / WHISKY SHOT 두 탭으로 나눕니다.
 * 함께 '아그와 밤' 을 BOMB COCKTAIL 묶음으로 옮기고, Chapter 1 제목에
 * 붙어 있던 하이볼 안내는 탭 머리말로 올리므로 제목에서 뗍니다.
 *
 * 한 번 돌고 나면 표시 파일을 남겨 다시 돌지 않습니다. 되돌려야 하면
 * data/.jungle_shot_split 를 지우고 아래 WHISKY 목록을 비우면 됩니다.
 */
if (!function_exists('jungle_menu_fix_1006')) {
	function jungle_menu_fix_1006()
	{
		$flag = G5_DATA_PATH.'/.jungle_shot_split';
		if (is_file($flag)) return;

		// 위스키로 보낼 묶음. 이름을 그대로 적어 두어 무엇이 옮겨지는지 눈에 보이게 한다.
		$to_whisky = array(
			'정글 추천 위스키 · Chapter 1 입문 (하이볼 변경 +2,000)',
			'정글 추천 위스키 · Chapter 1 입문',
			'정글 추천 위스키 · Chapter 2 오크향 가득한 버번',
			'정글 추천 위스키 · Chapter 3 스모키한 피트',
			'정글 추천 위스키 · Chapter 4 50도 이상 하이 프루프',
			'WHISKY · Irish', 'WHISKY · Blended', 'WHISKY · Single Malt',
			'WHISKY · Korean', 'WHISKY · Indian', 'WHISKY · Taiwanese',
			'WHISKY · Japanese', 'WHISKY · Tennessee', 'WHISKY · Bourbon',
		);

		$moved = 0;
		foreach ($to_whisky as $cat) {
			$r = sql_query(" UPDATE ".G5_JUNGLE_MENU_TABLE."
			                    SET jm_tab = 'whisky'
			                  WHERE jm_tab = 'shot'
			                    AND jm_cat = '".sql_escape_string($cat)."' ", false);
			if ($r) $moved += get_sql_affected_rows();
		}

		// Chapter 1 제목에서 하이볼 안내를 뗀다. 탭 머리말로 올라갔다.
		sql_query(" UPDATE ".G5_JUNGLE_MENU_TABLE."
		               SET jm_cat = '정글 추천 위스키 · Chapter 1 입문'
		             WHERE jm_cat = '정글 추천 위스키 · Chapter 1 입문 (하이볼 변경 +2,000)' ", false);

		// 아그와 밤 → BOMB COCKTAIL
		sql_query(" UPDATE ".G5_JUNGLE_MENU_TABLE."
		               SET jm_cat = 'BOMB COCKTAIL', jm_order = 900
		             WHERE jm_tab = 'shot' AND jm_name_ko LIKE '아그와%' ", false);

		@file_put_contents($flag, date('Y-m-d H:i:s')." moved=".$moved."\n");
	}
}

/**
 * 메뉴판 한 번짜리 손질 그 두 번째 (2026-10-06)
 *
 * 스낵에 '양송이 컵 수프' 한 줄을 넣습니다. 수정사항 PPT 에 적힌 네 가지 중
 * 이것만 빠져 있었습니다.
 * 같은 이름이 이미 있으면 넣지 않으므로 여러 번 돌아도 늘어나지 않습니다.
 */
if (!function_exists('jungle_menu_add_soup')) {
	function jungle_menu_add_soup()
	{
		$flag = G5_DATA_PATH.'/.jungle_add_soup';
		if (is_file($flag)) return;

		$name = '양송이 컵 수프';
		$dup = sql_fetch(" SELECT COUNT(*) AS cnt FROM ".G5_JUNGLE_MENU_TABLE."
		                    WHERE jm_name_ko = '".sql_escape_string($name)."' ", false);
		if (!$dup) return;                       // 표를 못 읽었으면 표시도 남기지 않는다

		if ((int)$dup['cnt'] === 0) {
			// 목록 맨 뒤에 붙인다. 같은 5,000 원짜리 컵라면 옆자리가 된다.
			$mx = sql_fetch(" SELECT MAX(jm_order) AS mx FROM ".G5_JUNGLE_MENU_TABLE."
			                   WHERE jm_tab = 'beer' AND jm_cat = 'SNACKS' ", false);
			$ord = ($mx && $mx['mx'] !== null) ? (int)$mx['mx'] + 1 : 0;

			$f = array(
				'jm_tab'     => 'beer',
				'jm_cat'     => 'SNACKS',
				'jm_name_ko' => $name,
				'jm_name_en' => 'Mushroom cup cream soup',
				'jm_name_ja' => 'マッシュルームカップスープ',
				'jm_desc_ko' => '속풀이에 좋은 그릴드 양송이 컵 수프',
				'jm_desc_en' => 'A grilled mushroom cup soup — just the thing after a few drinks.',
				'jm_desc_ja' => 'お酒のあとにうれしい、グリルドマッシュルームのカップスープ。',
				'jm_price'   => '5,000',
			);
			$set = array();
			foreach ($f as $col => $val) $set[] = " $col = '".sql_escape_string($val)."' ";
			$set[] = " jm_order = '".$ord."' ";
			$set[] = " jm_alc = '0' ";
			$set[] = " jm_use = '1' ";
			sql_query(" INSERT INTO ".G5_JUNGLE_MENU_TABLE." SET ".implode(',', $set), false);
		}

		@file_put_contents($flag, date('Y-m-d H:i:s')."\n");
	}
}
