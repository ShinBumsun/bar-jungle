<?php
/**
 * 굿즈 한 장(<li>) 묶음. goods_items.php 안에서만 부릅니다.
 * 슬라이드든 격자든 카드 자체는 똑같아야 해서 따로 뒀습니다.
 */
if (!defined('_GNUBOARD_')) exit;
?>
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
		/* 가격 밑 한 줄과 가격은 언어를 바꿀 때 자리에서 갈아 끼운다.
		   한국어 원문을 실어 보내야 되돌릴 수 있다. */
		if ($note !== '') $attr .= ' data-nt-ko="'.$esc($note).'"';
		foreach (array('en','ja') as $lc) {
			$nv = isset($g['jg_note_'.$lc]) ? trim($g['jg_note_'.$lc]) : '';
			if ($nv !== '') $attr .= ' data-nt-'.$lc.'="'.$esc($nv).'"';
		}
		$attr .= ' data-pr="'.$esc(trim($g['jg_price'])).'"';
		if ($was !== '') $attr .= ' data-pw="'.$esc($was).'"';
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
