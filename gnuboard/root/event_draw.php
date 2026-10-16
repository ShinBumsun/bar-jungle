<?php
/**
 * 룰렛 한 번 뽑기. 결과만 JSON 으로 돌려줍니다.
 * 뽑는 일을 화면 쪽에 두면 개발자도구로 열어 원하는 것을 고를 수 있어
 * 여기서만 뽑습니다. 화면은 받은 결과에 맞춰 돌리기만 합니다.
 */
include_once('./common.php');

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

$rows = jungle_roulette_rows(true);
if (!count($rows)) {
	echo json_encode(array('ok' => false, 'msg' => '준비된 상품이 없습니다.'), JSON_UNESCAPED_UNICODE);
	exit;
}

$id = jungle_roulette_draw();
$hit = null; $idx = -1;
foreach ($rows as $i => $r) {
	if ((int)$r['jr_id'] === $id) { $hit = $r; $idx = $i; break; }
}
if (!$hit) {
	echo json_encode(array('ok' => false, 'msg' => '다시 시도해 주세요.'), JSON_UNESCAPED_UNICODE);
	exit;
}

$img = trim($hit['jr_image']);
$src = ($img !== '' && is_file(jungle_roulette_dir().'/'.$img))
     ? jungle_roulette_url().'/'.rawurlencode($img) : '';

$seg = jungle_roulette_segments($rows);

echo json_encode(array(
	'ok'    => true,
	'index' => $idx,                                                   // 몇 번째 칸인지
	'mid'   => round(jungle_roulette_stop_angle($seg, $idx), 3),       // 멈출 각도(12시 기준)
	'name'  => $hit['jr_name'],
	'msg'   => $hit['jr_msg'],
	'image' => $src,
), JSON_UNESCAPED_UNICODE);
