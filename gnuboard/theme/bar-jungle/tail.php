<?php
if (!defined('_GNUBOARD_')) exit;
?>
<!-- Footer S -->
	<footer id="footer" class="torn" data-tone="dark">
		<div class="f_wrap">
			<p class="f_logo"><img src="<?php echo G5_THEME_URL ?>/img/logo_jungle.png" alt="BAR JUNGLE 정글"></p>
			<ul class="f_sns">
				<li><a href="https://www.instagram.com/jungle_seoul/" target="_blank" rel="noopener" title="SNS_인스타그램">INSTAGRAM</a></li>
			</ul>
			<p class="f_copy txt small">© <span class="font">BAR JUNGLE</span>. ALL RIGHTS RESERVED.</p>
		</div>
		<svg class="f_leaf" viewBox="0 0 1600 200" preserveAspectRatio="xMidYMax slice" aria-hidden="true">
			<g class="lfc0">
				<use href="#lf_frond" transform="translate(80,220) rotate(-14) scale(1.7)"></use>
				<use href="#lf_palm" transform="translate(300,225) rotate(8) scale(1.6)"></use>
				<use href="#lf_oval" transform="translate(520,222) rotate(-10) scale(1.5)"></use>
				<use href="#lf_split" transform="translate(760,228) rotate(6) scale(1.6)"></use>
				<use href="#lf_frond" transform="translate(1000,220) rotate(-8) scale(1.7)"></use>
				<use href="#lf_palm" transform="translate(1240,226) rotate(11) scale(1.6)"></use>
				<use href="#lf_oval" transform="translate(1480,222) rotate(-7) scale(1.5)"></use>
			</g>
		</svg>
	</footer>
	<!-- Footer E -->

</div>

<script src="<?php echo G5_THEME_URL ?>/js/i18n.js?v=<?php echo isset($jungle_ver) ? $jungle_ver : "1.0.0" ?>"></script>
<script src="<?php echo G5_THEME_URL ?>/js/lib.js?v=<?php echo isset($jungle_ver) ? $jungle_ver : "1.0.0" ?>"></script>

<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
