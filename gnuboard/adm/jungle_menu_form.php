<?php
$sub_menu = '950100';
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'r');

$w     = isset($_GET['w']) ? $_GET['w'] : '';
$jm_id = isset($_GET['jm_id']) ? (int)$_GET['jm_id'] : 0;

$jm = array('jm_id'=>0,'jm_tab'=>'signature','jm_cat'=>'','jm_order'=>0,
	'jm_name_ko'=>'','jm_name_en'=>'','jm_name_ja'=>'',
	'jm_desc_ko'=>'','jm_desc_en'=>'','jm_desc_ja'=>'',
	'jm_price'=>'','jm_alc'=>0,'jm_vol'=>'','jm_note'=>'','jm_meter'=>'','jm_use'=>1);

if ($w === 'u') {
	$row = sql_fetch(" SELECT * FROM ".G5_JUNGLE_MENU_TABLE." WHERE jm_id = '$jm_id' ");
	if (!$row['jm_id']) alert('존재하지 않는 항목입니다.', './jungle_menu.php');
	$jm = $row;
}

$g5['title'] = '메뉴 항목 '.($w === 'u' ? '수정' : '등록');
include_once(G5_ADMIN_PATH.'/admin.head.php');
?>

<form name="fjungle" action="./jungle_menu_form_update.php" onsubmit="return fjungle_submit(this);" method="post">
<input type="hidden" name="token" value="">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="jm_id" value="<?php echo $jm['jm_id'] ?>">

<div class="tbl_frm01 tbl_wrap">
	<table>
	<caption>메뉴 항목 <?php echo $w === 'u' ? '수정' : '등록' ?></caption>
	<colgroup><col class="grid_4"><col></colgroup>
	<tbody>
	<tr>
		<th scope="row"><label for="jm_tab">분류 <strong class="sound_only">필수</strong></label></th>
		<td>
			<select name="jm_tab" id="jm_tab" required class="required">
				<?php foreach ($g5['jungle_tabs'] as $k => $label) { ?>
				<option value="<?php echo $k ?>"<?php echo $jm['jm_tab'] === $k ? ' selected' : '' ?>><?php echo $label ?></option>
				<?php } ?>
			</select>
			<span class="frm_info">화면 위쪽 탭 버튼입니다.</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_cat">소분류</label></th>
		<td>
			<input type="text" name="jm_cat" value="<?php echo get_text($jm['jm_cat']) ?>" id="jm_cat" class="frm_input" size="30">
			<span class="frm_info">탭 안에서 다시 묶을 때 쓰는 제목입니다. 예: FIZZY, MARTINI. 비우면 묶음 없이 나옵니다.</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_name_ko">한글명 <strong class="sound_only">필수</strong></label></th>
		<td><input type="text" name="jm_name_ko" value="<?php echo get_text($jm['jm_name_ko']) ?>" id="jm_name_ko" required class="frm_input required" size="50"></td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_name_en">영문명</label></th>
		<td>
			<input type="text" name="jm_name_en" value="<?php echo get_text($jm['jm_name_en']) ?>" id="jm_name_en" class="frm_input" size="50">
			<span class="frm_info">세 언어 모두에서 이름 옆에 작게 따라붙습니다.</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_name_ja">일본어명</label></th>
		<td>
			<input type="text" name="jm_name_ja" value="<?php echo get_text($jm['jm_name_ja']) ?>" id="jm_name_ja" class="frm_input" size="50">
			<span class="frm_info">일본어 화면에서 한글명 자리에 들어갑니다. 비우면 한글명이 그대로 나옵니다.</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_desc_ko">한국어 설명</label></th>
		<td><textarea name="jm_desc_ko" id="jm_desc_ko" class="frm_input" rows="3"><?php echo get_text($jm['jm_desc_ko']) ?></textarea></td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_desc_en">영문 설명</label></th>
		<td>
			<textarea name="jm_desc_en" id="jm_desc_en" class="frm_input" rows="3"><?php echo get_text($jm['jm_desc_en']) ?></textarea>
			<span class="frm_info">비우면 영문 화면에서 설명 줄이 나오지 않습니다.</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_desc_ja">일본어 설명</label></th>
		<td>
			<textarea name="jm_desc_ja" id="jm_desc_ja" class="frm_input" rows="3"><?php echo get_text($jm['jm_desc_ja']) ?></textarea>
			<span class="frm_info">비우면 일본어 화면에서 설명 줄이 나오지 않습니다.</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_price">가격</label></th>
		<td>
			<input type="text" name="jm_price" value="<?php echo get_text($jm['jm_price']) ?>" id="jm_price" class="frm_input" size="24">
			<span class="frm_info">보이는 그대로 적습니다. 예: 13,000</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_alc">도수</label></th>
		<td>
			<select name="jm_alc" id="jm_alc">
				<option value="0"<?php echo (int)$jm['jm_alc'] === 0 ? ' selected' : '' ?>>표시 안 함</option>
				<?php for ($n = 1; $n <= 5; $n++) { ?>
				<option value="<?php echo $n ?>"<?php echo (int)$jm['jm_alc'] === $n ? ' selected' : '' ?>><?php echo $n ?>단계</option>
				<?php } ?>
			</select>
			<span class="frm_info">점 다섯 개로 표시됩니다.</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_vol">용량</label></th>
		<td>
			<input type="text" name="jm_vol" value="<?php echo get_text($jm['jm_vol']) ?>" id="jm_vol" class="frm_input" size="16">
			<span class="frm_info">보틀 메뉴용. 예: 700ml</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_meter">와인 지표</label></th>
		<td>
			<input type="text" name="jm_meter" value="<?php echo get_text($jm['jm_meter']) ?>" id="jm_meter" class="frm_input" size="40">
			<span class="frm_info">와인에만 씁니다. 예: sweetness:1|body:3</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_note">꼬리말</label></th>
		<td>
			<input type="text" name="jm_note" value="<?php echo get_text($jm['jm_note']) ?>" id="jm_note" class="frm_input" size="24">
			<span class="frm_info">가격 옆에 작게 붙습니다. 예: 6 shots</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_order">순서</label></th>
		<td>
			<input type="text" name="jm_order" value="<?php echo (int)$jm['jm_order'] ?>" id="jm_order" class="frm_input" size="5">
			<span class="frm_info">숫자가 작을수록 위에 나옵니다.</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_use">노출</label></th>
		<td><input type="checkbox" name="jm_use" value="1" id="jm_use"<?php echo $jm['jm_use'] ? ' checked' : '' ?>> <label for="jm_use">화면에 보이기</label></td>
	</tr>
	</tbody>
	</table>
</div>

<div class="btn_fixed_top">
	<a href="./jungle_menu.php" class="btn btn_02">목록</a>
	<input type="submit" value="저장" class="btn btn_submit">
</div>
</form>

<script>
function fjungle_submit(f) {
	if (!f.jm_name_ko.value.replace(/\s/g, '')) { alert('한글명을 입력해 주세요.'); f.jm_name_ko.focus(); return false; }
	return true;
}
</script>

<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
