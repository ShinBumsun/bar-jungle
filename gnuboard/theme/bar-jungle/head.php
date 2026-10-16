<?php
if (!defined('_GNUBOARD_')) exit;
include_once(G5_THEME_PATH.'/lib/jungle.lib.php');
include_once(G5_THEME_PATH.'/head.sub.php');
?>


<?php include_once(G5_THEME_PATH.'/lib/svg_defs.php'); ?>

<div id="wrap">

	<i class="jg_shade" aria-hidden="true"></i>

	<!-- Header S -->
	<header id="header">
		<h1 class="h_logo"><a href="#hero" title="BAR JUNGLE_메인으로"><img src="<?php echo G5_THEME_URL ?>/img/logo_jungle.png" alt="BAR JUNGLE 정글"></a></h1>
		<nav class="h_gnb">
			<ul class="hg_list">
				<li class="hgl_item"><a href="#about" title="Menu_소개"><span data-i18n="nav.about">소개</span></a></li>
				<li class="hgl_item"><a href="#signature" title="Menu_시그니처"><span data-i18n="nav.signature">시그니처</span></a></li>
				<li class="hgl_item"><a href="#menu" title="Menu_메뉴"><span data-i18n="nav.menu">메뉴</span></a></li>
				<li class="hgl_item"><a href="#goods" title="Menu_굿즈"><span data-i18n="nav.goods">굿즈</span></a></li>
				<li class="hgl_item"><a href="#moment" title="Menu_모먼트"><span data-i18n="nav.moment">모먼트</span></a></li>
				<li class="hgl_item"><a href="#visit" title="Menu_오시는 길"><span data-i18n="nav.visit">오시는 길</span></a></li>
			</ul>
		</nav>
		<div class="h_util">
			<div class="h_lang" role="group" aria-label="Language">
				<button type="button" class="hl_btn on" data-lang="ko" title="Language_한국어">KOR</button>
				<button type="button" class="hl_btn" data-lang="en" title="Language_English">ENG</button>
				<button type="button" class="hl_btn" data-lang="ja" title="Language_日本語">JPN</button>
			</div>
			<a href="https://www.instagram.com/jungle_seoul/" class="h_book" target="_blank" rel="noopener" title="Reserve_인스타그램 DM 예약"><span data-i18n="nav.book">예약 DM</span><i></i></a>
		</div>
		<button type="button" class="h_toggle" title="Menu_모바일 메뉴 열기"><i></i><i></i><i></i><span class="blind">메뉴 열기</span></button>
	</header>
	<!-- Header E -->

	<!-- Depth Nav S -->
	<nav id="depth" aria-label="정글 깊이 이동">
		<ul class="d_list">
			<li class="dl_item on"><a href="#hero" title="Depth_입구"><em class="font">01</em><span>입구</span><i></i></a></li>
			<li class="dl_item"><a href="#about" title="Depth_소개"><em class="font">02</em><span>소개</span><i></i></a></li>
			<li class="dl_item"><a href="#signature" title="Depth_시그니처"><em class="font">03</em><span>시그니처</span><i></i></a></li>
			<li class="dl_item"><a href="#menu" title="Depth_메뉴"><em class="font">04</em><span>메뉴</span><i></i></a></li>
			<li class="dl_item"><a href="#goods" title="Depth_굿즈"><em class="font">05</em><span>굿즈</span><i></i></a></li>
			<li class="dl_item"><a href="#moment" title="Depth_모먼트"><em class="font">06</em><span>모먼트</span><i></i></a></li>
			<li class="dl_item"><a href="#visit" title="Depth_오시는 길"><em class="font">07</em><span>오시는 길</span><i></i></a></li>
		</ul>
	</nav>
	<!-- Depth Nav E -->
