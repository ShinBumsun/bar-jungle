<?php
$sub_menu = '950100';
require_once './_common.php';

check_demo();
auth_check_menu($auth, $sub_menu, 'w');
check_admin_token();

$chk      = isset($_POST['chk']) ? (array)$_POST['chk'] : array();
$ids      = isset($_POST['jm_id']) ? (array)$_POST['jm_id'] : array();
$orders   = isset($_POST['jm_order']) ? (array)$_POST['jm_order'] : array();
$uses     = isset($_POST['jm_use']) ? (array)$_POST['jm_use'] : array();
$act      = isset($_POST['act_button']) ? $_POST['act_button'] : '';
$tab      = isset($_POST['tab']) ? preg_replace('/[^a-z]/', '', $_POST['tab']) : '';

if (!count($chk)) alert('처리할 항목을 선택해 주세요.');

foreach ($chk as $k) {
	$k  = (int)$k;
	$id = isset($ids[$k]) ? (int)$ids[$k] : 0;
	if (!$id) continue;

	if ($act === '선택삭제') {
		sql_query(" DELETE FROM ".G5_JUNGLE_MENU_TABLE." WHERE jm_id = '$id' ");
	} else {
		$order = isset($orders[$k]) ? (int)$orders[$k] : 0;
		$use   = isset($uses[$k]) ? 1 : 0;
		sql_query(" UPDATE ".G5_JUNGLE_MENU_TABLE." SET jm_order = '$order', jm_use = '$use' WHERE jm_id = '$id' ");
	}
}

goto_url('./jungle_menu.php?tab='.$tab);
