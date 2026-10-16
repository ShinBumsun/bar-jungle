<?php
/**
 * 이벤트 페이지 : 가챠 상자를 누르면 룰렛이 돈다.
 * 메인 화면(index.php)과 완전히 별개라, 여기를 고쳐도 메인은 그대로다.
 */
include_once('./common.php');
include_once(G5_THEME_PATH.'/lib/jungle.lib.php');

$jungle_site = include(G5_THEME_PATH.'/data/site.php');
$slots = jungle_roulette_rows(true);

/* 칸 크기는 확률에 따른다. 눈에 보이는 넓이와 실제 확률이 다르면
   돌려 본 사람이 속았다고 느낀다. */
$seg = jungle_roulette_segments($slots);

$g5['title'] = '이벤트';
include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_THEME_PATH.'/lib/svg_defs.php');

$esc = function ($v) { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); };
$COL = $g5['jungle_roulette_colors'];
?>

<div id="wrap" class="sub">

	<header id="header" class="fix sub_header">
		<h1 class="h_logo"><a href="<?php echo G5_URL ?>/" title="BAR JUNGLE_메인으로"><img src="<?php echo G5_THEME_URL ?>/img/logo_jungle.png" alt="BAR JUNGLE 정글"></a></h1>
		<nav class="h_gnb sub_gnb">
			<ul class="hg_list">
				<li class="hgl_item"><a href="<?php echo G5_URL ?>/#menu" title="Menu_메뉴판"><span data-i18n="nav.menu">메뉴</span></a></li>
				<li class="hgl_item"><a href="<?php echo G5_URL ?>/#goods" title="Menu_굿즈"><span data-i18n="nav.goods">굿즈</span></a></li>
			</ul>
		</nav>
		<div class="h_util">
			<div class="h_lang" role="group" aria-label="Language">
				<button type="button" class="hl_btn on" data-lang="ko" title="Language_한국어">KOR</button>
				<button type="button" class="hl_btn" data-lang="en" title="Language_English">ENG</button>
				<button type="button" class="hl_btn" data-lang="ja" title="Language_日本語">JPN</button>
			</div>
		</div>
	</header>

	<section id="event" class="sec ev_sec" data-tone="dark">
		<div class="ev_wrap">
			<p class="ev_eyebrow"><span class="font">EVENT</span> <span data-i18n="event.eyebrow">오늘의 운을 시험해 보세요</span></p>
			<h2 class="ev_title title t2 cw font2" data-i18n="event.title">정글 <mark class="cs">가챠</mark></h2>

<?php if (!count($slots)) { ?>
			<p class="ev_empty" data-i18n="event.empty">준비 중입니다. 곧 열어 드릴게요.</p>
<?php } else { ?>
			<div class="ev_stage">
				<div class="ev_wheelbox">
					<i class="ev_pin" aria-hidden="true"></i>
					<div class="ev_wheel" id="ev_wheel" style="background:conic-gradient(<?php
						$parts = array();
						foreach ($seg as $k => $g) $parts[] = $COL[$k % count($COL)].' '.round($g[0], 3).'deg '.round($g[1], 3).'deg';
						echo implode(', ', $parts);
					?>)">
<?php     foreach ($slots as $k => $s) { ?>
						<?php /* 칸 각도는 12시 기준인데 이 막대는 3시에서 시작한다. 90도를 뺀다. */ ?>
						<span class="ev_lab" style="transform:rotate(<?php echo round($seg[$k][2] - 90, 3) ?>deg)"><b><?php echo $esc($s['jr_name']) ?></b></span>
<?php     } ?>
					</div>
					<div class="ev_hub" aria-hidden="true"></div>
				</div>

				<button type="button" class="ev_box" id="ev_box" aria-label="가챠 상자 열기">
					<span class="evb_lid" aria-hidden="true"></span>
					<span class="evb_body" aria-hidden="true">
						<svg viewBox="0 0 200 200" aria-hidden="true"><use href="#ck1"></use></svg>
					</span>
					<span class="evb_txt font" data-i18n="event.btn">눌러서 돌리기</span>
				</button>
			</div>

			<p class="ev_hand" data-i18n="event.hand">당첨되면 이 화면을 직원에게 보여 주세요</p>

			<!-- 결과 -->
			<div class="ev_result" id="ev_result" hidden>
				<div class="evr_box">
					<div class="evr_pic" id="evr_pic"></div>
					<strong class="evr_name" id="evr_name"></strong>
					<p class="evr_msg" id="evr_msg"></p>
					<button type="button" class="evr_again" id="evr_again" data-i18n="event.again">한 번 더</button>
				</div>
			</div>
<?php } ?>
		</div>
	</section>

<?php
include_once(G5_THEME_PATH.'/tail.php');
