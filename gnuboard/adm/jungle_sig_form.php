<?php
$sub_menu = '950200';
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'r');

jungle_sig_setup();

$w     = isset($_GET['w']) ? $_GET['w'] : '';
$jm_id = isset($_GET['jm_id']) ? (int)$_GET['jm_id'] : 0;

$jm = array('jm_id'=>0,'jm_tab'=>'signature','jm_cat'=>'','jm_order'=>0,
	'jm_name_ko'=>'','jm_name_en'=>'','jm_name_ja'=>'',
	'jm_desc_ko'=>'','jm_desc_en'=>'','jm_desc_ja'=>'',
	'jm_price'=>'','jm_alc'=>0,'jm_vol'=>'','jm_note'=>'','jm_meter'=>'','jm_use'=>1,
	'jm_card'=>1,'jm_card_icon'=>'ck1','jm_card_color'=>'c1');

if ($w === 'u') {
	$row = sql_fetch(" SELECT * FROM ".G5_JUNGLE_SIG_TABLE." WHERE jm_id = '$jm_id' ", false);
	if (!$row || !$row['jm_id']) alert('존재하지 않는 항목입니다.', './jungle_sig.php');
	$jm = $row;
}

$g5['title'] = '시그니처 '.($w === 'u' ? '수정' : '등록');
include_once(G5_ADMIN_PATH.'/admin.head.php');
?>

<form name="fjungle" action="./jungle_sig_form_update.php" onsubmit="return fjungle_submit(this);" method="post">
<input type="hidden" name="token" value="">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="jm_id" value="<?php echo $jm['jm_id'] ?>">

<div class="tbl_frm01 tbl_wrap">
	<table>
	<caption>시그니처 <?php echo $w === 'u' ? '수정' : '등록' ?></caption>
	<colgroup><col class="grid_4"><col></colgroup>
	<tbody>
	<tr>
		<th scope="row"><label for="jm_name_ko">한글명 <strong class="sound_only">필수</strong></label></th>
		<td><input type="text" name="jm_name_ko" value="<?php echo get_text($jm['jm_name_ko']) ?>" id="jm_name_ko" required class="frm_input required" size="50"></td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_name_en">영문명</label></th>
		<td>
			<input type="text" name="jm_name_en" value="<?php echo get_text($jm['jm_name_en']) ?>" id="jm_name_en" class="frm_input" size="50">
			<span class="frm_info">메인 카드에서는 영문명이 크게, 한글명이 그 옆에 작게 나옵니다.</span>
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
		<td>
			<textarea name="jm_desc_ko" id="jm_desc_ko" class="frm_input" rows="3"><?php echo get_text($jm['jm_desc_ko']) ?></textarea>
			<span class="frm_info">메인 카드 아래에 들어가는 한 줄 소개입니다.</span>
		</td>
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
		<th scope="row"><label for="jm_note">꼬리말</label></th>
		<td>
			<input type="text" name="jm_note" value="<?php echo get_text($jm['jm_note']) ?>" id="jm_note" class="frm_input" size="24">
			<span class="frm_info">메뉴판에서 가격 옆에 작게 붙습니다. 예: 6 shots</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_card">메인 카드</label></th>
		<td>
			<input type="checkbox" name="jm_card" value="1" id="jm_card"<?php echo $jm['jm_card'] ? ' checked' : '' ?>>
			<label for="jm_card">메인 화면 SIGNATURE 섹션에 카드로 띄우기</label>
			<span class="frm_info">꺼도 메뉴판 SIGNATURE 탭에는 그대로 남습니다.</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_card_icon">카드 잔 그림</label></th>
		<td>
			<select name="jm_card_icon" id="jm_card_icon">
				<?php foreach ($g5['jungle_card_icons'] as $k => $label) { ?>
				<option value="<?php echo $k ?>"<?php echo $jm['jm_card_icon'] === $k ? ' selected' : '' ?>><?php echo $label ?></option>
				<?php } ?>
			</select>
			<span class="frm_info">카드 위쪽에 그려지는 잔 모양입니다.</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_card_color">카드 배경색</label></th>
		<td>
			<select name="jm_card_color" id="jm_card_color">
				<?php foreach ($g5['jungle_card_colors'] as $k => $label) { ?>
				<option value="<?php echo $k ?>"<?php echo $jm['jm_card_color'] === $k ? ' selected' : '' ?>><?php echo $label ?></option>
				<?php } ?>
			</select>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_order">순서</label></th>
		<td>
			<input type="text" name="jm_order" value="<?php echo (int)$jm['jm_order'] ?>" id="jm_order" class="frm_input" size="5">
			<span class="frm_info">숫자가 작을수록 카드 슬라이드와 메뉴판에서 앞에 나옵니다.</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jm_use">노출</label></th>
		<td>
			<input type="checkbox" name="jm_use" value="1" id="jm_use"<?php echo $jm['jm_use'] ? ' checked' : '' ?>>
			<label for="jm_use">화면에 보이기</label>
			<span class="frm_info">끄면 메인 카드와 메뉴판 양쪽에서 사라집니다.</span>
		</td>
	</tr>
	</tbody>
	</table>
</div>

<div class="btn_fixed_top">
	<a href="./jungle_sig.php" class="btn btn_02">목록</a>
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
