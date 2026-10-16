<?php
$sub_menu = '950500';
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'r');
jungle_popup_setup();

$w     = isset($_GET['w']) ? $_GET['w'] : '';
$jp_id = isset($_GET['jp_id']) ? (int)$_GET['jp_id'] : 0;

$jp = array('jp_id'=>0,'jp_order'=>0,'jp_image'=>'','jp_alt'=>'','jp_url'=>'','jp_begin'=>'','jp_end'=>'','jp_use'=>1);

if ($w === 'u') {
	$row = sql_fetch(" SELECT * FROM ".G5_JUNGLE_POPUP_TABLE." WHERE jp_id = '$jp_id' ", false);
	if (!$row || !$row['jp_id']) alert('존재하지 않는 팝업입니다.', './jungle_popup.php');
	$jp = $row;
}

$g5['title'] = '팝업 '.($w === 'u' ? '수정' : '등록');
include_once(G5_ADMIN_PATH.'/admin.head.php');
?>

<form name="fpopup" action="./jungle_popup_form_update.php" onsubmit="return fpopup_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="token" value="">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="jp_id" value="<?php echo $jp['jp_id'] ?>">

<div class="tbl_frm01 tbl_wrap">
	<table>
	<caption>팝업 <?php echo $w === 'u' ? '수정' : '등록' ?></caption>
	<colgroup><col class="grid_4"><col></colgroup>
	<tbody>
	<tr>
		<th scope="row"><label for="jp_image">그림<?php if ($w !== 'u') echo ' <strong class="sound_only">필수</strong>' ?></label></th>
		<td>
<?php $cur = trim($jp['jp_image']); if ($cur !== '' && is_file(jungle_popup_dir().'/'.$cur)) { ?>
			<p style="margin:0 0 10px"><img src="<?php echo jungle_popup_url().'/'.rawurlencode($cur) ?>?<?php echo @filemtime(jungle_popup_dir().'/'.$cur) ?>" alt="올린 그림" style="width:240px;height:auto;border:2px solid #241f18"></p>
<?php } ?>
			<input type="file" name="jp_image" id="jp_image" accept="image/jpeg,image/png,image/webp">
			<span class="frm_info">
				비율은 건드리지 않고 그대로 보여 줍니다. 정사각이나 세로가 조금 긴 그림이 보기 좋습니다.<br>
				jpg·png·webp, 8MB 까지. 수정할 때 파일을 고르지 않으면 지금 그림이 그대로 남습니다.
			</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jp_url">누르면 갈 주소</label></th>
		<td>
			<input type="text" name="jp_url" value="<?php echo get_text($jp['jp_url']) ?>" id="jp_url" class="frm_input" size="70" placeholder="https://forms.gle/...">
			<span class="frm_info">구글폼 주소를 붙여 넣으시면 됩니다. 새 창으로 열립니다. 비우면 누를 수 없는 그림만 뜹니다.</span>
		</td>
	</tr>
	<tr>
		<th scope="row">공지 기간</th>
		<td>
			<input type="date" name="jp_begin" value="<?php echo get_text($jp['jp_begin']) ?>" id="jp_begin" class="frm_input">
			~
			<input type="date" name="jp_end" value="<?php echo get_text($jp['jp_end']) ?>" id="jp_end" class="frm_input">
			<span class="frm_info">
				이 기간에만 뜹니다. 기간이 지나면 저절로 사라지니 따로 끄실 필요가 없습니다.<br>
				한쪽을 비우면 그쪽은 제한이 없습니다. 둘 다 비우면 끄실 때까지 계속 뜹니다.
			</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jp_alt">설명(대체 글)</label></th>
		<td>
			<input type="text" name="jp_alt" value="<?php echo get_text($jp['jp_alt']) ?>" id="jp_alt" class="frm_input" size="60" maxlength="200">
			<span class="frm_info">화면에는 보이지 않습니다. 그림이 안 뜰 때와 화면 낭독기에서 쓰입니다. 예: 3주년 트리플 타이거 티셔츠 구매 안내</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jp_order">순서</label></th>
		<td><input type="text" name="jp_order" value="<?php echo (int)$jp['jp_order'] ?>" id="jp_order" class="frm_input" size="5"><span class="frm_info">여러 개가 겹칠 때 숫자가 작은 것이 위에 옵니다.</span></td>
	</tr>
	<tr>
		<th scope="row"><label for="jp_use">노출</label></th>
		<td>
			<input type="checkbox" name="jp_use" value="1" id="jp_use"<?php echo $jp['jp_use'] ? ' checked' : '' ?>>
			<label for="jp_use">켜기</label>
			<span class="frm_info">끄면 기간 안이어도 뜨지 않습니다. 잠깐 내릴 때 쓰세요.</span>
		</td>
	</tr>
	</tbody>
	</table>
</div>

<div class="btn_fixed_top">
	<a href="./jungle_popup.php" class="btn btn_02">목록</a>
	<input type="submit" value="저장" class="btn btn_submit">
</div>
</form>

<script>
function fpopup_submit(f) {
	if (f.w.value !== 'u' && !f.jp_image.value) { alert('팝업으로 띄울 그림을 골라 주세요.'); f.jp_image.focus(); return false; }
	var b = f.jp_begin.value, e = f.jp_end.value;
	if (b && e && b > e) { alert('공지 시작일이 종료일보다 늦습니다.'); f.jp_begin.focus(); return false; }
	var u = f.jp_url.value.replace(/\s/g, '');
	if (u && !/^https?:\/\//i.test(u)) { alert('주소는 http:// 또는 https:// 로 시작해야 합니다.'); f.jp_url.focus(); return false; }
	return true;
}
</script>

<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
