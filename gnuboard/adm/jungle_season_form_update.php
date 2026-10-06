<?php
$sub_menu = '950300';
require_once './_common.php';

check_demo();
auth_check_menu($auth, $sub_menu, 'w');
check_admin_token();

jungle_season_setup();

$w     = isset($_POST['w']) ? $_POST['w'] : '';
$js_id = isset($_POST['js_id']) ? (int)$_POST['js_id'] : 0;

$old_image = '';
if ($w === 'u') {
	$prev = sql_fetch(" SELECT js_image FROM ".G5_JUNGLE_SEASON_TABLE." WHERE js_id = '$js_id' ", false);
	if ($prev && isset($prev['js_image'])) $old_image = trim($prev['js_image']);
}

$new = jungle_save_image('js_image', jungle_season_dir(), 'season', 8);
if ($w !== 'u' && $new === '') alert('올릴 그림을 골라 주세요.');

$image   = ($new !== '') ? $new : $old_image;
$discard = ($new !== '') ? $old_image : '';

$set = array();
$set[] = " js_image = '".sql_escape_string($image)."' ";
$set[] = " js_alt   = '".sql_escape_string(trim($_POST['js_alt']))."' ";
$set[] = " js_order = '".(int)$_POST['js_order']."' ";
$set[] = " js_use   = '".(isset($_POST['js_use']) ? 1 : 0)."' ";
$sets = implode(',', $set);

if ($w === 'u') {
	sql_query(" UPDATE ".G5_JUNGLE_SEASON_TABLE." SET $sets WHERE js_id = '$js_id' ");
} else {
	sql_query(" INSERT INTO ".G5_JUNGLE_SEASON_TABLE." SET $sets ");
}

/* 쓰지 않게 된 파일은 DB 가 바뀐 뒤에 지운다. 순서를 바꾸면 저장에 실패했을 때
   그림만 사라진다. 다른 줄이 같은 파일을 가리키면 남겨 둔다. */
if ($discard !== '' && $discard !== $image) {
	$used = sql_fetch(" SELECT COUNT(*) AS cnt FROM ".G5_JUNGLE_SEASON_TABLE."
	                    WHERE js_image = '".sql_escape_string($discard)."' ", false);
	if (!$used || (int)$used['cnt'] === 0) @unlink(jungle_season_dir().'/'.$discard);
}

goto_url('./jungle_season.php');
