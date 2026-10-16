<?php
$sub_menu = '950400';
require_once './_common.php';

check_demo();
auth_check_menu($auth, $sub_menu, 'w');
check_admin_token();
jungle_goods_setup();

$w     = isset($_POST['w']) ? $_POST['w'] : '';
$jg_id = isset($_POST['jg_id']) ? (int)$_POST['jg_id'] : 0;

$name = trim($_POST['jg_name_ko']);
if ($name === '') alert('이름을 입력해 주세요.');

$old_image = '';
if ($w === 'u') {
	$prev = sql_fetch(" SELECT jg_image FROM ".G5_JUNGLE_GOODS_TABLE." WHERE jg_id = '$jg_id' ", false);
	if ($prev && isset($prev['jg_image'])) $old_image = trim($prev['jg_image']);
}

$new = jungle_save_image('jg_image', jungle_goods_dir(), 'goods', 8);
if ($w !== 'u' && $new === '') alert('사진을 골라 주세요.');

$image   = ($new !== '') ? $new : $old_image;
$discard = ($new !== '') ? $old_image : '';

$badge = isset($_POST['jg_badge']) ? $_POST['jg_badge'] : '';
if (!isset($g5['jungle_goods_badge'][$badge])) $badge = '';

$f = array(
	'jg_image'     => $image,
	'jg_name_ko'   => $name,
	'jg_name_en'   => trim($_POST['jg_name_en']),
	'jg_name_ja'   => trim($_POST['jg_name_ja']),
	'jg_desc_ko'   => trim($_POST['jg_desc_ko']),
	'jg_desc_en'   => trim($_POST['jg_desc_en']),
	'jg_desc_ja'   => trim($_POST['jg_desc_ja']),
	'jg_price'     => trim($_POST['jg_price']),
	'jg_price_was' => trim($_POST['jg_price_was']),
	'jg_note'      => trim($_POST['jg_note']),
	'jg_note_en'   => trim($_POST['jg_note_en']),
	'jg_note_ja'   => trim($_POST['jg_note_ja']),
	'jg_badge'     => $badge,
);
$set = array();
foreach ($f as $col => $val) $set[] = " $col = '".sql_escape_string($val)."' ";
$set[] = " jg_order = '".(int)$_POST['jg_order']."' ";
$set[] = " jg_use   = '".(isset($_POST['jg_use']) ? 1 : 0)."' ";
$sets = implode(',', $set);

if ($w === 'u') {
	sql_query(" UPDATE ".G5_JUNGLE_GOODS_TABLE." SET $sets WHERE jg_id = '$jg_id' ");
} else {
	sql_query(" INSERT INTO ".G5_JUNGLE_GOODS_TABLE." SET $sets ");
}

/* 쓰지 않게 된 사진은 DB 가 바뀐 뒤에 지운다. 순서를 바꾸면 저장에 실패했을 때
   사진만 사라진다. 다른 줄이 같은 파일을 가리키면 남겨 둔다. */
if ($discard !== '' && $discard !== $image) {
	$used = sql_fetch(" SELECT COUNT(*) AS cnt FROM ".G5_JUNGLE_GOODS_TABLE." WHERE jg_image = '".sql_escape_string($discard)."' ", false);
	if (!$used || (int)$used['cnt'] === 0) @unlink(jungle_goods_dir().'/'.$discard);
}

goto_url('./jungle_goods.php');
