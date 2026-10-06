<?php
$sub_menu = '950200';
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'r');

// 표가 없으면 만들고 메뉴판에 있던 시그니처를 옮겨 온다. 이미 있으면 아무 일도 안 한다.
jungle_sig_setup();

$stx = isset($_GET['stx']) ? trim($_GET['stx']) : '';

$where = " WHERE (1) ";
if ($stx !== '') {
	$k = sql_escape_string($stx);
	$where .= " AND (jm_name_ko LIKE '%$k%' OR jm_name_en LIKE '%$k%' OR jm_name_ja LIKE '%$k%') ";
}

$total_count = 0;
$row = sql_fetch(" SELECT COUNT(*) AS cnt FROM ".G5_JUNGLE_SIG_TABLE." $where ", false);
if ($row) $total_count = (int)$row['cnt'];

$card_count = 0;
$row = sql_fetch(" SELECT COUNT(*) AS cnt FROM ".G5_JUNGLE_SIG_TABLE." WHERE jm_card = 1 AND jm_use = 1 ", false);
if ($row) $card_count = (int)$row['cnt'];

$result = sql_query(" SELECT * FROM ".G5_JUNGLE_SIG_TABLE." $where ORDER BY jm_order ASC, jm_id ASC ", false);

$g5['title'] = '시그니처 관리';
include_once(G5_ADMIN_PATH.'/admin.head.php');
?>

<div class="local_desc01 local_desc">
	<p>
		여기에 등록한 칵테일은 메인 화면 <b>SIGNATURE 섹션</b>과 메뉴판의 <b>SIGNATURE 탭</b>에 함께 나갑니다.
		메뉴판에는 올리되 메인 카드로는 띄우지 않으려면 <b>메인 카드</b>를 꺼 두세요.
	</p>
</div>

<div class="local_ov01 local_ov">
	<span class="btn_ov01"><span class="ov_txt">등록된 시그니처</span><span class="ov_num"> <?php echo number_format($total_count) ?>건</span></span>
	<span class="btn_ov01"><span class="ov_txt">메인 카드로 노출</span><span class="ov_num"> <?php echo number_format($card_count) ?>건</span></span>
	<a href="./jungle_sig_form.php" class="ov_listall">새 시그니처 등록</a>
</div>

<form id="fsearch" name="fsearch" method="get">
<div class="local_sch01 local_sch">
	<label for="stx" class="sound_only">검색어</label>
	<input type="text" name="stx" value="<?php echo get_text($stx) ?>" id="stx" class="frm_input" placeholder="이름으로 검색">
	<input type="submit" class="btn_submit" value="검색">
</div>
</form>

<form name="flist" id="flist" action="./jungle_sig_list_update.php" onsubmit="return flist_submit(this);" method="post">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>시그니처 칵테일 목록</caption>
	<thead>
	<tr>
		<th scope="col"><input type="checkbox" id="chkall" onclick="check_all(this.form)"><label for="chkall" class="sound_only">전체선택</label></th>
		<th scope="col">한글명</th>
		<th scope="col">영문명</th>
		<th scope="col">일본어명</th>
		<th scope="col">가격</th>
		<th scope="col">도수</th>
		<th scope="col">설명(한/영/일)</th>
		<th scope="col">사진</th>
		<th scope="col">메인 카드</th>
		<th scope="col">순서</th>
		<th scope="col">노출</th>
		<th scope="col">관리</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$i = 0;
	while ($row = sql_fetch_array($result)) {
	?>
	<tr class="bg<?php echo $i % 2 ?>">
		<td class="td_chk">
			<input type="hidden" name="jm_id[<?php echo $i ?>]" value="<?php echo $row['jm_id'] ?>">
			<input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
			<label for="chk_<?php echo $i ?>" class="sound_only"><?php echo get_text($row['jm_name_ko']) ?></label>
		</td>
		<td><a href="./jungle_sig_form.php?w=u&amp;jm_id=<?php echo $row['jm_id'] ?>"><?php echo get_text($row['jm_name_ko']) ?></a></td>
		<td><?php echo get_text($row['jm_name_en']) ?></td>
		<td><?php echo $row['jm_name_ja'] ? get_text($row['jm_name_ja']) : '<span style="color:#c33">미입력</span>' ?></td>
		<td class="td_num"><?php echo get_text($row['jm_price']) ?></td>
		<td class="td_num"><?php echo $row['jm_alc'] ? $row['jm_alc'].'/5' : '-' ?></td>
		<td class="td_num">
			<?php
			$mark = '';
			foreach (array('ko' => '한', 'en' => '영', 'ja' => '일') as $lc => $kr) {
				$has = trim($row['jm_desc_'.$lc]) !== '';
				$mark .= '<span style="color:'.($has ? '#2f7346' : '#ccc').'">'.$kr.'</span> ';
			}
			echo $mark;
			?>
		</td>
		<td class="td_category">
			<?php
			$im = isset($row['jm_image']) ? trim($row['jm_image']) : '';
			if ($im !== '' && is_file(jungle_sig_dir().'/'.$im)) {
				echo '<img src="'.jungle_sig_url().'/'.rawurlencode($im).'" alt="" style="width:64px;height:48px;object-fit:cover;border:1px solid #ccc;vertical-align:middle">';
			} else {
				echo '<span style="color:#c33">없음</span>';
			}
			?>
		</td>
		<td class="td_num"><?php echo $row['jm_card'] ? '<b style="color:#2f7346">O</b>' : '-' ?></td>
		<td class="td_num"><input type="text" name="jm_order[<?php echo $i ?>]" value="<?php echo $row['jm_order'] ?>" class="frm_input" size="3"></td>
		<td class="td_chk"><input type="checkbox" name="jm_use[<?php echo $i ?>]" value="1"<?php echo $row['jm_use'] ? ' checked' : '' ?>></td>
		<td class="td_mng td_mng_s">
			<a href="./jungle_sig_form.php?w=u&amp;jm_id=<?php echo $row['jm_id'] ?>" class="btn btn_03">수정</a>
		</td>
	</tr>
	<?php
		$i++;
	}
	if ($i === 0) echo '<tr><td colspan="12" class="empty_table">등록된 시그니처가 없습니다.</td></tr>';
	?>
	</tbody>
	</table>
</div>

<div class="btn_fixed_top">
	<input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_03">
	<input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
	<a href="./jungle_sig_form.php" class="btn btn_01">새 시그니처 등록</a>
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
	if (!cnt) { alert(document.pressed + '할 항목을 선택해 주세요.'); return false; }
	if (document.pressed === '선택삭제' && !confirm('선택한 ' + cnt + '건을 정말 삭제하시겠습니까?')) return false;
	f.action = './jungle_sig_list_update.php';
	return true;
}
</script>

<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
