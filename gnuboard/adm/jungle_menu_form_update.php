<?php
$sub_menu = '950100';
require_once './_common.php';

check_demo();
auth_check_menu($auth, $sub_menu, 'w');
check_admin_token();

$w     = isset($_POST['w']) ? $_POST['w'] : '';
$jm_id = isset($_POST['jm_id']) ? (int)$_POST['jm_id'] : 0;

$tab = isset($_POST['jm_tab']) ? preg_replace('/[^a-z]/', '', $_POST['jm_tab']) : '';
if (!isset($g5['jungle_tabs'][$tab])) alert('분류를 다시 선택해 주세요.');

$name_ko = trim($_POST['jm_name_ko']);
if ($name_ko === '') alert('한글명을 입력해 주세요.');

$f = array(
	'jm_tab'     => $tab,
	'jm_cat'     => trim($_POST['jm_cat']),
	'jm_name_ko' => $name_ko,
	'jm_name_en' => trim($_POST['jm_name_en']),
	'jm_name_ja' => trim($_POST['jm_name_ja']),
	'jm_desc_ko' => trim($_POST['jm_desc_ko']),
	'jm_desc_en' => trim($_POST['jm_desc_en']),
	'jm_desc_ja' => trim($_POST['jm_desc_ja']),
	'jm_price'   => trim($_POST['jm_price']),
	'jm_vol'     => trim($_POST['jm_vol']),
	'jm_meter'   => trim($_POST['jm_meter']),
	'jm_note'    => trim($_POST['jm_note']),
);

$set = array();
foreach ($f as $col => $val) $set[] = " $col = '".sql_escape_string($val)."' ";
$set[] = " jm_alc   = '".(int)$_POST['jm_alc']."' ";
$set[] = " jm_order = '".(int)$_POST['jm_order']."' ";
$set[] = " jm_use   = '".(isset($_POST['jm_use']) ? 1 : 0)."' ";
$sets = implode(',', $set);

if ($w === 'u') {
	sql_query(" UPDATE ".G5_JUNGLE_MENU_TABLE." SET $sets WHERE jm_id = '$jm_id' ");
} else {
	sql_query(" INSERT INTO ".G5_JUNGLE_MENU_TABLE." SET $sets ");
	$jm_id = sql_insert_id();
}

goto_url('./jungle_menu.php?tab='.$tab);
