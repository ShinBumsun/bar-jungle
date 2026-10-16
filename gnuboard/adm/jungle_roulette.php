<?php
$sub_menu = '950600';
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'r');
jungle_roulette_setup();

$rows  = jungle_roulette_rows(false);
$total = 0;
foreach ($rows as $r) if ($r['jr_use']) $total += max(0, (int)$r['jr_rate']);

$g5['title'] = '룰렛 관리';
include_once(G5_ADMIN_PATH.'/admin.head.php');
?>

<div class="local_desc01 local_desc">
	<p>
		이벤트 페이지 <b><a href="<?php echo G5_URL ?>/event.php" target="_blank">/event.php</a></b> 에서 돌리는 뽑기입니다.
		확률은 <b>적어 두신 값을 전체 합으로 나눈 몫</b>입니다. 합이 100 이 아니어도 괜찮습니다 —
		10·20·30·40 처럼 적으시면 알아서 비율로 계산합니다. 지금 전체 합은 <b><?php echo $total ?></b> 입니다.
		<br>뽑는 일은 서버에서 합니다. 손님이 화면을 뜯어봐도 확률을 바꾸거나 원하는 것을 고를 수 없습니다.
	</p>
</div>

<div class="local_ov01 local_ov">
	<span class="btn_ov01"><span class="ov_txt">등록된 칸</span><span class="ov_num"> <?php echo count($rows) ?>개</span></span>
	<span class="btn_ov01"><span class="ov_txt">확률 합</span><span class="ov_num"> <?php echo $total ?></span></span>
	<a href="./jungle_roulette_form.php" class="ov_listall">새 칸 등록</a>
</div>

<form name="flist" id="flist" action="./jungle_roulette_list_update.php" onsubmit="return flist_submit(this);" method="post">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>룰렛 칸 목록</caption>
	<thead>
	<tr>
		<th scope="col"><input type="checkbox" id="chkall" onclick="check_all(this.form)"><label for="chkall" class="sound_only">전체선택</label></th>
		<th scope="col">당첨 이미지</th>
		<th scope="col">상품명</th>
		<th scope="col">확률 값</th>
		<th scope="col">실제 확률</th>
		<th scope="col">당첨 시 나오는 말</th>
		<th scope="col">순서</th>
		<th scope="col">사용</th>
		<th scope="col">관리</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$i = 0;
	foreach ($rows as $row) {
		$f  = trim($row['jr_image']);
		$ok = ($f !== '' && is_file(jungle_roulette_dir().'/'.$f));
		$pct = ($row['jr_use'] && $total > 0) ? round((int)$row['jr_rate'] * 100 / $total, 1) : 0;
	?>
	<tr class="bg<?php echo $i % 2 ?>">
		<td class="td_chk">
			<input type="hidden" name="jr_id[<?php echo $i ?>]" value="<?php echo $row['jr_id'] ?>">
			<input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
			<label for="chk_<?php echo $i ?>" class="sound_only"><?php echo get_text($row['jr_name']) ?></label>
		</td>
		<td>
			<?php if ($ok) { ?>
			<a href="./jungle_roulette_form.php?w=u&amp;jr_id=<?php echo $row['jr_id'] ?>"><img src="<?php echo jungle_roulette_url().'/'.rawurlencode($f) ?>" alt="" style="width:56px;height:56px;object-fit:cover;border:1px solid #ccc;vertical-align:middle"></a>
			<?php } else { ?><span style="color:#999">없음</span><?php } ?>
		</td>
		<td><a href="./jungle_roulette_form.php?w=u&amp;jr_id=<?php echo $row['jr_id'] ?>"><?php echo get_text($row['jr_name']) ?></a></td>
		<td class="td_num"><?php echo (int)$row['jr_rate'] ?></td>
		<td class="td_num"><b style="color:<?php echo $pct > 0 ? '#2f7346' : '#999' ?>"><?php echo $row['jr_use'] ? $pct.'%' : '-' ?></b></td>
		<td><?php echo get_text(cut_str($row['jr_msg'], 46)) ?></td>
		<td class="td_num"><input type="text" name="jr_order[<?php echo $i ?>]" value="<?php echo $row['jr_order'] ?>" class="frm_input" size="3"></td>
		<td class="td_chk"><input type="checkbox" name="jr_use[<?php echo $i ?>]" value="1"<?php echo $row['jr_use'] ? ' checked' : '' ?>></td>
		<td class="td_mng td_mng_s"><a href="./jungle_roulette_form.php?w=u&amp;jr_id=<?php echo $row['jr_id'] ?>" class="btn btn_03">수정</a></td>
	</tr>
	<?php $i++; }
	if ($i === 0) echo '<tr><td colspan="9" class="empty_table">등록된 칸이 없습니다.</td></tr>';
	?>
	</tbody>
	</table>
</div>

<div class="btn_fixed_top">
	<input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_03">
	<input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
	<a href="./jungle_roulette_form.php" class="btn btn_01">새 칸 등록</a>
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
	if (!cnt) { alert(document.pressed + '할 칸을 선택해 주세요.'); return false; }
	if (document.pressed === '선택삭제' && !confirm('선택한 ' + cnt + '개를 정말 삭제하시겠습니까?')) return false;
	f.action = './jungle_roulette_list_update.php';
	return true;
}
</script>

<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
