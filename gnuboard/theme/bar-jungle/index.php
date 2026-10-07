<?php
if (!defined('_INDEX_')) define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$jungle_site = include(G5_THEME_PATH.'/data/site.php');
$jungle_menu  = jungle_menu_tree();      // 관리자 > 정글 사이트 > 메뉴판 관리
$jungle_cards = jungle_signature_cards();
$jungle_season = jungle_season_rows();   // 시즌 메뉴 : 그림만 걸리는 탭  // 시그니처 섹션에 띄울 카드

include_once(G5_PATH.'/head.php');
?>

<!-- Hero S : 풀숲이 열리며 동물이 등장 -->
	<section id="hero" data-tone="dark">
		<div class="he_sky"></div>

		<!-- 안쪽 깊은 숲 S -->
		<svg class="he_far" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMax slice" aria-hidden="true">
			<g class="lfc0">
				<use href="#lf_palm" transform="translate(90,930) rotate(-14) scale(3.6)"></use>
				<use href="#lf_frond" transform="translate(280,960) rotate(8) scale(3.2)"></use>
				<use href="#lf_oval" transform="translate(470,940) rotate(-9) scale(3)"></use>
				<use href="#lf_palm" transform="translate(660,975) rotate(6) scale(3.3)"></use>
				<use href="#lf_frond" transform="translate(880,960) rotate(-7) scale(3)"></use>
				<use href="#lf_oval" transform="translate(1080,945) rotate(11) scale(3.1)"></use>
				<use href="#lf_palm" transform="translate(1290,965) rotate(-5) scale(3.4)"></use>
				<use href="#lf_frond" transform="translate(1490,935) rotate(13) scale(3.2)"></use>
			</g>
			<g class="lfc1">
				<use href="#lf_oval" transform="translate(180,975) rotate(16) scale(2.6)"></use>
				<use href="#lf_palm" transform="translate(400,990) rotate(-11) scale(2.5)"></use>
				<use href="#lf_oval" transform="translate(770,985) rotate(9) scale(2.4)"></use>
				<use href="#lf_palm" transform="translate(1180,995) rotate(-13) scale(2.6)"></use>
				<use href="#lf_oval" transform="translate(1400,980) rotate(7) scale(2.5)"></use>
			</g>
		</svg>
		<!-- 안쪽 깊은 숲 E -->

		<!-- 동물 등장 S -->
		<div class="he_animals">

			<div class="hea_item snake" data-animal="snake">
				<svg viewBox="0 0 200 200" aria-hidden="true">
					<path d="M44,186 C44,146 92,150 96,116 C100,82 58,76 60,50 C62,30 88,22 110,32" fill="none" stroke="#4d8442" stroke-width="27" stroke-linecap="round"></path>
					<path d="M44,186 C44,146 92,150 96,116 C100,82 58,76 60,50 C62,30 88,22 110,32" fill="none" stroke="#a9c95d" stroke-width="10" stroke-linecap="round" stroke-dasharray="3 21"></path>
					<ellipse cx="122" cy="42" rx="27" ry="21" transform="rotate(24 122 42)" fill="#4d8442"></ellipse>
					<circle cx="128" cy="34" r="5.5" fill="#241f18"></circle>
					<circle cx="130" cy="32.5" r="1.8" fill="#f7efdd"></circle>
					<path d="M147,52 L166,60 M166,60 L178,54 M166,60 L177,67" fill="none" stroke="#c94f5c" stroke-width="4" stroke-linecap="round"></path>
				</svg>
			</div>

			<div class="hea_item lion" data-animal="lion">
				<svg viewBox="0 0 200 200" aria-hidden="true">
					<g fill="#a3562a">
						<circle cx="162" cy="100" r="21"></circle><circle cx="153.7" cy="131" r="21"></circle><circle cx="131" cy="153.7" r="21"></circle><circle cx="100" cy="162" r="21"></circle><circle cx="69" cy="153.7" r="21"></circle><circle cx="46.3" cy="131" r="21"></circle><circle cx="38" cy="100" r="21"></circle><circle cx="46.3" cy="69" r="21"></circle><circle cx="69" cy="46.3" r="21"></circle><circle cx="100" cy="38" r="21"></circle><circle cx="131" cy="46.3" r="21"></circle><circle cx="153.7" cy="69" r="21"></circle>
					</g>
					<circle cx="100" cy="100" r="54" fill="#c76a2f"></circle>
					<circle cx="64" cy="74" r="14" fill="#eda94f"></circle><circle cx="136" cy="74" r="14" fill="#eda94f"></circle>
					<circle cx="64" cy="74" r="7" fill="#a3562a"></circle><circle cx="136" cy="74" r="7" fill="#a3562a"></circle>
					<ellipse cx="100" cy="104" rx="41" ry="39" fill="#eda94f"></ellipse>
					<circle cx="87" cy="124" r="17" fill="#f7efdd"></circle><circle cx="113" cy="124" r="17" fill="#f7efdd"></circle>
					<ellipse cx="85" cy="99" rx="6.5" ry="8" fill="#241f18"></ellipse><ellipse cx="115" cy="99" rx="6.5" ry="8" fill="#241f18"></ellipse>
					<circle cx="87" cy="96" r="2.2" fill="#f7efdd"></circle><circle cx="117" cy="96" r="2.2" fill="#f7efdd"></circle>
					<path d="M91,112 L109,112 L100,122 Z" fill="#c94f5c" stroke="#c94f5c" stroke-width="4" stroke-linejoin="round"></path>
					<path d="M100,124 L100,129 M100,129 Q92,137 85,130 M100,129 Q108,137 115,130" fill="none" stroke="#241f18" stroke-width="3" stroke-linecap="round"></path>
				</svg>
			</div>

			<div class="hea_item tiger" data-animal="tiger">
				<svg viewBox="0 0 200 200" aria-hidden="true">
					<circle cx="50" cy="62" r="27" fill="#d9622b"></circle><circle cx="150" cy="62" r="27" fill="#d9622b"></circle>
					<circle cx="50" cy="62" r="14" fill="#2a231c"></circle><circle cx="150" cy="62" r="14" fill="#2a231c"></circle>
					<ellipse cx="100" cy="106" rx="62" ry="58" fill="#e2762c"></ellipse>
					<g fill="#2a231c">
						<path d="M96,50 L104,50 L107,80 L93,80 Z"></path>
						<path d="M74,56 L82,54 L88,82 L78,84 Z"></path>
						<path d="M126,56 L118,54 L112,82 L122,84 Z"></path>
						<path d="M38,96 L62,102 L62,110 L36,106 Z"></path>
						<path d="M40,118 L60,121 L59,129 L39,127 Z"></path>
						<path d="M162,96 L138,102 L138,110 L164,106 Z"></path>
						<path d="M160,118 L140,121 L141,129 L161,127 Z"></path>
					</g>
					<ellipse cx="100" cy="128" rx="46" ry="33" fill="#f7efdd"></ellipse>
					<ellipse cx="78" cy="105" rx="9" ry="10.5" fill="#241f18"></ellipse><ellipse cx="122" cy="105" rx="9" ry="10.5" fill="#241f18"></ellipse>
					<circle cx="81" cy="101" r="3" fill="#f7efdd"></circle><circle cx="125" cy="101" r="3" fill="#f7efdd"></circle>
					<path d="M91,126 L109,126 L100,137 Z" fill="#c94f5c" stroke="#c94f5c" stroke-width="4" stroke-linejoin="round"></path>
					<path d="M100,139 L100,144 M100,144 Q91,153 83,145 M100,144 Q109,153 117,145" fill="none" stroke="#241f18" stroke-width="3.2" stroke-linecap="round"></path>
					<path d="M56,130 L26,124 M56,138 L26,140 M144,130 L174,124 M144,138 L174,140" fill="none" stroke="#241f18" stroke-width="2" stroke-linecap="round" opacity="0.55"></path>
				</svg>
			</div>

			<div class="hea_item monkey" data-animal="monkey">
				<svg viewBox="0 0 200 200" aria-hidden="true">
					<circle cx="40" cy="100" r="25" fill="#8a5a3c"></circle><circle cx="160" cy="100" r="25" fill="#8a5a3c"></circle>
					<circle cx="40" cy="100" r="13" fill="#d9a476"></circle><circle cx="160" cy="100" r="13" fill="#d9a476"></circle>
					<ellipse cx="100" cy="100" rx="58" ry="55" fill="#8a5a3c"></ellipse>
					<path d="M100,58 C136,58 150,88 148,116 C146,146 126,160 100,160 C74,160 54,146 52,116 C50,88 64,58 100,58 Z" fill="#e3b088"></path>
					<circle cx="84" cy="102" r="7" fill="#241f18"></circle><circle cx="116" cy="102" r="7" fill="#241f18"></circle>
					<circle cx="86.5" cy="99" r="2.4" fill="#f7efdd"></circle><circle cx="118.5" cy="99" r="2.4" fill="#f7efdd"></circle>
					<ellipse cx="93" cy="124" rx="3.4" ry="4.4" fill="#8a5a3c"></ellipse><ellipse cx="107" cy="124" rx="3.4" ry="4.4" fill="#8a5a3c"></ellipse>
					<path d="M84,136 Q100,150 116,136" fill="none" stroke="#8a5a3c" stroke-width="4" stroke-linecap="round"></path>
					<path d="M74,60 Q86,44 100,54 Q114,44 126,60" fill="none" stroke="#6d4630" stroke-width="7" stroke-linecap="round"></path>
				</svg>
			</div>

			<div class="hea_item toucan" data-animal="toucan">
				<svg viewBox="0 0 200 200" aria-hidden="true">
					<ellipse cx="118" cy="122" rx="47" ry="55" fill="#241f18"></ellipse>
					<path d="M92,64 C118,64 132,84 132,104 C132,126 116,140 96,140 C74,140 62,122 62,102 C62,80 72,64 92,64 Z" fill="#f7efdd"></path>
					<path d="M74,88 C46,74 20,86 16,102 C12,120 44,124 72,112 Z" fill="#e8b13a"></path>
					<path d="M74,104 C50,110 28,110 16,102 C12,120 44,124 72,112 Z" fill="#d9622b"></path>
					<path d="M74,88 C46,74 20,86 16,102" fill="none" stroke="#241f18" stroke-width="3" stroke-linecap="round"></path>
					<circle cx="94" cy="86" r="9" fill="#e8b13a"></circle>
					<circle cx="94" cy="86" r="5" fill="#241f18"></circle>
					<circle cx="96" cy="83.5" r="1.8" fill="#f7efdd"></circle>
					<path d="M130,110 C154,112 160,140 146,158 C132,152 126,130 130,110 Z" fill="#4d8442"></path>
					<path d="M104,172 L100,190 M126,176 L128,192" fill="none" stroke="#e8b13a" stroke-width="6" stroke-linecap="round"></path>
				</svg>
			</div>


			<div class="hea_drink d_snake"><svg viewBox="0 0 160 200" aria-hidden="true"><use href="#ck6"></use></svg></div>
			<div class="hea_drink d_lion"><svg viewBox="0 0 160 200" aria-hidden="true"><use href="#ck2"></use></svg></div>
			<div class="hea_drink d_tiger"><svg viewBox="0 0 160 200" aria-hidden="true"><use href="#ck4"></use></svg></div>
			<div class="hea_drink d_monkey"><svg viewBox="0 0 160 200" aria-hidden="true"><use href="#ck3"></use></svg></div>
			<div class="hea_drink d_toucan"><svg viewBox="0 0 160 200" aria-hidden="true"><use href="#ck1"></use></svg></div>
		</div>
		<!-- 동물 등장 E -->

		<!-- 히어로 타이틀 S -->
		<div class="he_title">
			<p class="het_eyebrow"><i></i><span>SEOUL · JONG-NO</span><i></i></p>
			<h2 class="het_logo"><img src="<?php echo G5_THEME_URL ?>/img/logo_jungle.png" alt="BAR JUNGLE 정글"></h2>
			<p class="het_sub" data-i18n="hero.sub">풀숲을 헤치면, 도심 한가운데 정글</p>
			<div class="het_row">
				<p class="het_pride">
					<svg class="hp_bow" viewBox="0 0 38 21" aria-hidden="true">
						<g fill="none" stroke-width="2.4" stroke-linecap="round">
								<path d="M3,19.5 A16,16 0 0 1 35,19.5" stroke="#e2524a"></path>
								<path d="M5.6,19.5 A13.4,13.4 0 0 1 32.4,19.5" stroke="#e8923a"></path>
								<path d="M8.2,19.5 A10.8,10.8 0 0 1 29.8,19.5" stroke="#e8c93a"></path>
								<path d="M10.8,19.5 A8.2,8.2 0 0 1 27.2,19.5" stroke="#5aa85a"></path>
								<path d="M13.4,19.5 A5.6,5.6 0 0 1 24.6,19.5" stroke="#3f7fd0"></path>
								<path d="M16,19.5 A3,3 0 0 1 22,19.5" stroke="#8f55c8"></path>
						</g>
					</svg>
					<span class="font">PRIDE MEMBERSHIP BAR</span>
				</p>
			</div>
			<p class="het_igrow"><a href="<?php echo $jungle_site['instagram'] ?>" class="het_ig font" target="_blank" rel="noopener" title="Instagram_인스타그램">@JUNGLE_SEOUL</a></p>
		</div>
		<!-- 히어로 타이틀 E -->

		<!-- 앞쪽 풀숲(좌우로 열림) S -->
		<div class="he_bush">
			<svg class="heb_leaf heb_l2" viewBox="0 0 600 1000" preserveAspectRatio="xMinYMax slice" aria-hidden="true">
				<g class="lfc2">
					<use href="#lf_palm" transform="translate(60,1010) rotate(14) scale(3.4)"></use>
					<use href="#lf_oval" transform="translate(210,1020) rotate(30) scale(3.2)"></use>
					<use href="#lf_frond" transform="translate(-10,820) rotate(38) scale(3)"></use>
					<use href="#lf_split" transform="translate(300,960) rotate(18) scale(2.9)"></use>
					<use href="#lf_palm" transform="translate(120,700) rotate(46) scale(2.8)"></use>
					<use href="#lf_oval" transform="translate(-30,540) rotate(58) scale(2.7)"></use>
					<use href="#lf_frond" transform="translate(160,420) rotate(62) scale(2.6)"></use>
					<use href="#lf_palm" transform="translate(-20,240) rotate(74) scale(2.6)"></use>
					<use href="#lf_oval" transform="translate(90,110) rotate(96) scale(2.4)"></use>
				</g>
			</svg>
			<svg class="heb_leaf heb_r2" viewBox="0 0 600 1000" preserveAspectRatio="xMaxYMax slice" aria-hidden="true">
				<g class="lfc2">
					<use href="#lf_palm" transform="translate(540,1010) rotate(-14) scale(3.4)"></use>
					<use href="#lf_oval" transform="translate(390,1020) rotate(-30) scale(3.2)"></use>
					<use href="#lf_frond" transform="translate(610,820) rotate(-38) scale(3)"></use>
					<use href="#lf_split" transform="translate(300,960) rotate(-18) scale(2.9)"></use>
					<use href="#lf_palm" transform="translate(480,700) rotate(-46) scale(2.8)"></use>
					<use href="#lf_oval" transform="translate(630,540) rotate(-58) scale(2.7)"></use>
					<use href="#lf_frond" transform="translate(440,420) rotate(-62) scale(2.6)"></use>
					<use href="#lf_palm" transform="translate(620,240) rotate(-74) scale(2.6)"></use>
					<use href="#lf_oval" transform="translate(510,110) rotate(-96) scale(2.4)"></use>
				</g>
			</svg>
			<svg class="heb_leaf heb_l1" viewBox="0 0 600 1000" preserveAspectRatio="xMinYMax slice" aria-hidden="true">
				<g class="lfc3">
					<use href="#lf_split" transform="translate(120,1030) rotate(10) scale(4.2)"></use>
					<use href="#lf_palm" transform="translate(330,1040) rotate(26) scale(4)"></use>
					<use href="#lf_oval" transform="translate(-20,900) rotate(34) scale(3.8)"></use>
					<use href="#lf_frond" transform="translate(240,760) rotate(40) scale(3.6)"></use>
					<use href="#lf_split" transform="translate(30,620) rotate(52) scale(3.5)"></use>
					<use href="#lf_palm" transform="translate(260,470) rotate(58) scale(3.4)"></use>
					<use href="#lf_oval" transform="translate(-40,340) rotate(70) scale(3.3)"></use>
					<use href="#lf_frond" transform="translate(190,180) rotate(84) scale(3.2)"></use>
					<use href="#lf_palm" transform="translate(-10,40) rotate(104) scale(3)"></use>
				</g>
				<g class="lfc4">
					<use href="#lf_oval" transform="translate(200,1000) rotate(-4) scale(2.6)"></use>
					<use href="#lf_frond" transform="translate(60,780) rotate(24) scale(2.4)"></use>
					<use href="#lf_oval" transform="translate(300,560) rotate(44) scale(2.3)"></use>
					<use href="#lf_frond" transform="translate(80,300) rotate(76) scale(2.2)"></use>
				</g>
			</svg>
			<svg class="heb_leaf heb_r1" viewBox="0 0 600 1000" preserveAspectRatio="xMaxYMax slice" aria-hidden="true">
				<g class="lfc3">
					<use href="#lf_split" transform="translate(480,1030) rotate(-10) scale(4.2)"></use>
					<use href="#lf_palm" transform="translate(270,1040) rotate(-26) scale(4)"></use>
					<use href="#lf_oval" transform="translate(620,900) rotate(-34) scale(3.8)"></use>
					<use href="#lf_frond" transform="translate(360,760) rotate(-40) scale(3.6)"></use>
					<use href="#lf_split" transform="translate(570,620) rotate(-52) scale(3.5)"></use>
					<use href="#lf_palm" transform="translate(340,470) rotate(-58) scale(3.4)"></use>
					<use href="#lf_oval" transform="translate(640,340) rotate(-70) scale(3.3)"></use>
					<use href="#lf_frond" transform="translate(410,180) rotate(-84) scale(3.2)"></use>
					<use href="#lf_palm" transform="translate(610,40) rotate(-104) scale(3)"></use>
				</g>
				<g class="lfc4">
					<use href="#lf_oval" transform="translate(400,1000) rotate(4) scale(2.6)"></use>
					<use href="#lf_frond" transform="translate(540,780) rotate(-24) scale(2.4)"></use>
					<use href="#lf_oval" transform="translate(300,560) rotate(-44) scale(2.3)"></use>
					<use href="#lf_frond" transform="translate(520,300) rotate(-76) scale(2.2)"></use>
				</g>
			</svg>
			<div class="heb_eyes">
				<i class="hebe_pair p1"></i><i class="hebe_pair p2"></i><i class="hebe_pair p3"></i><i class="hebe_pair p4"></i>
			</div>
		</div>
		<!-- 앞쪽 풀숲(좌우로 열림) E -->

		<!-- 바닥 수풀(고정) S -->
		<svg class="he_front" viewBox="0 0 1600 320" preserveAspectRatio="xMidYMax slice" aria-hidden="true">
			<g class="lfc5">
				<use href="#lf_frond" transform="translate(40,340) rotate(-16) scale(2.4)"></use>
				<use href="#lf_palm" transform="translate(190,350) rotate(9) scale(2.2)"></use>
				<use href="#lf_oval" transform="translate(340,345) rotate(-12) scale(2)"></use>
				<use href="#lf_split" transform="translate(500,355) rotate(7) scale(2.1)"></use>
				<use href="#lf_frond" transform="translate(660,340) rotate(-8) scale(2.3)"></use>
				<use href="#lf_palm" transform="translate(830,352) rotate(11) scale(2.2)"></use>
				<use href="#lf_oval" transform="translate(980,344) rotate(-10) scale(2)"></use>
				<use href="#lf_split" transform="translate(1140,356) rotate(6) scale(2.1)"></use>
				<use href="#lf_frond" transform="translate(1300,340) rotate(-13) scale(2.4)"></use>
				<use href="#lf_palm" transform="translate(1470,350) rotate(10) scale(2.2)"></use>
				<use href="#lf_oval" transform="translate(1580,345) rotate(-6) scale(2)"></use>
			</g>
		</svg>
		<!-- 바닥 수풀(고정) E -->

		<a href="#about" class="he_scroll" title="Scroll_아래로 내리기"><span class="font">SCROLL</span><i></i></a>
	</section>
	<!-- Hero E -->

	<!-- About S -->
	<section id="about" class="sec torn" data-veil data-tone="light">
		<!-- 정글 베일 S -->
		<div class="sv_veil" aria-hidden="true">
			<div class="svv_side svv_l">
				<svg class="svl n1" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n2" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n3" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n4" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n5" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n6" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n7" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n8" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n9" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n10" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n11" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n12" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n19" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n20" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n21" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n22" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n13 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n14 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n15 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n16 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n17 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n18 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
			</div>
			<div class="svv_side svv_r">
				<svg class="svl n1" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n2" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n3" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n4" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n5" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n6" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n7" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n8" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n9" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n10" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n11" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n12" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n19" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n20" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n21" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n22" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n13 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n14 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n15 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n16 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n17 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n18 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
			</div>
		</div>
		<!-- 정글 베일 E -->

		<div class="a_wrap">
			<div class="a_deco">
				<svg viewBox="0 0 300 300" aria-hidden="true">
					<mask id="ad_leaf" maskUnits="userSpaceOnUse" x="0" y="0" width="300" height="300">
						<rect width="300" height="300" fill="#000"></rect>
						<path d="M150,46 C196,76 222,124 221,170 C220,218 191,254 150,260 C109,254 80,218 79,170 C78,124 104,76 150,46 Z" fill="#fff"></path>
						<path d="M300,214 L300,254 L162,209 Z M300,187 L300,224 L165,182 Z M300,158 L300,192 L169,153 Z M300,127 L300,157 L174,123 Z M300,98 L300,124 L181,94 Z M0,223 L0,263 L138,218 Z M0,196 L0,233 L135,191 Z M0,167 L0,201 L131,162 Z M0,136 L0,166 L126,132 Z M0,107 L0,133 L119,103 Z" fill="#000"></path>
					</mask>
					<g class="lfc3" transform="rotate(-14 150 160)">
						<rect width="300" height="300" mask="url(#ad_leaf)"></rect>
						<path d="M156,254 C158,270 154,282 147,292 C145,281 146,268 144,255 Z"></path>
					</g>
				</svg>
			</div>
			<p class="a_eyebrow fade f_up" data-i18n="about.eyebrow"><span class="font">ABOUT</span> 정글 안내문</p>
			<h2 class="a_title title t2 cm font2 fade f_up f_delay03" data-i18n="about.title">도심의 소음을 헤치고<br><mark class="cr">초록빛 아지트</mark>로</h2>
			<div class="a_txt fade f_up f_delay06">
				<p class="txt ch" data-i18n="about.p1">익선동 좁은 골목을 몇 번 꺾어 들어오면, 낮에는 보이지 않던 풀숲<br>그 안쪽에 바 정글이 숨어있어요.</p>
				<p class="txt ch" data-i18n="about.p2">우리는 매일 신선한 재료를 손질하고, 잔 하나에 계절을 담습니다.<br>혼자여도 좋고 여럿이도 좋은 자리, 오늘 하루를 정글에 새로 담아보세요.</p>
			</div>
			<!-- 함께하는 공간 안내 S -->
			<div class="a_notice fade f_up f_delay09">
				<svg class="an_bow" viewBox="0 0 38 21" aria-hidden="true">
					<g fill="none" stroke-width="2.4" stroke-linecap="round">
						<path d="M3,19.5 A16,16 0 0 1 35,19.5" stroke="#e2524a"></path>
						<path d="M5.6,19.5 A13.4,13.4 0 0 1 32.4,19.5" stroke="#e8923a"></path>
						<path d="M8.2,19.5 A10.8,10.8 0 0 1 29.8,19.5" stroke="#e8c93a"></path>
						<path d="M10.8,19.5 A8.2,8.2 0 0 1 27.2,19.5" stroke="#5aa85a"></path>
						<path d="M13.4,19.5 A5.6,5.6 0 0 1 24.6,19.5" stroke="#3f7fd0"></path>
						<path d="M16,19.5 A3,3 0 0 1 22,19.5" stroke="#8f55c8"></path>
					</g>
				</svg>
				<strong class="an_tit" data-i18n="about.notice_tit">정글바는 소수자분들을 위한 공간입니다.</strong>
				<p class="an_txt txt normal ch" data-i18n="about.notice">모두가 즐거운 시간을 보낼 수 있도록 공간에 대한 배려를 부탁드립니다.</p>
			</div>
			<!-- 함께하는 공간 안내 E -->
		</div>
	</section>
	<!-- About E -->

	<!-- Signature S -->
	<section id="signature" class="sec torn" data-veil data-tone="light">
		<!-- 정글 베일 S -->
		<div class="sv_veil" aria-hidden="true">
			<div class="svv_side svv_l">
				<svg class="svl n1" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n2" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n3" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n4" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n5" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n6" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n7" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n8" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n9" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n10" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n11" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n12" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n19" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n20" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n21" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n22" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n13 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n14 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n15 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n16 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n17 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n18 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
			</div>
			<div class="svv_side svv_r">
				<svg class="svl n1" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n2" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n3" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n4" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n5" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n6" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n7" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n8" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n9" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n10" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n11" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n12" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n19" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n20" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n21" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n22" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n13 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n14 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n15 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n16 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n17 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n18 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
			</div>
		</div>
		<!-- 정글 베일 E -->

		<div class="s_wrap">
			<p class="s_eyebrow fade f_up" data-i18n="sig.eyebrow"><span class="font">SIGNATURE</span> 오직, 정글에서만</p>
			<h2 class="s_title title t2 cm font2 fade f_up f_delay03" data-i18n="sig.title">시그니처 <mark class="cr">칵테일</mark></h2>
			<div class="s_slider">
				<button type="button" class="ss_nav ss_prev" aria-label="이전 칵테일 보기"><i></i></button>
				<ul class="s_list" tabindex="0">
