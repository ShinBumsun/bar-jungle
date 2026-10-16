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
					<?php /* 바늘도 잎 모양으로. 아래 버튼과 결을 맞추고, 끝이 뾰족해
					         어느 칸에 섰는지 분명히 보인다. */ ?>
					<svg class="ev_pin" viewBox="0 0 44 62" aria-hidden="true">
						<path class="evp_shadow" d="M22,60 C7,43 5,22 22,7 C39,22 37,43 22,60 Z"></path>
						<path class="evp_leaf" d="M22,58 C8,42 6,22 22,6 C38,22 36,42 22,58 Z"></path>
						<path class="evp_rib" d="M22,13 L22,50"></path>
						<path class="evp_rib" d="M22,26 L14,20 M22,26 L30,20 M22,38 L15,32 M22,38 L29,32"></path>
						<circle class="evp_cap" cx="22" cy="9" r="7"></circle>
					</svg>
					<div class="ev_wheel" id="ev_wheel">
						<svg viewBox="0 0 400 400" aria-hidden="true">
							<circle cx="200" cy="200" r="196" fill="#241f18"></circle>
<?php
	/* 칸은 부채꼴로 직접 그린다. conic-gradient 는 칸마다 글씨를 앉히기가
	   어렵고, 얇은 칸에서 글씨가 테두리를 넘는다. */
	$R = 184;
	$deg2xy = function ($a, $r) {           // 12시에서 시계 방향 각도 → 좌표
		$t = deg2rad($a - 90);
		return array(200 + $r * cos($t), 200 + $r * sin($t));
	};
	$arc = function ($a0, $a1, $r0, $r1) use ($deg2xy) {   // 도넛 모양 한 조각
		list($x1, $y1) = $deg2xy($a0, $r1);
		list($x2, $y2) = $deg2xy($a1, $r1);
		list($x3, $y3) = $deg2xy($a1, $r0);
		list($x4, $y4) = $deg2xy($a0, $r0);
		$lg = ($a1 - $a0) > 180 ? 1 : 0;
		return sprintf('M%.2f,%.2f A%.0f,%.0f 0 %d 1 %.2f,%.2f L%.2f,%.2f A%.0f,%.0f 0 %d 0 %.2f,%.2f Z',
			$x1, $y1, $r1, $r1, $lg, $x2, $y2, $x3, $y3, $r0, $r0, $lg, $x4, $y4);
	};

	foreach ($seg as $k => $g) {
		$col  = $COL[$k % count($COL)];
		$span = $g[1] - $g[0];
		if ($span >= 359.99) {
			echo "\t\t\t\t\t\t\t".'<circle cx="200" cy="200" r="'.$R.'" fill="'.$col.'"></circle>'."\n";
			continue;
		}
		list($x1, $y1) = $deg2xy($g[0], $R);
		list($x2, $y2) = $deg2xy($g[1], $R);
		printf("\t\t\t\t\t\t\t".'<path d="M200,200 L%.2f,%.2f A%d,%d 0 %d 1 %.2f,%.2f Z" fill="%s" stroke="#241f18" stroke-width="2.5"></path>'."\n",
		       $x1, $y1, $R, $R, $span > 180 ? 1 : 0, $x2, $y2, $col);

		/* 결 : 넓은 칸이 한 덩어리로 보이지 않게 안쪽에 옅은 빗살을 둔다.
		   넓이는 그대로라 확률은 달라지지 않는다. */
		for ($a = $g[0] + 18; $a < $g[1] - 8; $a += 18) {
			list($sx, $sy) = $deg2xy($a, 46);
			list($ex, $ey) = $deg2xy($a, $R - 4);
			printf("\t\t\t\t\t\t\t".'<line x1="%.2f" y1="%.2f" x2="%.2f" y2="%.2f" stroke="#241f18" stroke-width="1" opacity="0.16"></line>'."\n",
			       $sx, $sy, $ex, $ey);
		}
	}

	/* 바깥 테와 전구 */
	echo "\t\t\t\t\t\t\t".'<circle cx="200" cy="200" r="'.($R + 6).'" fill="none" stroke="#241f18" stroke-width="12"></circle>'."\n";
	for ($b = 0; $b < 24; $b++) {
		list($bx, $by) = $deg2xy($b * 15 + 7.5, $R + 6);
		printf("\t\t\t\t\t\t\t".'<circle cx="%.2f" cy="%.2f" r="3.6" fill="%s"></circle>'."\n",
		       $bx, $by, $b % 2 ? '#f7efdd' : '#e8b13a');
	}

	/* 이름은 중심에서 바깥으로 눕힌다. 얇은 칸에서도 잘리지 않는다.
	   아주 넓은 칸은 여러 번 적어 빙 둘러 읽히게 한다. */
	foreach ($slots as $k => $sl) {
		$span = $seg[$k][1] - $seg[$k][0];
		$reps = max(1, min(4, (int)floor($span / 95)));
		$nm   = $sl['jr_name'];
		$fs   = (mb_strlen($nm, 'UTF-8') > 9) ? 15 : 17;
		for ($t = 0; $t < $reps; $t++) {
			$mid  = $seg[$k][0] + $span * ($t + 0.5) / $reps;
			$flip = ($mid > 180);
			$lx   = 200 + 116;
			$tr   = 'rotate('.round($mid - 90, 3).' 200 200)';
			if ($flip) $tr .= ' rotate(180 '.$lx.' 200)';
			echo "\t\t\t\t\t\t\t".'<text class="ev_wt" x="'.$lx.'" y="200" transform="'.$tr.'" font-size="'.$fs.'">'.$esc($nm).'</text>'."\n";
		}
	}
