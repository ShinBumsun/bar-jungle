<?php
$sub_menu = '950500';
require_once './_common.php';

check_demo();
auth_check_menu($auth, $sub_menu, 'w');
check_admin_token();

$chk    = isset($_POST['chk']) ? (array)$_POST['chk'] : array();
$ids    = isset($_POST['jp_id']) ? (array)$_POST['jp_id'] : array();
$orders = isset($_POST['jp_order']) ? (array)$_POST['jp_order'] : array();
$uses   = isset($_POST['jp_use']) ? (array)$_POST['jp_use'] : array();
$act    = isset($_POST['act_button']) ? $_POST['act_button'] : '';

if (!count($chk)) alert('처리할 팝업을 선택해 주세요.');

foreach ($chk as $k) {
	$k  = (int)$k;
	$id = isset($ids[$k]) ? (int)$ids[$k] : 0;
	if (!$id) continue;

	if ($act === '선택삭제') {
		$row = sql_fetch(" SELECT jp_image FROM ".G5_JUNGLE_POPUP_TABLE." WHERE jp_id = '$id' ", false);
		sql_query(" DELETE FROM ".G5_JUNGLE_POPUP_TABLE." WHERE jp_id = '$id' ");
		if ($row && trim($row['jp_image']) !== '') {
			$f = trim($row['jp_image']);
			$used = sql_fetch(" SELECT COUNT(*) AS cnt FROM ".G5_JUNGLE_POPUP_TABLE." WHERE jp_image = '".sql_escape_string($f)."' ", false);
			if (!$used || (int)$used['cnt'] === 0) @unlink(jungle_popup_dir().'/'.$f);
		}
	} else {
		$order = isset($orders[$k]) ? (int)$orders[$k] : 0;
		$use   = isset($uses[$k]) ? 1 : 0;
		sql_query(" UPDATE ".G5_JUNGLE_POPUP_TABLE." SET jp_order = '$order', jp_use = '$use' WHERE jp_id = '$id' ");
	}
}

goto_url('./jungle_popup.php');