<?php foreach ($jungle_cards as $ci => $jc) echo jungle_card_item($jc, $ci); ?>
				</ul>
				<button type="button" class="ss_nav ss_next" aria-label="다음 칵테일 보기"><i></i></button>
			</div>
		</div>
	</section>
	<!-- Signature E -->

	<!-- Menu S -->
	<section id="menu" class="sec torn" data-veil data-tone="dark">
		<!-- 정글 베일 S -->
		<div class="sv_veil" aria-hidden="true">
			<div class="svv_side svv_l">
				<svg class="svl n1" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n2" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n3" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n4" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n5" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n6" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n7" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n8" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n9" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n10" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n11" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n12" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n19" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n20" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n21" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n22" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n13 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n14 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n15 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n16 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n17 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n18 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
			</div>
			<div class="svv_side svv_r">
				<svg class="svl n1" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n2" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n3" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n4" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n5" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n6" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n7" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n8" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n9" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n10" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n11" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n12" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n19" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n20" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n21" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n22" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n13 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n14 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n15 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n16 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n17 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n18 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
			</div>
		</div>
		<!-- 정글 베일 E -->

		<div class="m_wrap">
			<div class="m_head">
				<p class="m_eyebrow fade f_up" data-i18n="menu.eyebrow"><span class="font">MENU</span> 오늘의 목록</p>
				<h2 class="m_title title t2 cw font2 fade f_up f_delay03" data-i18n="menu.title">잔 하나에 계절을 담아</h2>
				<p class="m_hand fade f_up f_delay06" data-i18n="menu.note">* 계절과 수급에 따라 메뉴는 조금씩 바뀝니다</p>
			</div>
			<div class="m_body">
