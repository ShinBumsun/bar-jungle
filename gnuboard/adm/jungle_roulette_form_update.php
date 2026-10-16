<?php
$sub_menu = '950600';
require_once './_common.php';

check_demo();
auth_check_menu($auth, $sub_menu, 'w');
check_admin_token();
jungle_roulette_setup();

$w     = isset($_POST['w']) ? $_POST['w'] : '';
$jr_id = isset($_POST['jr_id']) ? (int)$_POST['jr_id'] : 0;

$name = trim($_POST['jr_name']);
if ($name === '') alert('상품명을 입력해 주세요.');

$rate = (int)$_POST['jr_rate'];
if ($rate < 0) alert('확률은 0 이상이어야 합니다.');

$old_image = '';
if ($w === 'u') {
	$prev = sql_fetch(" SELECT jr_image FROM ".G5_JUNGLE_ROULETTE_TABLE." WHERE jr_id = '$jr_id' ", false);
	if ($prev && isset($prev['jr_image'])) $old_image = trim($prev['jr_image']);
}

$new = jungle_save_image('jr_image', jungle_roulette_dir(), 'roul', 8);
$image   = ($new !== '') ? $new : $old_image;
$discard = ($new !== '') ? $old_image : '';

$set = array();
$set[] = " jr_name  = '".sql_escape_string($name)."' ";
$set[] = " jr_msg   = '".sql_escape_string(trim($_POST['jr_msg']))."' ";
$set[] = " jr_image = '".sql_escape_string($image)."' ";
$set[] = " jr_rate  = '".$rate."' ";
$set[] = " jr_order = '".(int)$_POST['jr_order']."' ";
$set[] = " jr_use   = '".(isset($_POST['jr_use']) ? 1 : 0)."' ";
$sets = implode(',', $set);

if ($w === 'u') {
	sql_query(" UPDATE ".G5_JUNGLE_ROULETTE_TABLE." SET $sets WHERE jr_id = '$jr_id' ");
} else {
	sql_query(" INSERT INTO ".G5_JUNGLE_ROULETTE_TABLE." SET $sets ");
}

/* 쓰지 않게 된 그림은 DB 가 바뀐 뒤에 지운다. 다른 칸이 같은 파일을 쓰면 남긴다. */
if ($discard !== '' && $discard !== $image) {
	$used = sql_fetch(" SELECT COUNT(*) AS cnt FROM ".G5_JUNGLE_ROULETTE_TABLE." WHERE jr_image = '".sql_escape_string($discard)."' ", false);
	if (!$used || (int)$used['cnt'] === 0) @unlink(jungle_roulette_dir().'/'.$discard);
}

goto_url('./jungle_roulette.php');
