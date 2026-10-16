<?php
$sub_menu = '950600';
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'r');
jungle_roulette_setup();

$w     = isset($_GET['w']) ? $_GET['w'] : '';
$jr_id = isset($_GET['jr_id']) ? (int)$_GET['jr_id'] : 0;

$jr = array('jr_id'=>0,'jr_order'=>0,'jr_name'=>'','jr_rate'=>10,'jr_image'=>'','jr_msg'=>'','jr_use'=>1);

if ($w === 'u') {
	$row = sql_fetch(" SELECT * FROM ".G5_JUNGLE_ROULETTE_TABLE." WHERE jr_id = '$jr_id' ", false);
	if (!$row || !$row['jr_id']) alert('존재하지 않는 칸입니다.', './jungle_roulette.php');
	$jr = $row;
}

$g5['title'] = '룰렛 칸 '.($w === 'u' ? '수정' : '등록');
include_once(G5_ADMIN_PATH.'/admin.head.php');
?>

<form name="froulette" action="./jungle_roulette_form_update.php" onsubmit="return froulette_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="token" value="">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="jr_id" value="<?php echo $jr['jr_id'] ?>">

<div class="tbl_frm01 tbl_wrap">
	<table>
	<caption>룰렛 칸 <?php echo $w === 'u' ? '수정' : '등록' ?></caption>
	<colgroup><col class="grid_4"><col></colgroup>
	<tbody>
	<tr>
		<th scope="row"><label for="jr_name">상품명 <strong class="sound_only">필수</strong></label></th>
		<td>
			<input type="text" name="jr_name" value="<?php echo get_text($jr['jr_name']) ?>" id="jr_name" required class="frm_input required" size="40" maxlength="100">
			<span class="frm_info">룰렛 칸에 적히는 이름입니다. 짧을수록 잘 보입니다. 꽝이면 '다음 기회에!' 처럼 적으시면 됩니다.</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jr_rate">확률 <strong class="sound_only">필수</strong></label></th>
		<td>
			<input type="number" name="jr_rate" value="<?php echo (int)$jr['jr_rate'] ?>" id="jr_rate" required class="frm_input required" size="8" min="0" max="100000">
			<span class="frm_info">
				전체 합으로 나눈 몫이 실제 확률입니다. 합이 100 이 아니어도 됩니다.<br>
				예: 15 / 10 / 5 / 70 이면 각각 15% / 10% / 5% / 70%.<br>
				0 으로 두면 뽑히지 않습니다. 룰렛 칸 크기도 이 값에 따라 커지고 작아집니다.
			</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jr_image">당첨 이미지</label></th>
		<td>
<?php $cur = trim($jr['jr_image']); if ($cur !== '' && is_file(jungle_roulette_dir().'/'.$cur)) { ?>
			<p style="margin:0 0 10px"><img src="<?php echo jungle_roulette_url().'/'.rawurlencode($cur) ?>?<?php echo @filemtime(jungle_roulette_dir().'/'.$cur) ?>" alt="올린 그림" style="width:180px;height:180px;object-fit:cover;border:2px solid #241f18"></p>
<?php } ?>
			<input type="file" name="jr_image" id="jr_image" accept="image/jpeg,image/png,image/webp">
			<span class="frm_info">당첨됐을 때 보여 주는 그림입니다. 정사각으로 잘려 나갑니다. 꽝 칸은 비워 두셔도 됩니다.<br>jpg·png·webp, 8MB 까지.</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jr_msg">당첨 시 나오는 말</label></th>
		<td>
			<input type="text" name="jr_msg" value="<?php echo get_text($jr['jr_msg']) ?>" id="jr_msg" class="frm_input" size="70" maxlength="255">
			<span class="frm_info">그림 아래에 한 줄로 나옵니다. 예: 코스터 2개 당첨! 직원에게 보여 주세요.</span>
		</td>
	</tr>
	<tr>
		<th scope="row"><label for="jr_order">순서</label></th>
		<td><input type="text" name="jr_order" value="<?php echo (int)$jr['jr_order'] ?>" id="jr_order" class="frm_input" size="5"><span class="frm_info">룰렛에서 시계 방향으로 놓이는 차례입니다.</span></td>
	</tr>
	<tr>
		<th scope="row"><label for="jr_use">사용</label></th>
		<td>
			<input type="checkbox" name="jr_use" value="1" id="jr_use"<?php echo $jr['jr_use'] ? ' checked' : '' ?>>
			<label for="jr_use">룰렛에 넣기</label>
			<span class="frm_info">끄면 룰렛에서 빠지고 뽑히지도 않습니다. 다 떨어진 상품에 쓰세요.</span>
		</td>
	</tr>
	</tbody>
	</table>
</div>

<div class="btn_fixed_top">
	<a href="./jungle_roulette.php" class="btn btn_02">목록</a>
	<input type="submit" value="저장" class="btn btn_submit">
</div>
</form>

<script>
function froulette_submit(f) {
	if (!f.jr_name.value.replace(/\s/g, '')) { alert('상품명을 입력해 주세요.'); f.jr_name.focus(); return false; }
	if (f.jr_rate.value === '' || Number(f.jr_rate.value) < 0) { alert('확률은 0 이상 숫자로 적어 주세요.'); f.jr_rate.focus(); return false; }
	return true;
}
</script>

<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