<?php
			/* 시즌 탭은 메뉴판 표가 아니라 제 표에서 오므로 따로 앞에 붙인다.
			   올린 그림이 없으면 탭 자체가 나오지 않는다. */
			$has_season = count($jungle_season) > 0;
?>
				<div class="m_tabs fade f_up f_delay03" role="tablist">
<?php if ($has_season) { ?>
					<button type="button" class="mt_btn mt_season on" role="tab" aria-selected="true" aria-controls="pn_season" data-panel="season">SEASON<svg class="mt_star" viewBox="0 0 24 24" aria-hidden="true"><defs><filter id="mt_pencil" x="-30%" y="-30%" width="160%" height="160%"><feTurbulence type="fractalNoise" baseFrequency="0.85" numOctaves="3" seed="11" result="n"></feTurbulence><feDisplacementMap in="SourceGraphic" in2="n" scale="1" xChannelSelector="R" yChannelSelector="G"></feDisplacementMap></filter></defs><g filter="url(#mt_pencil)" fill="none" stroke-linejoin="round" stroke-linecap="round"><path d="M12.08,2.66 Q14.55,11.44 17.78,19.98 Q10.22,14.97 3.12,9.34 Q11.92,9.16 20.72,9.04 Q13.87,14.61 6.71,19.78 Q9.44,11.23 12.08,2.66 Z" stroke-width="2.4" opacity="0.3"></path><path d="M12.08,2.66 Q14.55,11.44 17.78,19.98 Q10.22,14.97 3.12,9.34 Q11.92,9.16 20.72,9.04 Q13.87,14.61 6.71,19.78 Q9.44,11.23 12.08,2.66 Z" stroke-width="1.7"></path></g></svg></button>
<?php } ?>
<?php foreach ($jungle_menu as $ti => $tab) { $on = (!$has_season && $ti === 0); ?>
					<button type="button" class="mt_btn<?php echo $on ? ' on' : '' ?>" role="tab" aria-selected="<?php echo $on ? 'true' : 'false' ?>" aria-controls="pn_<?php echo $tab['key'] ?>" data-panel="<?php echo $tab['key'] ?>"><?php echo $tab['label'] ?></button>
<?php } ?>
				</div>
				<div class="m_panels fade f_up f_delay06">
