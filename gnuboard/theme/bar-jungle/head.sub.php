<?php
if (!defined('_GNUBOARD_')) exit;
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 공유(오픈그래프)용 절대 주소 : 접속한 도메인 기준으로 만듭니다.
$jungle_scheme = (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') ? 'https' : 'http';
$jungle_host   = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
$jungle_base   = $jungle_scheme.'://'.$jungle_host.G5_URL;
$jungle_og     = $jungle_scheme.'://'.$jungle_host.G5_THEME_URL.'/img/og.jpg';
?><!DOCTYPE html>
<html lang="<?php echo G5_LANG ?>">
<head>
<meta charset="<?php echo G5_CHARSET ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $g5_head_title; ?></title>
	<meta name="description" content="서울 익선동 골목 끝, 도심 속 정글. 시그니처 칵테일과 늦은 밤의 초록빛 아지트 BAR JUNGLE.">
	<meta property="og:title" content="BAR JUNGLE 바 정글 | 익선동 칵테일 바">
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
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo G5_THEME_URL ?>/img/favicon-32.png">
	<link rel="icon" type="image/svg+xml" href="<?php echo G5_THEME_URL ?>/img/favicon.svg">
	<link rel="apple-touch-icon" href="<?php echo G5_THEME_URL ?>/img/apple-touch-icon.png">
	<meta name="theme-color" content="#0d2317">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Anton&family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&family=Nanum+Pen+Script&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/css/init.css">
	<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/css/layout.css">
<?php if (G5_IS_MOBILE) { ?><meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes"><?php } ?>
<link rel="stylesheet" href="<?php echo G5_URL ?>/css/default.css?ver=<?php echo G5_CSS_VER ?>">
<script src="<?php echo G5_JS_URL ?>/jquery-1.12.4.min.js"></script>
<script src="<?php echo G5_JS_URL ?>/common.js?ver=<?php echo G5_JS_VER ?>"></script>
<script src="<?php echo G5_JS_URL ?>/wrest.js?ver=<?php echo G5_JS_VER ?>"></script>
<!--[if lte IE 8]><script src="<?php echo G5_JS_URL ?>/html5.js"></script><![endif]-->
</head>
<body>
