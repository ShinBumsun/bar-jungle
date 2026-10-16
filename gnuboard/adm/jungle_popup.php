<?php
$sub_menu = '950500';
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'r');
jungle_popup_setup();

$rows = jungle_popup_rows(false);
$live = count(jungle_popup_rows(true));

$g5['title'] = '팝업 관리';
include_once(G5_ADMIN_PATH.'/admin.head.php');
?>

<div class="local_desc01 local_desc">
	<p>
		메인 화면에 잠깐 띄우는 알림입니다. 제목도 설명도 없이 <b>그림 한 장</b>만 나가고,
		누르면 적어 두신 <b>주소로 넘어갑니다</b>(구글폼 등).
		공지 기간이 지나면 저절로 사라지니 따로 끄실 필요가 없습니다.
	</p>
</div>

<div class="local_ov01 local_ov">
	<span class="btn_ov01"><span class="ov_txt">등록된 팝업</span><span class="ov_num"> <?php echo count($rows) ?>개</span></span>
	<span class="btn_ov01"><span class="ov_txt">지금 뜨는 것</span><span class="ov_num"> <?php echo $live ?>개</span></span>
	<a href="./jungle_popup_form.php" class="ov_listall">새 팝업 등록</a>
</div>

<form name="flist" id="flist" action="./jungle_popup_list_update.php" onsubmit="return flist_submit(this);" method="post">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>팝업 목록</caption>
	<thead>
	<tr>
		<th scope="col"><input type="checkbox" id="chkall" onclick="check_all(this.form)"><label for="chkall" class="sound_only">전체선택</label></th>
		<th scope="col">그림</th>
		<th scope="col">상태</th>
		<th scope="col">공지 기간</th>
		<th scope="col">누르면 갈 주소</th>
		<th scope="col">순서</th>
		<th scope="col">노출</th>
		<th scope="col">관리</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$i = 0;
	foreach ($rows as $row) {
		$f = trim($row['jp_image']);
		$ok = ($f !== '' && is_file(jungle_popup_dir().'/'.$f));
		list($st, $stc) = jungle_popup_state($row);
		$b = trim($row['jp_begin']); $e = trim($row['jp_end']);
	?>
	<tr class="bg<?php echo $i % 2 ?>">
		<td class="td_chk">
			<input type="hidden" name="jp_id[<?php echo $i ?>]" value="<?php echo $row['jp_id'] ?>">
			<input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
			<label for="chk_<?php echo $i ?>" class="sound_only">팝업 <?php echo $row['jp_id'] ?></label>
		</td>
		<td>
			<?php if ($ok) { ?>
			<a href="./jungle_popup_form.php?w=u&amp;jp_id=<?php echo $row['jp_id'] ?>"><img src="<?php echo jungle_popup_url().'/'.rawurlencode($f) ?>" alt="" style="width:72px;height:72px;object-fit:cover;border:1px solid #ccc;vertical-align:middle"></a>
			<?php } else { ?><span style="color:#c33">그림 없음</span><?php } ?>
		</td>
		<td class="td_category"><b style="color:<?php echo $stc ?>"><?php echo $st ?></b></td>
		<td class="td_date">
			<?php echo $b !== '' ? $b : '<span style="color:#999">제한 없음</span>' ?>
			~
			<?php echo $e !== '' ? $e : '<span style="color:#999">제한 없음</span>' ?>
		</td>
		<td style="word-break:break-all">
			<?php if (trim($row['jp_url']) !== '') { ?>
			<a href="<?php echo get_text($row['jp_url']) ?>" target="_blank" rel="noopener"><?php echo get_text(cut_str($row['jp_url'], 54)) ?></a>
			<?php } else { ?><span style="color:#999">없음(누를 수 없음)</span><?php } ?>
		</td>
		<td class="td_num"><input type="text" name="jp_order[<?php echo $i ?>]" value="<?php echo $row['jp_order'] ?>" class="frm_input" size="3"></td>
		<td class="td_chk"><input type="checkbox" name="jp_use[<?php echo $i ?>]" value="1"<?php echo $row['jp_use'] ? ' checked' : '' ?>></td>
		<td class="td_mng td_mng_s"><a href="./jungle_popup_form.php?w=u&amp;jp_id=<?php echo $row['jp_id'] ?>" class="btn btn_03">수정</a></td>
	</tr>
	<?php $i++; }
	if ($i === 0) echo '<tr><td colspan="8" class="empty_table">등록된 팝업이 없습니다.</td></tr>';
	?>
	</tbody>
	</table>
</div>

<div class="btn_fixed_top">
	<input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_03">
	<input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
	<a href="./jungle_popup_form.php" class="btn btn_01">새 팝업 등록</a>
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
	if (!cnt) { alert(document.pressed + '할 팝업을 선택해 주세요.'); return false; }
	if (document.pressed === '선택삭제' && !confirm('선택한 ' + cnt + '개를 정말 삭제하시겠습니까?')) return false;
	f.action = './jungle_popup_list_update.php';
	return true;
}
</script>

<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
