<?php
$sub_menu = '950400';
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'r');
jungle_goods_setup();

$w     = isset($_GET['w']) ? $_GET['w'] : '';
$jg_id = isset($_GET['jg_id']) ? (int)$_GET['jg_id'] : 0;

$jg = array('jg_id'=>0,'jg_order'=>0,'jg_image'=>'','jg_name_ko'=>'','jg_name_en'=>'','jg_name_ja'=>'',
	'jg_desc_ko'=>'','jg_desc_en'=>'','jg_desc_ja'=>'','jg_price'=>'','jg_price_was'=>'',
	'jg_note'=>'','jg_badge'=>'','jg_use'=>1);

if ($w === 'u') {
	$row = sql_fetch(" SELECT * FROM ".G5_JUNGLE_GOODS_TABLE." WHERE jg_id = '$jg_id' ", false);
	if (!$row || !$row['jg_id']) alert('존재하지 않는 굿즈입니다.', './jungle_goods.php');
	$jg = $row;
}

$g5['title'] = '굿즈 '.($w === 'u' ? '수정' : '등록');
include_once(G5_ADMIN_PATH.'/admin.head.php');
?>

<form name="fgoods" action="./jungle_goods_form_update.php" onsubmit="return fgoods_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="token" value="">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="jg_id" value="<?php echo $jg['jg_id'] ?>">

<div class="tbl_frm01 tbl_wrap">
	<table>
	<caption>굿즈 <?php echo $w === 'u' ? '수정' : '등록' ?></caption>
	<colgroup><col class="grid_4"><col></colgroup>
	<tbody>
	<tr>
		<th scope="row"><label for="jg_image">사진<?php if ($w !== 'u') echo ' <strong class="sound_only">필수</strong>' ?></label></th>
		<td>