?>
						</svg>
					</div>
					<div class="ev_hub" aria-hidden="true"><span>林</span></div>
				</div>

				<button type="button" class="ev_box" id="ev_box" aria-label="룰렛 돌리기">
					<?php /* 잎 하나가 통째로 버튼이다. 가운데가 넓어 글씨가 잘 앉는다. */ ?>
					<svg class="evb_leaf" viewBox="0 0 280 160" aria-hidden="true">
						<?php /* 잎맥이 잎 밖으로 나가지 않게 잎 모양으로 잘라 낸다.
						         곡선 좌표를 눈대중으로 맞추는 것보다 확실하다. */ ?>
						<defs><clipPath id="evl_clip"><path d="M30,80 C84,10 206,10 262,80 C206,150 84,150 30,80 Z"></path></clipPath></defs>
						<path class="evl_stem" d="M6,80 C18,80 26,80 34,80" stroke="#241f18" stroke-width="7" stroke-linecap="round" fill="none"></path>
						<path class="evl_body" d="M30,80 C84,10 206,10 262,80 C206,150 84,150 30,80 Z"></path>
						<?php /* 잎맥은 밑동에서 부챗살처럼 뻗는다. 가운데를 가로지르는
						         줄을 두면 글씨 위로 지나가 읽기 어렵다. */ ?>
						<g class="evl_vein" clip-path="url(#evl_clip)">
							<path d="M40,80 C120,66 200,36 268,16"></path>
							<path d="M40,80 C120,94 200,124 268,144"></path>
							<path d="M40,80 C116,72 186,52 248,34"></path>
							<path d="M40,80 C116,88 186,108 248,126"></path>
							<path d="M40,80 C110,76 172,64 228,52"></path>
							<path d="M40,80 C110,84 172,96 228,108"></path>
						</g>
					</svg>
					<span class="evb_txt font" data-i18n="event.btn">눌러서 돌리기</span>
				</button>
			</div>

			<p class="ev_hand" data-i18n="event.hand">당첨되면 이 화면을 직원에게 보여 주세요</p>

			<div class="ev_prizes">
				<p class="evp_tit font" data-i18n="event.prizes">TODAY&rsquo;S PRIZES</p>
				<ul class="evp_list">
<?php     foreach ($slots as $k => $sl) {
			$pi = trim($sl['jr_image']);
			$ps = ($pi !== '' && is_file(jungle_roulette_dir().'/'.$pi)) ? jungle_roulette_url().'/'.rawurlencode($pi) : '';
?>
					<li class="evp_item">
						<span class="evp_pic"<?php echo $ps === '' ? ' data-mark="林"' : '' ?>><?php if ($ps !== '') { ?><img src="<?php echo $esc($ps) ?>" alt="" loading="lazy"><?php } ?></span>
						<span class="evp_nm"><?php echo $esc($sl['jr_name']) ?></span>
					</li>
<?php     } ?>
				</ul>
			</div>

			<!-- 결과 -->
			<div class="ev_result" id="ev_result" hidden>
				<div class="evr_box">
					<span class="evr_ribbon font" data-i18n="event.congrats">CONGRATS</span>
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
