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


/* 사진
   관리자가 올린 파일이므로 확장자를 믿지 않는다. getimagesize 로 진짜 그림인지
   보고, 이름도 우리가 다시 짓는다. 올린 이름을 그대로 쓰면 한글·공백·확장자
   위조가 그대로 서버에 남는다. */
$old_image = '';
if ($w === 'u') {
	$prev = sql_fetch(" SELECT jm_image FROM ".G5_JUNGLE_SIG_TABLE." WHERE jm_id = '$jm_id' ", false);
	if ($prev && isset($prev['jm_image'])) $old_image = trim($prev['jm_image']);
}
$image   = $old_image;
$discard = '';

$up = isset($_FILES['jm_image']) ? $_FILES['jm_image'] : null;
if ($up && isset($up['tmp_name']) && $up['error'] === UPLOAD_ERR_OK && is_uploaded_file($up['tmp_name'])) {

	if ($up['size'] > 5 * 1024 * 1024) alert('사진은 5MB 까지 올릴 수 있습니다.');

	$info = @getimagesize($up['tmp_name']);
	$ext  = array(IMAGETYPE_JPEG => 'jpg', IMAGETYPE_PNG => 'png', IMAGETYPE_WEBP => 'webp');
	if (!$info || !isset($ext[$info[2]])) alert('jpg, png, webp 그림만 올릴 수 있습니다.');

	$dir = jungle_sig_dir();
	if (!is_dir($dir)) @mkdir($dir, G5_DIR_PERMISSION, true);
	if (!is_dir($dir)) alert('사진을 저장할 폴더를 만들지 못했습니다.');

	$name = 'sig_'.($w === 'u' ? (int)$jm_id : 'new').'_'.date('YmdHis').'_'.substr(md5(uniqid('', true)), 0, 6).'.'.$ext[$info[2]];
	if (!@move_uploaded_file($up['tmp_name'], $dir.'/'.$name)) alert('사진을 저장하지 못했습니다.');
	@chmod($dir.'/'.$name, G5_FILE_PERMISSION);

	$discard = $old_image;   /* 새로 올렸으니 예전 것은 지운다 */
	$image   = $name;

} else if (isset($_POST['jm_image_del'])) {
	$discard = $old_image;
	$image   = '';
}

$set[] = " jm_image = '".sql_escape_string($image)."' ";

$sets = implode(',', $set);

if ($w === 'u') {
	sql_query(" UPDATE ".G5_JUNGLE_SIG_TABLE." SET $sets WHERE jm_id = '$jm_id' ");
} else {
	sql_query(" INSERT INTO ".G5_JUNGLE_SIG_TABLE." SET $sets ");
}

/* 쓰지 않게 된 파일은 DB 가 바뀐 뒤에 지운다. 순서를 바꾸면 저장에 실패했을 때
   사진만 사라진다. 다른 줄이 같은 파일을 가리키고 있으면 남겨 둔다. */
if ($discard !== '' && $discard !== $image) {
	$used = sql_fetch(" SELECT COUNT(*) AS cnt FROM ".G5_JUNGLE_SIG_TABLE."
	                    WHERE jm_image = '".sql_escape_string($discard)."' ", false);
	if (!$used || (int)$used['cnt'] === 0) @unlink(jungle_sig_dir().'/'.$discard);
}

goto_url('./jungle_sig.php');