<?php $cur = trim($jg['jg_image']); if ($cur !== '' && is_file(jungle_goods_dir().'/'.$cur)) { ?>
			<p style="margin:0 0 10px"><img src="<?php echo jungle_goods_url().'/'.rawurlencode($cur) ?>?<?php echo @filemtime(jungle_goods_dir().'/'.$cur) ?>" alt="올린 사진" style="width:220px;height:220px;object-fit:cover;border:2px solid #241f18"></p>
<?php } ?>
			<input type="file" name="jg_image" id="jg_image" accept="image/jpeg,image/png,image/webp">
			<span class="frm_info">
				정사각형으로 잘라서 보여 줍니다. 가운데가 잘리니 물건이 가운데 오게 찍은 사진이 좋습니다.<br>
				인스타에 올린 홍보 이미지를 그대로 쓰셔도 됩니다. jpg·png·webp, 8MB 까지.<br>
				수정할 때 파일을 고르지 않으면 지금 사진이 그대로 남습니다.
			</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jg_name_ko">이름 <strong class="sound_only">필수</strong></label></th>
		<td><input type="text" name="jg_name_ko" value="<?php echo get_text($jg['jg_name_ko']) ?>" id="jg_name_ko" required class="frm_input required" size="50"></td>
	</tr>
	<tr>
		<th scope="row"><label for="jg_name_en">영문 이름</label></th>
		<td><input type="text" name="jg_name_en" value="<?php echo get_text($jg['jg_name_en']) ?>" id="jg_name_en" class="frm_input" size="50"><span class="frm_info">비우면 한글 이름이 그대로 나옵니다.</span></td>
	</tr>
	<tr>
		<th scope="row"><label for="jg_name_ja">일본어 이름</label></th>
		<td><input type="text" name="jg_name_ja" value="<?php echo get_text($jg['jg_name_ja']) ?>" id="jg_name_ja" class="frm_input" size="50"></td>
	</tr>
	<tr>
		<th scope="row"><label for="jg_price">가격 <strong class="sound_only">필수</strong></label></th>
		<td>
			<input type="text" name="jg_price" value="<?php echo get_text($jg['jg_price']) ?>" id="jg_price" required class="frm_input required" size="20">
			<span class="frm_info">보이는 그대로 적습니다. 예: 10,000원</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jg_price_was">할인 전 가격</label></th>
		<td>
			<input type="text" name="jg_price_was" value="<?php echo get_text($jg['jg_price_was']) ?>" id="jg_price_was" class="frm_input" size="20">
			<span class="frm_info">적으면 가격 옆에 취소선으로 함께 나옵니다. 할인이 아니면 비워 두세요. 예: 12,000</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jg_note">가격 밑 한 줄</label></th>
		<td>
			<input type="text" name="jg_note" value="<?php echo get_text($jg['jg_note']) ?>" id="jg_note" class="frm_input" size="50">
			<span class="frm_info">수량이나 구성처럼 짧게 덧붙일 말. 예: 2장 16,000원 · 건전지 포함</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jg_badge">뱃지</label></th>
		<td>
			<select name="jg_badge" id="jg_badge">
				<?php foreach ($g5['jungle_goods_badge'] as $k => $label) { ?>
				<option value="<?php echo $k ?>"<?php echo $jg['jg_badge'] === $k ? ' selected' : '' ?>><?php echo $label ?></option>
				<?php } ?>
			</select>
			<span class="frm_info">사진 왼쪽 위에 붙습니다. '품절' 을 고르면 사진이 흐려지고 품절 표시가 덮입니다.</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jg_desc_ko">설명</label></th>
		<td><input type="text" name="jg_desc_ko" value="<?php echo get_text($jg['jg_desc_ko']) ?>" id="jg_desc_ko" class="frm_input" size="60"><span class="frm_info">한 줄이면 충분합니다. 예: 4가지 색상 (검, 흰, 파, 녹)</span></td>
	</tr>
	<tr>
		<th scope="row"><label for="jg_desc_en">영문 설명</label></th>
		<td><input type="text" name="jg_desc_en" value="<?php echo get_text($jg['jg_desc_en']) ?>" id="jg_desc_en" class="frm_input" size="60"></td>
	</tr>
	<tr>
		<th scope="row"><label for="jg_desc_ja">일본어 설명</label></th>
		<td><input type="text" name="jg_desc_ja" value="<?php echo get_text($jg['jg_desc_ja']) ?>" id="jg_desc_ja" class="frm_input" size="60"></td>
	</tr>
	<tr>
		<th scope="row"><label for="jg_order">순서</label></th>
		<td><input type="text" name="jg_order" value="<?php echo (int)$jg['jg_order'] ?>" id="jg_order" class="frm_input" size="5"><span class="frm_info">숫자가 작을수록 앞에 나옵니다.</span></td>
	</tr>
	<tr>
		<th scope="row"><label for="jg_use">노출</label></th>
		<td>
			<input type="checkbox" name="jg_use" value="1" id="jg_use"<?php echo $jg['jg_use'] ? ' checked' : '' ?>>
			<label for="jg_use">화면에 보이기</label>
			<span class="frm_info">끄면 지우지 않고 감춥니다. 잠깐 안 파는 물건에 쓰세요.</span>
		</td>
	</tr>
	</tbody>
	</table>
</div>

<div class="btn_fixed_top">
	<a href="./jungle_goods.php" class="btn btn_02">목록</a>
	<input type="submit" value="저장" class="btn btn_submit">
</div>
</form>

<script>
function fgoods_submit(f) {
	if (f.w.value !== 'u' && !f.jg_image.value) { alert('사진을 골라 주세요.'); f.jg_image.focus(); return false; }
	if (!f.jg_name_ko.value.replace(/\s/g, '')) { alert('이름을 입력해 주세요.'); f.jg_name_ko.focus(); return false; }
	if (!f.jg_price.value.replace(/\s/g, '')) { alert('가격을 입력해 주세요.'); f.jg_price.focus(); return false; }
	return true;
}
</script>

<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
