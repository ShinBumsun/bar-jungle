<?php
$sub_menu = '950400';
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'r');
jungle_goods_setup();

$rows = jungle_goods_rows(false);
$live = 0;
foreach ($rows as $r) if ($r['jg_use']) $live++;

$g5['title'] = '굿즈 관리';
include_once(G5_ADMIN_PATH.'/admin.head.php');
?>

<div class="local_desc01 local_desc">
	<p>
		매장에서 파는 물건을 소개하는 <b><a href="<?php echo G5_URL ?>/goods.php" target="_blank">굿즈 페이지</a></b>에 나갑니다.
		온라인 결제나 배송은 없습니다. <b>보고 매장에서 사 가시도록</b> 보여 주기만 하는 페이지입니다.
		메인 화면에는 나오지 않으니, 인스타 프로필 링크에 주소를 걸어 두시면 됩니다.
	</p>
</div>

<div class="local_ov01 local_ov">
	<span class="btn_ov01"><span class="ov_txt">등록된 굿즈</span><span class="ov_num"> <?php echo count($rows) ?>개</span></span>
	<span class="btn_ov01"><span class="ov_txt">화면에 보이는 것</span><span class="ov_num"> <?php echo $live ?>개</span></span>
	<a href="./jungle_goods_form.php" class="ov_listall">새 굿즈 등록</a>
</div>

<form name="flist" id="flist" action="./jungle_goods_list_update.php" onsubmit="return flist_submit(this);" method="post">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>굿즈 목록</caption>
	<thead>
	<tr>
		<th scope="col"><input type="checkbox" id="chkall" onclick="check_all(this.form)"><label for="chkall" class="sound_only">전체선택</label></th>
		<th scope="col">사진</th>
		<th scope="col">이름</th>
		<th scope="col">가격</th>
		<th scope="col">뱃지</th>
		<th scope="col">설명(한/영/일)</th>
		<th scope="col">순서</th>
		<th scope="col">노출</th>
		<th scope="col">관리</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$i = 0;
	foreach ($rows as $row) {
		$f = trim($row['jg_image']);
		$ok = ($f !== '' && is_file(jungle_goods_dir().'/'.$f));
	?>
	<tr class="bg<?php echo $i % 2 ?>">
		<td class="td_chk">
			<input type="hidden" name="jg_id[<?php echo $i ?>]" value="<?php echo $row['jg_id'] ?>">
			<input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
			<label for="chk_<?php echo $i ?>" class="sound_only"><?php echo get_text($row['jg_name_ko']) ?></label>
		</td>
		<td>
			<?php if ($ok) { ?>
			<a href="./jungle_goods_form.php?w=u&amp;jg_id=<?php echo $row['jg_id'] ?>"><img src="<?php echo jungle_goods_url().'/'.rawurlencode($f) ?>" alt="" style="width:64px;height:64px;object-fit:cover;border:1px solid #ccc;vertical-align:middle"></a>
			<?php } else { ?>
			<span style="color:#c33">사진 없음</span>
			<?php } ?>
		</td>
		<td><a href="./jungle_goods_form.php?w=u&amp;jg_id=<?php echo $row['jg_id'] ?>"><?php echo get_text($row['jg_name_ko']) ?></a></td>
		<td class="td_num">
			<?php if (trim($row['jg_price_was']) !== '') { ?><s style="color:#999"><?php echo get_text($row['jg_price_was']) ?></s><br><?php } ?>
			<b><?php echo get_text($row['jg_price']) ?></b>
		</td>
		<td class="td_category"><?php echo isset($g5['jungle_goods_badge'][$row['jg_badge']]) ? $g5['jungle_goods_badge'][$row['jg_badge']] : '-' ?></td>
		<td class="td_num">
			<?php
			$mark = '';
			foreach (array('ko' => '한', 'en' => '영', 'ja' => '일') as $lc => $kr) {
				$has = trim($row['jg_desc_'.$lc]) !== '';
				$mark .= '<span style="color:'.($has ? '#2f7346' : '#ccc').'">'.$kr.'</span> ';
			}
			echo $mark;
			?>
		</td>
		<td class="td_num"><input type="text" name="jg_order[<?php echo $i ?>]" value="<?php echo $row['jg_order'] ?>" class="frm_input" size="3"></td>
		<td class="td_chk"><input type="checkbox" name="jg_use[<?php echo $i ?>]" value="1"<?php echo $row['jg_use'] ? ' checked' : '' ?>></td>
		<td class="td_mng td_mng_s"><a href="./jungle_goods_form.php?w=u&amp;jg_id=<?php echo $row['jg_id'] ?>" class="btn btn_03">수정</a></td>
	</tr>
	<?php $i++; }
	if ($i === 0) echo '<tr><td colspan="9" class="empty_table">등록된 굿즈가 없습니다.</td></tr>';
	?>
	</tbody>
	</table>
</div>

<div class="btn_fixed_top">
	<input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_03">
	<input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
	<a href="./jungle_goods_form.php" class="btn btn_01">새 굿즈 등록</a>
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
	if (!cnt) { alert(document.pressed + '할 굿즈를 선택해 주세요.'); return false; }
	if (document.pressed === '선택삭제' && !confirm('선택한 ' + cnt + '개를 정말 삭제하시겠습니까?')) return false;
	f.action = './jungle_goods_list_update.php';
	return true;
}
</script>

<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
