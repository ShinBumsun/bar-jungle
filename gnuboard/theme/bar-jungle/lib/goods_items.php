<?php
/**
 * 굿즈 목록 한 덩어리.
 * 메인 화면의 GOODS 섹션과 단독 페이지(/goods.php)가 함께 씁니다.
 * 두 벌로 두면 한쪽만 고쳐져 서로 달라집니다.
 * 부르기 전에 $jungle_goods 를 채워 두세요.
 */
if (!defined('_GNUBOARD_')) exit;

/* 메인에서는 가로 슬라이드, 단독 페이지에서는 격자로 늘어놓습니다.
   부르는 쪽에서 $jungle_goods_slider 를 켜 주세요. */
$gs = !empty($jungle_goods_slider);
?>
<?php if (!count($jungle_goods)) { ?>
		<p class="gd_empty" data-i18n="goods.empty">준비 중입니다. 곧 보여 드릴게요.</p>
<?php } else if ($gs) { ?>
		<div class="s_slider gd_slider">
			<button type="button" class="ss_nav ss_prev" aria-label="이전 굿즈 보기"><i></i></button>
			<ul class="s_list gd_list" tabindex="0">
<?php     include(G5_THEME_PATH.'/lib/goods_li.php'); ?>
			</ul>
			<button type="button" class="ss_nav ss_next" aria-label="다음 굿즈 보기"><i></i></button>
		</div>
<?php } else { ?>
		<ul class="gd_list gd_grid">
<?php     include(G5_THEME_PATH.'/lib/goods_li.php'); ?>
		</ul>
<?php } ?>
