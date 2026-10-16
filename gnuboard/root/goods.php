<?php
/**
 * 굿즈 페이지
 * 매장에서 파는 물건을 보여 주기만 합니다. 장바구니도 결제도 배송도 없습니다.
 * 메인 화면(index.php)과 완전히 별개라, 여기를 고쳐도 메인은 그대로입니다.
 */
include_once('./common.php');
include_once(G5_THEME_PATH.'/lib/jungle.lib.php');

$jungle_site  = include(G5_THEME_PATH.'/data/site.php');
$jungle_goods = jungle_goods_rows();

$g5['title'] = '굿즈';
include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_THEME_PATH.'/lib/svg_defs.php');
?>

<div id="wrap" class="sub">

	<!-- 머리말 : 메인과 달리 돌아갈 곳이 있으면 된다 -->
	<header id="header" class="fix sub_header">
		<h1 class="h_logo"><a href="<?php echo G5_URL ?>/" title="BAR JUNGLE_메인으로"><img src="<?php echo G5_THEME_URL ?>/img/logo_jungle.png" alt="BAR JUNGLE 정글"></a></h1>
		<nav class="h_gnb sub_gnb">
			<ul class="hg_list">
				<li class="hgl_item"><a href="<?php echo G5_URL ?>/#menu" title="Menu_메뉴판"><span data-i18n="nav.menu">메뉴</span></a></li>
				<li class="hgl_item"><a href="<?php echo G5_URL ?>/#visit" title="Menu_오시는 길"><span data-i18n="nav.visit">오시는 길</span></a></li>
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

	<section id="goods" class="sec gd_sec" data-tone="dark">
		<div class="gd_wrap">
			<p class="gd_eyebrow"><span class="font">GOODS</span> <span data-i18n="goods.eyebrow">정글에서 데려가기</span></p>
			<h2 class="gd_title title t2 cw font2" data-i18n="goods.title">정글 한 조각,<br><mark class="cs">집으로</mark></h2>
			<p class="gd_hand" data-i18n="goods.hand">매장에서 직접 보고 사 가실 수 있어요</p>

<?php if (!count($jungle_goods)) { ?>
			<p class="gd_empty" data-i18n="goods.empty">준비 중입니다. 곧 보여 드릴게요.</p>
<?php } else { ?>
			<ul class="gd_list">
<?php     foreach ($jungle_goods as $g) {
			$esc   = function ($v) { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); };
			$badge = trim($g['jg_badge']);
			$sold  = ($badge === 'soldout');
			$was   = trim($g['jg_price_was']);
			$note  = trim($g['jg_note']);
			$BADGE = array('new' => 'NEW', 'sale' => 'SALE', 'soldout' => 'SOLD OUT');
			$attr  = ' data-nm-ko="'.$esc($g['jg_name_ko']).'"';
			if (trim($g['jg_name_en']) !== '') $attr .= ' data-nm-en="'.$esc($g['jg_name_en']).'"';
			if (trim($g['jg_name_ja']) !== '') $attr .= ' data-nm-ja="'.$esc($g['jg_name_ja']).'"';
			foreach (array('ko','en','ja') as $lc) {
				$dv = trim($g['jg_desc_'.$lc]);
				if ($dv !== '') $attr .= ' data-ds-'.$lc.'="'.$esc($dv).'"';
			}
?>
				<li class="gd_item<?php echo $sold ? ' is_sold' : '' ?>"<?php echo $attr ?>>
					<div class="gdi_pic">
						<img src="<?php echo $esc(jungle_goods_url().'/'.rawurlencode($g['jg_image'])) ?>" alt="<?php echo $esc($g['jg_name_ko']) ?>" loading="lazy" decoding="async">
<?php         if ($badge !== '' && isset($BADGE[$badge])) { ?>
						<span class="gdi_badge b_<?php echo $esc($badge) ?>"><?php echo $BADGE[$badge] ?></span>
<?php         } ?>
					</div>
					<div class="gdi_txt">
						<strong class="gdi_name"><?php echo $esc($g['jg_name_ko']) ?></strong>
						<p class="gdi_price">
<?php         if ($was !== '') { ?><s><?php echo $esc($was) ?></s> <?php } ?>
							<b class="font"><?php echo $esc($g['jg_price']) ?></b>
						</p>
<?php         if ($note !== '') { ?>
						<p class="gdi_note"><?php echo $esc($note) ?></p>
<?php         } ?>
<?php         if (trim($g['jg_desc_ko']) !== '') { ?>
						<p class="gdi_desc"><?php echo $esc($g['jg_desc_ko']) ?></p>
<?php         } ?>
					</div>
				</li>
<?php     } ?>
			</ul>
<?php } ?>

			<div class="gd_how">
				<strong class="gdh_tit" data-i18n="goods.how_tit">구매 하시려면</strong>
				<p class="gdh_txt" data-i18n="goods.how_txt">온라인 주문과 배송은 하지 않습니다.<br>매장에 오셔서 보시고 바로 가져가시면 됩니다.</p>
				<a href="<?php echo $jungle_site['instagram'] ?>" class="gdh_btn" target="_blank" rel="noopener" title="Instagram_인스타그램 DM 문의"><span data-i18n="goods.how_btn">재고·색상 문의는 인스타 DM</span><i></i></a>
			</div>
		</div>
	</section>

<?php
include_once(G5_THEME_PATH.'/tail.php');
