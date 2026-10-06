<?php
$sub_menu = '950300';
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'r');

jungle_season_setup();

$w     = isset($_GET['w']) ? $_GET['w'] : '';
$js_id = isset($_GET['js_id']) ? (int)$_GET['js_id'] : 0;

$js = array('js_id'=>0, 'js_order'=>0, 'js_image'=>'', 'js_alt'=>'', 'js_use'=>1);

if ($w === 'u') {
	$row = sql_fetch(" SELECT * FROM ".G5_JUNGLE_SEASON_TABLE." WHERE js_id = '$js_id' ", false);
	if (!$row || !$row['js_id']) alert('존재하지 않는 그림입니다.', './jungle_season.php');
	$js = $row;
}

$g5['title'] = '시즌 메뉴 '.($w === 'u' ? '수정' : '올리기');
include_once(G5_ADMIN_PATH.'/admin.head.php');
?>

<form name="fseason" action="./jungle_season_form_update.php" onsubmit="return fseason_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="token" value="">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="js_id" value="<?php echo $js['js_id'] ?>">

<div class="tbl_frm01 tbl_wrap">
	<table>
	<caption>시즌 메뉴 <?php echo $w === 'u' ? '수정' : '올리기' ?></caption>
	<colgroup><col class="grid_4"><col></colgroup>
	<tbody>
	<tr>
		<th scope="row"><label for="js_image">그림<?php if ($w !== 'u') echo ' <strong class="sound_only">필수</strong>' ?></label></th>
		<td>
<?php $cur = trim($js['js_image']); if ($cur !== '' && is_file(jungle_season_dir().'/'.$cur)) { ?>
			<p style="margin:0 0 10px">
				<img src="<?php echo jungle_season_url().'/'.rawurlencode($cur) ?>?<?php echo @filemtime(jungle_season_dir().'/'.$cur) ?>" alt="올린 그림" style="width:260px;height:auto;border:2px solid #241f18">
			</p>
<?php } ?>
			<input type="file" name="js_image" id="js_image" accept="image/jpeg,image/png,image/webp">
			<span class="frm_info">
				포스터를 그대로 올리시면 됩니다. 비율은 건드리지 않고 그대로 보여 줍니다.<br>
				jpg·png·webp, 8MB 까지. 가로 1200px 안팎이면 충분합니다.<br>
				수정할 때 파일을 고르지 않으면 지금 그림이 그대로 남습니다.
			</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="js_alt">설명(대체 글)</label></th>
		<td>
			<input type="text" name="js_alt" value="<?php echo get_text($js['js_alt']) ?>" id="js_alt" class="frm_input" size="50" maxlength="200">
			<span class="frm_info">화면에는 보이지 않습니다. 그림이 안 뜰 때와 화면 낭독기에서 쓰입니다. 예: 청글보이 배 칵테일 포스터</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="js_order">순서</label></th>
		<td>
			<input type="text" name="js_order" value="<?php echo (int)$js['js_order'] ?>" id="js_order" class="frm_input" size="5">
			<span class="frm_info">숫자가 작을수록 앞에 나옵니다.</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="js_use">노출</label></th>
		<td>
			<input type="checkbox" name="js_use" value="1" id="js_use"<?php echo $js['js_use'] ? ' checked' : '' ?>>
			<label for="js_use">화면에 보이기</label>
			<span class="frm_info">끄면 지우지 않고 감춰 둡니다. 지난 시즌 포스터를 남겨 둘 때 쓰세요.</span>
		</td>
	</tr>
	</tbody>
	</table>
</div>

<div class="btn_fixed_top">
	<a href="./jungle_season.php" class="btn btn_02">목록</a>
	<input type="submit" value="저장" class="btn btn_submit">
</div>
</form>

<script>
function fseason_submit(f) {
	if (f.w.value !== 'u' && !f.js_image.value) { alert('올릴 그림을 골라 주세요.'); f.js_image.focus(); return false; }
	return true;
}
</script>

<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