<?php if ($has_season) { ?>
					<div class="mp_panel on" id="pn_season" role="tabpanel">
						<ul class="ms_list">
<?php     foreach ($jungle_season as $sv) {
			$alt = trim($sv['js_alt']) !== '' ? $sv['js_alt'] : '시즌 메뉴';
			$src = jungle_season_url().'/'.rawurlencode($sv['js_image']);
?>
							<li class="ms_item">
								<button type="button" class="ms_btn" data-src="<?php echo htmlspecialchars($src, ENT_QUOTES, 'UTF-8') ?>" aria-label="<?php echo htmlspecialchars($alt, ENT_QUOTES, 'UTF-8') ?> 크게 보기">
									<img src="<?php echo htmlspecialchars($src, ENT_QUOTES, 'UTF-8') ?>" alt="<?php echo htmlspecialchars($alt, ENT_QUOTES, 'UTF-8') ?>" loading="lazy" decoding="async">
								</button>
							</li>
<?php     } ?>
						</ul>
						<p class="ms_hint" data-i18n="season.zoom">눌러서 크게 보기</p>
					</div>
<?php } ?>
<?php foreach ($jungle_menu as $ti => $tab) { $on = (!$has_season && $ti === 0); ?>
					<div class="mp_panel<?php echo $on ? ' on' : '' ?>" id="pn_<?php echo $tab['key'] ?>" role="tabpanel">
<?php     $tn = isset($g5['jungle_tab_notice'][$tab['key']]) ? $g5['jungle_tab_notice'][$tab['key']] : null; ?>
<?php     if ($tn) { ?>
						<p class="mp_notice" data-tn-ko="<?php echo htmlspecialchars($tn['ko'], ENT_QUOTES, 'UTF-8') ?>" data-tn-en="<?php echo htmlspecialchars($tn['en'], ENT_QUOTES, 'UTF-8') ?>" data-tn-ja="<?php echo htmlspecialchars($tn['ja'], ENT_QUOTES, 'UTF-8') ?>"><?php echo $tn['ko'] ?></p>
<?php     } ?>
<?php     $multi = count($tab['groups']) > 1 && trim($tab['groups'][0]['cat']) !== ''; ?>
<?php     foreach ($tab['groups'] as $g) { ?>
<?php         if ($multi) { ?>
<?php
			$ct = isset($g5['jungle_cat_i18n'][$g['cat']]) ? $g5['jungle_cat_i18n'][$g['cat']] : null;
			$ct_attr = '';
			if ($ct) {
				$ct_attr  = ' data-ct-en="'.htmlspecialchars($ct['en'], ENT_QUOTES, 'UTF-8').'"';
				$ct_attr .= ' data-ct-ja="'.htmlspecialchars($ct['ja'], ENT_QUOTES, 'UTF-8').'"';
			}
?>
						<h4 class="mp_sub font" data-ct-ko="<?php echo htmlspecialchars($g['cat'], ENT_QUOTES, 'UTF-8') ?>"<?php echo $ct_attr ?>><?php echo $g['cat'] ?></h4>
<?php         } ?>
						<ul class="mg_list">
<?php             foreach ($g['items'] as $it) echo jungle_menu_item($it); ?>
						</ul>
<?php     } ?>
					</div>
<?php } ?>
				</div>
			</div>
		</div>
	</section>
	<!-- Menu E -->

	<!-- 시즌 그림 크게 보기 S -->
	<div class="ms_view" id="ms_view" hidden>
		<button type="button" class="ms_close" aria-label="닫기"></button>
		<img src="" alt="">
	</div>
	<!-- 시즌 그림 크게 보기 E -->

	<!-- Moment S -->
	<section id="moment" class="sec torn" data-veil data-tone="dark">
		<!-- 정글 베일 S -->
		<div class="sv_veil" aria-hidden="true">
			<div class="svv_side svv_l">
				<svg class="svl n1" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n2" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n3" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n4" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n5" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n6" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n7" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n8" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n9" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n10" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n11" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n12" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n19" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n20" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n21" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n22" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n13 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n14 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n15 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n16 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n17 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n18 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
			</div>
			<div class="svv_side svv_r">
				<svg class="svl n1" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n2" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n3" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n4" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n5" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n6" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n7" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n8" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n9" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n10" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n11" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n12" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n19" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n20" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n21" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n22" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n13 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n14 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n15 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n16 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n17 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n18 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
			</div>
		</div>
		<!-- 정글 베일 E -->

		<div class="g_wrap">
			<p class="g_eyebrow fade f_up" data-i18n="moment.eyebrow"><span class="font">MOMENT</span> 정글의 밤</p>
			<h2 class="g_title title t2 cw font2 fade f_up f_delay03" data-i18n="moment.title">그날 밤의 <mark class="cr">한 컷</mark></h2>
			<ul class="g_list">
				<li class="gl_item fade f_up">
					<div class="gli_thumb"><img src="<?php echo G5_THEME_URL ?>/img/moment/m1.jpg" alt="BAR JUNGLE 바 카운터" loading="lazy" decoding="async"></div>
					<p class="gli_cap" data-i18n="moment.cap1">바 카운터, 오늘 밤의 자리</p>
				</li>
				<li class="gl_item fade f_up f_delay03">
					<div class="gli_thumb"><img src="<?php echo G5_THEME_URL ?>/img/moment/m2.jpg" alt="레이어드 시그니처 칵테일" loading="lazy" decoding="async"></div>
					<p class="gli_cap" data-i18n="moment.cap2">정글의 초록 한 잔</p>
				</li>
				<li class="gl_item fade f_up f_delay06">
					<div class="gli_thumb"><img src="<?php echo G5_THEME_URL ?>/img/moment/m3.jpg" alt="천장에 걸린 나비 조명과 초록" loading="lazy" decoding="async"></div>
					<p class="gli_cap" data-i18n="moment.cap3">초록 사이의 나비 조명</p>
				</li>
				<li class="gl_item fade f_up f_delay09">
					<div class="gli_thumb"><img src="<?php echo G5_THEME_URL ?>/img/moment/m4.jpg" alt="동물 피규어와 함께 놓인 칵테일" loading="lazy" decoding="async"></div>
					<p class="gli_cap" data-i18n="moment.cap4">동물 친구들과 한 잔</p>
				</li>
				<li class="gl_item fade f_up f_delay06">
					<div class="gli_thumb"><img src="<?php echo G5_THEME_URL ?>/img/moment/m5.jpg" alt="무지개 깃발과 색색의 샷 잔" loading="lazy" decoding="async"></div>
					<p class="gli_cap" data-i18n="moment.cap5">모두의 밤, 모두의 잔</p>
				</li>
				<li class="gl_item fade f_up f_delay09">
					<div class="gli_thumb"><img src="<?php echo G5_THEME_URL ?>/img/moment/m6.jpg" alt="호랑이 장식과 꽃이 놓인 바" loading="lazy" decoding="async"></div>
					<p class="gli_cap" data-i18n="moment.cap6">호랑이가 지키는 바</p>
				</li>
			</ul>
			<a href="<?php echo $jungle_site['instagram'] ?>" class="g_more" target="_blank" rel="noopener" title="Instagram_인스타그램 바로가기"><span class="font">@JUNGLE_SEOUL</span> <span data-i18n="moment.more">인스타그램에서 더 보기</span><i></i></a>
		</div>
	</section>
	<!-- Moment E -->

	<!-- Visit S -->
	<section id="visit" class="sec torn" data-veil data-tone="dark">
		<!-- 정글 베일 S -->
		<div class="sv_veil" aria-hidden="true">
			<div class="svv_side svv_l">
				<svg class="svl n1" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n2" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n3" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n4" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n5" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n6" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n7" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n8" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n9" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n10" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n11" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n12" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n19" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n20" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n21" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n22" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n13 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n14 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n15 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n16 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n17 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n18 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
			</div>
			<div class="svv_side svv_r">
				<svg class="svl n1" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n2" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n3" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n4" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n5" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n6" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n7" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n8" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n9" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n10" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n11" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n12" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n19" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n20" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n21" viewBox="-35 -111 70 115"><use href="#lf_oval"></use></svg>
				<svg class="svl n22" viewBox="-38 -117 76 121"><use href="#lf_split"></use></svg>
				<svg class="svl n13 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n14 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n15 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n16 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
				<svg class="svl n17 b" viewBox="-76 -104 152 108"><use href="#lf_palm"></use></svg>
				<svg class="svl n18 b" viewBox="-50 -137 100 145"><use href="#lf_frond"></use></svg>
			</div>
		</div>
		<!-- 정글 베일 E -->

		<div class="v_wrap">
			<div class="v_left">
				<p class="v_eyebrow fade f_up" data-i18n="visit.eyebrow"><span class="font">VISIT</span> 오시는 길</p>
				<h2 class="v_title title t2 cw font2 fade f_up f_delay03" data-i18n="visit.title">풀숲을 헤치고<br><mark class="cs">들어오세요</mark></h2>
				<div class="v_map fade f_up f_delay12">
					<?php /* iframe 은 인앱 브라우저나 추적 차단에서 조용히 실패해 빈 칸이 남았다.
					         지도를 그림 한 장으로 바꾸고, 누르면 구글 지도로 넘어가게 한다.
					         링크는 하나다. 그림과 버튼을 따로 링크로 걸면 같은 곳으로 가는
					         멈춤점이 둘이 되어 키보드로 넘길 때 번거롭다. */ ?>
					<a href="https://www.google.com/maps/search/?api=1&amp;query=<?php echo urlencode($jungle_site['map_query']) ?>" class="vm_link" target="_blank" rel="noopener" title="Map_구글 지도에서 열기">
						<img src="<?php echo G5_THEME_URL ?>/img/map.jpg?v=<?php echo $jungle_ver ?>" alt="BAR JUNGLE 위치 : <?php echo $jungle_site['addr_ko'] ?>" loading="lazy" decoding="async">
						<span class="vm_open"><span data-i18n="visit.map">구글 지도에서 열기</span><i></i></span>
					</a>
					<?php /* 지도 바탕은 OpenStreetMap 자료다. 쓰려면 출처를 밝혀야 한다.
					         그림에 박아 두면 화면 비율에 따라 가장자리가 잘려 사라지므로
					         화면 쪽에 따로 얹는다. */ ?>
					<span class="vm_att">&copy; OpenStreetMap</span>
				</div>
			</div>
			<div class="v_right">
				<ul class="v_info fade f_up f_delay06">
					<li class="vi_row">
						<strong class="vir_tit font">ADDRESS</strong>
						<div class="vir_txt">
							<address class="txt big cw" data-i18n="visit.addr"><?php echo $jungle_site['addr_ko'] ?></address>
							<p class="txt small" data-i18n="visit.addr_sub"><?php echo $jungle_site['addr_en'] ?></p>
						</div>
					</li>
					<li class="vi_row">
						<strong class="vir_tit font">HOURS</strong>
						<div class="vir_txt">
							<ul class="vir_hours">
								<li class="vh_open"><b data-i18n="visit.open365">365 OPEN!</b></li>
<?php foreach ($jungle_site['hours'] as $hr) { ?>
								<li><b data-i18n="<?php echo $hr['i18n'] ?>"><?php echo $hr['label'] ?></b><em class="font"><?php echo $hr['time'] ?></em></li>
<?php } ?>
							</ul>
							<p class="txt small" data-i18n="visit.hours_sub">임시 휴무는 인스타그램 공지를 확인해 주세요</p>
						</div>
					</li>
					<li class="vi_row">
						<strong class="vir_tit font">RESERVE</strong>
						<div class="vir_txt">
							<p class="txt big cw"><a href="<?php echo $jungle_site['instagram'] ?>" class="vir_ig" target="_blank" rel="noopener" title="Instagram_인스타그램">Instagram <?php echo $jungle_site['insta_id'] ?></a></p>
							<p class="txt small" data-i18n="visit.reserve_sub">미리 연락주시면 예약 안내해드릴게요.</p>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</section>
	<!-- Visit E -->

<?php
include_once(G5_PATH.'/tail.php');
