<?php
$sub_menu = '950300';
require_once './_common.php';

check_demo();
auth_check_menu($auth, $sub_menu, 'w');
check_admin_token();

$chk    = isset($_POST['chk']) ? (array)$_POST['chk'] : array();
$ids    = isset($_POST['js_id']) ? (array)$_POST['js_id'] : array();
$orders = isset($_POST['js_order']) ? (array)$_POST['js_order'] : array();
$uses   = isset($_POST['js_use']) ? (array)$_POST['js_use'] : array();
$act    = isset($_POST['act_button']) ? $_POST['act_button'] : '';

if (!count($chk)) alert('처리할 그림을 선택해 주세요.');

foreach ($chk as $k) {
	$k  = (int)$k;
	$id = isset($ids[$k]) ? (int)$ids[$k] : 0;
	if (!$id) continue;

	if ($act === '선택삭제') {
		$row = sql_fetch(" SELECT js_image FROM ".G5_JUNGLE_SEASON_TABLE." WHERE js_id = '$id' ", false);
		sql_query(" DELETE FROM ".G5_JUNGLE_SEASON_TABLE." WHERE js_id = '$id' ");

		// 줄을 지운 뒤, 그 파일을 쓰는 줄이 더 없을 때만 파일도 지운다
		if ($row && trim($row['js_image']) !== '') {
			$f = trim($row['js_image']);
			$used = sql_fetch(" SELECT COUNT(*) AS cnt FROM ".G5_JUNGLE_SEASON_TABLE."
			                    WHERE js_image = '".sql_escape_string($f)."' ", false);
			if (!$used || (int)$used['cnt'] === 0) @unlink(jungle_season_dir().'/'.$f);
		}
	} else {
		$order = isset($orders[$k]) ? (int)$orders[$k] : 0;
		$use   = isset($uses[$k]) ? 1 : 0;
		sql_query(" UPDATE ".G5_JUNGLE_SEASON_TABLE." SET js_order = '$order', js_use = '$use' WHERE js_id = '$id' ");
	}
}

goto_url('./jungle_season.php');
