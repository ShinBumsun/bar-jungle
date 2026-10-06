<?php
$sub_menu = '950300';
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'r');

jungle_season_setup();

$rows = jungle_season_rows(false);   // 꺼 둔 것도 보여야 켤 수 있다

$live = 0;
foreach ($rows as $r) if ($r['js_use']) $live++;

$g5['title'] = '시즌 메뉴 관리';
include_once(G5_ADMIN_PATH.'/admin.head.php');
?>

<div class="local_desc01 local_desc">
	<p>
		메뉴판 맨 앞 <b>SEASON</b> 탭에 걸리는 그림입니다. 이름·가격·설명 없이 <b>그림만</b> 나갑니다.
		올린 그림이 하나도 없으면 SEASON 탭 자체가 화면에 나오지 않습니다.
	</p>
</div>

<div class="local_ov01 local_ov">
	<span class="btn_ov01"><span class="ov_txt">등록된 그림</span><span class="ov_num"> <?php echo count($rows) ?>장</span></span>
	<span class="btn_ov01"><span class="ov_txt">화면에 보이는 것</span><span class="ov_num"> <?php echo $live ?>장</span></span>
	<a href="./jungle_season_form.php" class="ov_listall">새 그림 올리기</a>
</div>

<form name="flist" id="flist" action="./jungle_season_list_update.php" onsubmit="return flist_submit(this);" method="post">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>시즌 메뉴 그림 목록</caption>
	<thead>
	<tr>
		<th scope="col"><input type="checkbox" id="chkall" onclick="check_all(this.form)"><label for="chkall" class="sound_only">전체선택</label></th>
		<th scope="col">그림</th>
		<th scope="col">설명(대체 글)</th>
		<th scope="col">순서</th>
		<th scope="col">노출</th>
		<th scope="col">관리</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$i = 0;
	foreach ($rows as $row) {
		$f = trim($row['js_image']);
		$ok = ($f !== '' && is_file(jungle_season_dir().'/'.$f));
	?>
	<tr class="bg<?php echo $i % 2 ?>">
		<td class="td_chk">
			<input type="hidden" name="js_id[<?php echo $i ?>]" value="<?php echo $row['js_id'] ?>">
			<input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
			<label for="chk_<?php echo $i ?>" class="sound_only"><?php echo get_text($row['js_alt']) ?></label>
		</td>
		<td>
			<?php if ($ok) { ?>
			<a href="./jungle_season_form.php?w=u&amp;js_id=<?php echo $row['js_id'] ?>">
				<img src="<?php echo jungle_season_url().'/'.rawurlencode($f) ?>" alt="" style="width:90px;height:auto;border:1px solid #ccc;vertical-align:middle">
			</a>
			<?php } else { ?>
			<span style="color:#c33">그림 없음</span>
			<?php } ?>
		</td>
		<td><?php echo $row['js_alt'] ? get_text($row['js_alt']) : '<span style="color:#999">-</span>' ?></td>
		<td class="td_num"><input type="text" name="js_order[<?php echo $i ?>]" value="<?php echo $row['js_order'] ?>" class="frm_input" size="3"></td>
		<td class="td_chk"><input type="checkbox" name="js_use[<?php echo $i ?>]" value="1"<?php echo $row['js_use'] ? ' checked' : '' ?>></td>
		<td class="td_mng td_mng_s">
			<a href="./jungle_season_form.php?w=u&amp;js_id=<?php echo $row['js_id'] ?>" class="btn btn_03">수정</a>
		</td>
	</tr>
	<?php
		$i++;
	}
	if ($i === 0) echo '<tr><td colspan="6" class="empty_table">올린 그림이 없습니다.</td></tr>';
	?>
	</tbody>
	</table>
</div>

<div class="btn_fixed_top">
	<input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_03">
	<input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
	<a href="./jungle_season_form.php" class="btn btn_01">새 그림 올리기</a>
</div>
</form>

<script>
function check_all(f) {
	var chk = document.getElementsByName('chk[]');
	for (var i = 0; i < chk.length; i++) chk[i].checked = f.chkall.checked;
}
function flist_submit(f) {
	var cnt = 0, chk = document.getElementsByName('chk[]');
	for (var i = 0; i < chk.length; i++) if (chk[i].checked) cnt++;
	if (!cnt) { alert(document.pressed + '할 그림을 선택해 주세요.'); return false; }
	if (document.pressed === '선택삭제' && !confirm('선택한 ' + cnt + '장을 정말 삭제하시겠습니까?')) return false;
	f.action = './jungle_season_list_update.php';
	return true;
}
</script>

<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
