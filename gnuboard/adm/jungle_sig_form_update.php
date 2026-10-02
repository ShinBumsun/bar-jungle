<?php
$sub_menu = '950200';
require_once './_common.php';

check_demo();
auth_check_menu($auth, $sub_menu, 'w');
check_admin_token();

jungle_sig_setup();

$w     = isset($_POST['w']) ? $_POST['w'] : '';
$jm_id = isset($_POST['jm_id']) ? (int)$_POST['jm_id'] : 0;

$name_ko = isset($_POST['jm_name_ko']) ? trim($_POST['jm_name_ko']) : '';
if ($name_ko === '') alert('한글명을 입력해 주세요.');

// 메뉴판 표와 열 이름이 같으므로 jm_tab 은 늘 signature 로 박아 둔다.
$f = array(
	'jm_tab'     => 'signature',
	'jm_cat'     => '',
	'jm_name_ko' => $name_ko,
	'jm_name_en' => trim($_POST['jm_name_en']),
	'jm_name_ja' => trim($_POST['jm_name_ja']),
	'jm_desc_ko' => trim($_POST['jm_desc_ko']),
	'jm_desc_en' => trim($_POST['jm_desc_en']),
	'jm_desc_ja' => trim($_POST['jm_desc_ja']),
	'jm_price'   => trim($_POST['jm_price']),
	'jm_note'    => trim($_POST['jm_note']),
);

$set = array();
foreach ($f as $col => $val) $set[] = " $col = '".sql_escape_string($val)."' ";
$set[] = " jm_alc   = '".(int)$_POST['jm_alc']."' ";
$set[] = " jm_order = '".(int)$_POST['jm_order']."' ";
$set[] = " jm_use   = '".(isset($_POST['jm_use']) ? 1 : 0)."' ";
$set[] = " jm_card  = '".(isset($_POST['jm_card']) ? 1 : 0)."' ";

$icon  = isset($_POST['jm_card_icon']) ? $_POST['jm_card_icon'] : '';
$color = isset($_POST['jm_card_color']) ? $_POST['jm_card_color'] : '';
if (!isset($g5['jungle_card_icons'][$icon]))   $icon  = 'ck1';
if (!isset($g5['jungle_card_colors'][$color])) $color = 'c1';
$set[] = " jm_card_icon  = '".sql_escape_string($icon)."' ";
$set[] = " jm_card_color = '".sql_escape_string($color)."' ";

$sets = implode(',', $set);

if ($w === 'u') {
	sql_query(" UPDATE ".G5_JUNGLE_SIG_TABLE." SET $sets WHERE jm_id = '$jm_id' ");
} else {
	sql_query(" INSERT INTO ".G5_JUNGLE_SIG_TABLE." SET $sets ");
}

goto_url('./jungle_sig.php');
