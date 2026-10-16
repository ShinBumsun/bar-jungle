<?php
$sub_menu = '950500';
require_once './_common.php';

check_demo();
auth_check_menu($auth, $sub_menu, 'w');
check_admin_token();
jungle_popup_setup();

$w     = isset($_POST['w']) ? $_POST['w'] : '';
$jp_id = isset($_POST['jp_id']) ? (int)$_POST['jp_id'] : 0;

/* 날짜는 YYYY-MM-DD 만 받는다. 브라우저가 보내는 모양이 그렇고,
   다른 글자가 섞이면 기간 비교가 조용히 어긋난다. */
function jungle_pick_date($v) {
	$v = trim($v);
	return preg_match('/^\d{4}-\d{2}-\d{2}$/', $v) ? $v : '';
}
$begin = jungle_pick_date(isset($_POST['jp_begin']) ? $_POST['jp_begin'] : '');
$end   = jungle_pick_date(isset($_POST['jp_end'])   ? $_POST['jp_end']   : '');
if ($begin !== '' && $end !== '' && $begin > $end) alert('공지 시작일이 종료일보다 늦습니다.');

/* 주소는 http(s) 만 받는다. javascript: 같은 것이 들어오면 누르는 순간
   그 코드가 우리 화면에서 실행된다. */
$url = trim(isset($_POST['jp_url']) ? $_POST['jp_url'] : '');
if ($url !== '' && !preg_match('#^https?://#i', $url)) alert('주소는 http:// 또는 https:// 로 시작해야 합니다.');

$old_image = '';
if ($w === 'u') {
	$prev = sql_fetch(" SELECT jp_image FROM ".G5_JUNGLE_POPUP_TABLE." WHERE jp_id = '$jp_id' ", false);
	if ($prev && isset($prev['jp_image'])) $old_image = trim($prev['jp_image']);
}

$new = jungle_save_image('jp_image', jungle_popup_dir(), 'popup', 8);
if ($w !== 'u' && $new === '') alert('팝업으로 띄울 그림을 골라 주세요.');

$image   = ($new !== '') ? $new : $old_image;
$discard = ($new !== '') ? $old_image : '';

$f = array(
	'jp_image' => $image,
	'jp_alt'   => trim($_POST['jp_alt']),
	'jp_url'   => $url,
	'jp_begin' => $begin,
	'jp_end'   => $end,
);
$set = array();
foreach ($f as $col => $val) $set[] = " $col = '".sql_escape_string($val)."' ";
$set[] = " jp_order = '".(int)$_POST['jp_order']."' ";
$set[] = " jp_use   = '".(isset($_POST['jp_use']) ? 1 : 0)."' ";
$sets = implode(',', $set);

if ($w === 'u') {
	sql_query(" UPDATE ".G5_JUNGLE_POPUP_TABLE." SET $sets WHERE jp_id = '$jp_id' ");
} else {
	sql_query(" INSERT INTO ".G5_JUNGLE_POPUP_TABLE." SET $sets ");
}

/* 쓰지 않게 된 그림은 DB 가 바뀐 뒤에 지운다. 순서를 바꾸면 저장에 실패했을 때
   그림만 사라진다. 다른 줄이 같은 파일을 가리키면 남겨 둔다. */
if ($discard !== '' && $discard !== $image) {
	$used = sql_fetch(" SELECT COUNT(*) AS cnt FROM ".G5_JUNGLE_POPUP_TABLE." WHERE jp_image = '".sql_escape_string($discard)."' ", false);
	if (!$used || (int)$used['cnt'] === 0) @unlink(jungle_popup_dir().'/'.$discard);
}

goto_url('./jungle_popup.php');
