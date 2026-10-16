<?php
/**
 * 굿즈 목록 한 덩어리.
 * 메인 화면의 GOODS 섹션과 단독 페이지(/goods.php)가 함께 씁니다.
 * 두 벌로 두면 한쪽만 고쳐져 서로 달라집니다.
 * 부르기 전에 $jungle_goods 를 채워 두세요.
 */
if (!defined('_GNUBOARD_')) exit;
?>
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
