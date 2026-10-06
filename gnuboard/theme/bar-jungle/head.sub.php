<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$g5_debug['php']['begin_time'] = $begin_time = get_microtime();

if (!isset($g5['title'])) {
	$g5['title'] = $config['cf_title'];
	$g5_head_title = $g5['title'];
} else {
	$g5_head_title = implode(' | ', array_filter(array($g5['title'], $config['cf_title'])));
}
$g5['title'] = strip_tags($g5['title']);
$g5_head_title = strip_tags($g5_head_title);

// 현재 접속자
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location']) $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';

// 공유(오픈그래프)용 절대 주소
// G5_URL 은 설치에 따라 모양이 다르다. 이 서버의 g5_path() 는 'https://호스트/경로'
// 처럼 절대주소를 만들지만, G5_DOMAIN 을 비워 둔 다른 설치에서는 경로만 들어온다.
// 그래서 이미 절대주소면 그대로 쓰고, 아닐 때만 접속한 도메인을 앞에 붙인다.
// (앞서 무조건 붙이는 바람에 호스트가 두 번 들어가 공유 미리보기가 깨져 있었다.)
$jungle_origin = '';
if (!preg_match('#^https?://#i', G5_URL)) {
	$jungle_scheme = (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') ? 'https' : 'http';
	$jungle_host   = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
	$jungle_origin = $jungle_host ? $jungle_scheme.'://'.$jungle_host : '';
}
$jungle_base   = rtrim($jungle_origin.G5_URL, '/');
$jungle_og     = $jungle_origin.G5_THEME_URL.'/img/og.jpg';
$jungle_ver    = '1.0.20';
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $g5_head_title; ?></title>
<meta name="description" content="서울 익선동 골목 끝, 도심 속 정글. 시그니처 칵테일과 늦은 밤의 초록빛 아지트 BAR JUNGLE.">
<meta property="og:title" content="<?php echo $g5_head_title; ?>">
<meta property="og:description" content="풀숲을 헤치고 들어오세요. 서울 익선동 칵테일 바 BAR JUNGLE.">
<meta property="og:type" content="website">
<meta property="og:site_name" content="BAR JUNGLE">
<meta property="og:locale" content="ko_KR">
<meta property="og:url" content="<?php echo $jungle_base ?>/">
<meta property="og:image" content="<?php echo $jungle_og ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="정글 속 호랑이와 칵테일 일러스트, BAR JUNGLE">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="<?php echo $jungle_og ?>">
<?php /* 아이콘은 정글로고(호랑이)에서 땄습니다. 작은 크기는 얼굴만 바짝 잘라
         또렷하게, 큰 크기는 머리 전체가 로고답게 보이도록 따로 떴습니다.
         svg 는 더 쓰지 않습니다. 브라우저가 svg 를 먼저 고르기 때문에
         크기별로 다른 그림을 줄 수 없습니다. */ ?>
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo G5_THEME_URL ?>/img/favicon-16.png?v=<?php echo $jungle_ver ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo G5_THEME_URL ?>/img/favicon-32.png?v=<?php echo $jungle_ver ?>">
<link rel="icon" type="image/png" sizes="192x192" href="<?php echo G5_THEME_URL ?>/img/favicon-192.png?v=<?php echo $jungle_ver ?>">
<link rel="apple-touch-icon" href="<?php echo G5_THEME_URL ?>/img/apple-touch-icon.png?v=<?php echo $jungle_ver ?>">
<meta name="theme-color" content="#0d2317">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&family=Nanum+Pen+Script&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/css/init.css?v=<?php echo $jungle_ver ?>">
<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/css/layout.css?v=<?php echo $jungle_ver ?>">
<?php
if ($config['cf_add_meta']) echo $config['cf_add_meta'].PHP_EOL;
?>
<script>
/* 화면 높이 고정
   모바일에서 주소창이 접히고 펴지면 보이는 높이가 계속 바뀐다. 그대로 두면
   섹션 높이가 따라 움직여 화면이 들썩이므로, 처음 잰 값을 --vh 에 박아 두고
   가로폭이나 방향이 실제로 바뀔 때만 다시 잰다. 첫 페인트 전에 정해야
   깜빡임이 없어서 CSS 바로 뒤에 인라인으로 둔다. */
(function () {
	var de = document.documentElement, lastW = -1;
	/* 주소창이 있는 건 터치 기기뿐이다. 데스크톱은 창을 세로로 줄이면
	   그대로 따라가야 하므로 고정하지 않는다. */
	var touch = window.matchMedia && window.matchMedia('(pointer: coarse)').matches;
	function pin(force) {
		var w = window.innerWidth, h = window.innerHeight;
		if (!h) { return; }
		if (touch && !force && w === lastW) { return; }	/* 높이만 바뀐 건 주소창이므로 무시 */
		lastW = w;
		de.style.setProperty('--vh', (h / 100) + 'px');
	}
	pin(true);
	window.addEventListener('resize', function () { pin(false); }, { passive: true });
	window.addEventListener('orientationchange', function () {
		window.setTimeout(function () { pin(true); }, 260);
	}, { passive: true });
})();
</script>
<script>
// 그누보드 자바스크립트 전역변수
var g5_url       = "<?php echo G5_URL ?>";
var g5_bbs_url   = "<?php echo G5_BBS_URL ?>";
var g5_is_member = "<?php echo isset($is_member) ? $is_member : '' ?>";
var g5_is_admin  = "<?php echo isset($is_admin) ? $is_admin : '' ?>";
var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
var g5_bo_table  = "<?php echo isset($bo_table) ? $bo_table : '' ?>";
var g5_sca       = "<?php echo isset($sca) ? $sca : '' ?>";
var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
</script>
<?php
add_javascript('<script src="'.G5_JS_URL.'/jquery-1.12.4.min.js"></script>', 0);
add_javascript('<script src="'.G5_JS_URL.'/jquery-migrate-1.4.1.min.js"></script>', 0);
add_javascript('<script src="'.G5_JS_URL.'/common.js"></script>', 0);
add_javascript('<script src="'.G5_JS_URL.'/wrest.js"></script>', 0);
if (!defined('G5_IS_ADMIN')) echo $config['cf_add_script'];
?>
</head>
<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?>>
