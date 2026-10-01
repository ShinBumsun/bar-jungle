<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/login.css?v=1.0.0">', 0);
?>

<!-- 로그인 시작 { -->
<div id="jg_login">

	<svg class="jgl_leaf jgl_l1" viewBox="-76 -104 152 108" aria-hidden="true"><path d="M-7,0 Q-3,-52 0,-100 Q3,-52 7,0 Z" transform="rotate(-54) scale(0.86)"></path><path d="M-7,0 Q-3,-52 0,-100 Q3,-52 7,0 Z" transform="rotate(-27)"></path><path d="M-7,0 Q-3,-52 0,-100 Q3,-52 7,0 Z"></path><path d="M-7,0 Q-3,-52 0,-100 Q3,-52 7,0 Z" transform="rotate(27)"></path><path d="M-7,0 Q-3,-52 0,-100 Q3,-52 7,0 Z" transform="rotate(54) scale(0.86)"></path></svg>
	<svg class="jgl_leaf jgl_l2" viewBox="-35 -111 70 115" aria-hidden="true"><path d="M0,0 C-27,-24 -31,-72 0,-106 C31,-72 27,-24 0,0 Z"></path></svg>
	<svg class="jgl_leaf jgl_l3" viewBox="-35 -111 70 115" aria-hidden="true"><path d="M0,0 C-27,-24 -31,-72 0,-106 C31,-72 27,-24 0,0 Z"></path></svg>
	<svg class="jgl_leaf jgl_l4" viewBox="-76 -104 152 108" aria-hidden="true"><path d="M-7,0 Q-3,-52 0,-100 Q3,-52 7,0 Z" transform="rotate(-54) scale(0.86)"></path><path d="M-7,0 Q-3,-52 0,-100 Q3,-52 7,0 Z" transform="rotate(-27)"></path><path d="M-7,0 Q-3,-52 0,-100 Q3,-52 7,0 Z"></path><path d="M-7,0 Q-3,-52 0,-100 Q3,-52 7,0 Z" transform="rotate(27)"></path><path d="M-7,0 Q-3,-52 0,-100 Q3,-52 7,0 Z" transform="rotate(54) scale(0.86)"></path></svg>

	<div class="jgl_box">
		<a href="<?php echo G5_URL ?>/" class="jgl_logo" title="BAR JUNGLE_메인으로">
			<img src="<?php echo G5_THEME_URL ?>/img/logo_jungle.png" alt="BAR JUNGLE 정글">
		</a>

		<h1 class="jgl_tit">로그인</h1>

		<form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
		<input type="hidden" name="url" value="<?php echo $login_url ?>">

		<fieldset class="jgl_fs">
			<legend class="blind">로그인</legend>

			<label for="login_id" class="blind">아이디<strong class="blind"> 필수</strong></label>
			<input type="text" name="mb_id" id="login_id" required class="jgl_input frm_input required" size="20" maxLength="20" placeholder="아이디" autocomplete="username">

			<label for="login_pw" class="blind">비밀번호<strong class="blind"> 필수</strong></label>
			<input type="password" name="mb_password" id="login_pw" required class="jgl_input frm_input required" size="20" maxLength="20" placeholder="비밀번호" autocomplete="current-password">

			<button type="submit" class="jgl_submit font">LOGIN</button>

			<div class="jgl_auto">
				<input type="checkbox" name="auto_login" id="login_auto_login">
				<label for="login_auto_login"><i></i>자동로그인</label>
			</div>
		</fieldset>
		</form>

		<a href="<?php echo G5_URL ?>/" class="jgl_home">&larr; 메인으로 돌아가기</a>
	</div>
</div>

<script>
jQuery(function($){
	$("#login_auto_login").click(function(){
		if (this.checked) {
			this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
		}
	});
});

function flogin_submit(f)
{
	if( $( document.body ).triggerHandler( 'login_sumit', [f, 'flogin'] ) !== false ){
		return true;
	}
	return false;
}
</script>
<!-- } 로그인 끝 -->
