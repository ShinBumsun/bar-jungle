<?php
if (!defined('_GNUBOARD_')) exit;
include_once(G5_THEME_PATH.'/lib/jungle.lib.php');
include_once(G5_PATH.'/head.sub.php');
?>


<!-- SVG Defs S : 종이컷 스타일 잎사귀 원본 -->
<svg class="svg_defs" aria-hidden="true" focusable="false">
	<defs>
		<path id="lf_blade" d="M-7,0 Q-3,-52 0,-100 Q3,-52 7,0 Z"></path>
		<g id="lf_palm">
			<use href="#lf_blade" transform="rotate(-54) scale(0.86)"></use>
			<use href="#lf_blade" transform="rotate(-36) scale(0.94)"></use>
			<use href="#lf_blade" transform="rotate(-18)"></use>
			<use href="#lf_blade"></use>
			<use href="#lf_blade" transform="rotate(18)"></use>
			<use href="#lf_blade" transform="rotate(36) scale(0.94)"></use>
			<use href="#lf_blade" transform="rotate(54) scale(0.86)"></use>
		</g>
		<g id="lf_oval">
			<path d="M0,0 C-27,-24 -31,-72 0,-106 C31,-72 27,-24 0,0 Z"></path>
			<path d="M0,-8 L0,-94" fill="none" stroke="rgba(0,0,0,0.18)" stroke-width="2.5" stroke-linecap="round"></path>
			<path d="M0,-34 L-16,-52 M0,-34 L16,-52 M0,-58 L-13,-74 M0,-58 L13,-74" fill="none" stroke="rgba(0,0,0,0.12)" stroke-width="2" stroke-linecap="round"></path>
		</g>
		<g id="lf_frond">
			<path d="M-2.5,4 L-2.5,-118 L2.5,-118 L2.5,4 Z"></path>
			<use href="#lf_blade" transform="translate(0,-22) rotate(68) scale(0.44)"></use>
			<use href="#lf_blade" transform="translate(0,-22) rotate(-68) scale(0.44)"></use>
			<use href="#lf_blade" transform="translate(0,-48) rotate(70) scale(0.4)"></use>
			<use href="#lf_blade" transform="translate(0,-48) rotate(-70) scale(0.4)"></use>
			<use href="#lf_blade" transform="translate(0,-72) rotate(72) scale(0.34)"></use>
			<use href="#lf_blade" transform="translate(0,-72) rotate(-72) scale(0.34)"></use>
			<use href="#lf_blade" transform="translate(0,-94) rotate(74) scale(0.26)"></use>
			<use href="#lf_blade" transform="translate(0,-94) rotate(-74) scale(0.26)"></use>
			<use href="#lf_blade" transform="translate(0,-112) scale(0.2)"></use>
		</g>
		<g id="lf_split">
			<path d="M0,0 C-30,-26 -34,-78 0,-112 C34,-78 30,-26 0,0 Z"></path>
			<path d="M-2,-14 L-24,-30 M2,-14 L24,-30 M-2,-44 L-27,-58 M2,-44 L27,-58 M-2,-72 L-21,-84 M2,-72 L21,-84" fill="none" stroke="rgba(0,0,0,0.15)" stroke-width="4" stroke-linecap="round"></path>
		</g>
		<g id="ck1">
<path d="M34,54 L126,54 L84,118 Z" fill="#f7efdd"></path>
							<path d="M46,66 L114,66 L84,110 Z" fill="#e2762c"></path>
							<rect x="77" y="116" width="14" height="48" rx="3" fill="#f7efdd"></rect>
							<rect x="52" y="164" width="64" height="12" rx="6" fill="#f7efdd"></rect>
							<circle cx="118" cy="58" r="15" fill="#c94f5c"></circle>
							<path d="M118,43 L118,73" stroke="#f7efdd" stroke-width="3"></path>
							<path d="M40,40 L40,26 M34,32 L46,32" stroke="#f7efdd" stroke-width="3" stroke-linecap="round"></path>
		</g>
		<g id="ck2">
<path d="M42,62 L118,62 L112,172 C112,180 106,184 98,184 L62,184 C54,184 48,180 48,172 Z" fill="#f7efdd"></path>
							<path d="M50,104 L110,104 L106,168 C106,174 102,177 96,177 L64,177 C58,177 54,174 54,168 Z" fill="#c07a2c"></path>
							<rect x="62" y="112" width="38" height="38" rx="6" transform="rotate(-12 81 131)" fill="#f7efdd" opacity="0.85"></rect>
							<path d="M120,70 C140,64 148,80 138,92" fill="none" stroke="#e8b13a" stroke-width="6" stroke-linecap="round"></path>
							<circle cx="80" cy="52" r="9" fill="#a3562a"></circle>
		</g>
		<g id="ck3">
<path d="M46,66 C34,108 42,158 58,182 L102,182 C118,158 126,108 114,66 Z" fill="#f7efdd"></path>
							<path d="M52,96 C44,130 50,160 60,176 L100,176 C110,160 116,130 108,96 Z" fill="#e5c98c"></path>
							<ellipse cx="80" cy="66" rx="34" ry="10" fill="#f7efdd"></ellipse>
							<path d="M96,60 L120,20" stroke="#c94f5c" stroke-width="7" stroke-linecap="round"></path>
							<path d="M44,54 L64,32 L84,54 Z" fill="#4d8442"></path>
							<circle cx="64" cy="30" r="7" fill="#e8b13a"></circle>
		</g>
		<g id="ck4">
<rect x="52" y="46" width="56" height="140" rx="10" fill="#f7efdd"></rect>
							<path d="M58,86 L102,86 L102,174 C102,178 99,180 95,180 L65,180 C61,180 58,178 58,174 Z" fill="#e8b13a"></path>
							<path d="M58,120 L102,120 L102,150 L58,150 Z" fill="#d9622b"></path>
							<path d="M58,150 L102,150 L102,174 C102,178 99,180 95,180 L65,180 C61,180 58,178 58,174 Z" fill="#c94f5c"></path>
							<path d="M92,50 L112,14" stroke="#4d8442" stroke-width="7" stroke-linecap="round"></path>
							<circle cx="46" cy="62" r="17" fill="#e2762c"></circle>
							<circle cx="46" cy="62" r="9" fill="#f7efdd"></circle>
		</g>
	</defs>
</svg>
<!-- SVG Defs E -->

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
			<li class="dl_item"><a href="#moment" title="Depth_모먼트"><em class="font">05</em><span>모먼트</span><i></i></a></li>
			<li class="dl_item"><a href="#visit" title="Depth_오시는 길"><em class="font">06</em><span>오시는 길</span><i></i></a></li>
		</ul>
	</nav>
	<!-- Depth Nav E -->
