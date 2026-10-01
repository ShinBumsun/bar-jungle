<?php
/**
 * BAR JUNGLE 메뉴 데이터
 * 메뉴판 PDF(메뉴판진행260713)를 옮긴 것. 이 파일만 고치면 화면이 바뀝니다.
 *
 * alc   : 도수 0~5 (0 이면 표시 안 함)
 * m1/m2 : 와인 지표 array('sweetness', 3) 형태
 * vol   : 보틀 용량 (700ml 등)
 */
if (!defined('_GNUBOARD_')) exit;

return array(
	// ── SIGNATURE ──
	array('key'=>'signature', 'label'=>'SIGNATURE', 'groups'=>array(
		array('cat'=>'JUNGLE SIGNATURE', 'items'=>array(
			array('ko'=>'정글쥬스', 'en'=>'Jungle Juice', 'price'=>'13,000', 'alc'=>3, 'desc'=>'데킬라, 진과 더불어 오렌지향이 가득한 정글의 에메랄드 빛 트로피컬 시그니쳐 칵테일'),
			array('ko'=>'정글몬스터', 'en'=>'Jungle Monster', 'price'=>'14,000', 'alc'=>4, 'desc'=>'포도 레몬맛이 매력적인, 다섯가지의 술이 들어간 위험이 도사리는 정글의 강력한 한방!'),
			array('ko'=>'하쿠나마타타', 'en'=>'Hakuna-Matata', 'price'=>'14,000', 'alc'=>2, 'desc'=>'아프리카어로 \'걱정 없어!\'라는 뜻. 코코넛과 달콤한 버터우유맛 하쿠나마타타 한잔과 함께라면 오늘 종로마실도 하쿠나 마타타!'),
			array('ko'=>'그레이트 그레이프', 'en'=>'Great Grapes', 'price'=>'15,000', 'alc'=>3, 'desc'=>'고급스러운 카시스 베리향을 우아하게 즐길 수 있는 ‘종로 퀸’을 위한 시그니쳐 칵테일'),
			array('ko'=>'럭키정글', 'en'=>'Lucky Jungle', 'price'=>'15,000', 'alc'=>2, 'desc'=>'톡톡 터지는 패션후르츠의 달콤, 상큼함이 한가득! 시원한 럭키정글 한잔이면 행운이 가득한 기분좋은 하루가 될거에요!'),
			array('ko'=>'시나, 브로', 'en'=>'Cinna, bro', 'price'=>'15,000', 'alc'=>2, 'desc'=>'모르는 사이에 조금씩 퍼지는 시나몬향, 달콤하고 부드러운 우유와 함께 기분좋게 취할 수 있는 시그니쳐 칵테일'),
			array('ko'=>'뱀부 브리즈', 'en'=>'Bamboo Breeze', 'price'=>'15,000', 'alc'=>2, 'desc'=>'우리나라의 대나무 전통주인 ‘죽력고’의 향긋한 대나무향과 민트 솔잎향이 감도는 깔끔한 칵테일'),
			array('ko'=>'크림달래', 'en'=>'Cream Dalae', 'price'=>'16,000', 'alc'=>1, 'desc'=>'새콤한 청포도향과 메론맛 미도리 스파클링 위에 바닐라아이스크림 한스쿱이 통채로, 이걸 어떻게 참아?'),
			array('ko'=>'트레져', 'en'=>'Treasure', 'price'=>'22,000', 'alc'=>5, 'desc'=>'여기까지 오셨다면, 당신은 정글 속 위대한 보물을 가져갈 자격이 있습니다! 고급스러운 버번위스키를 향긋하게 재해석한 남다른 맛을 탐닉해보세요'),
			array('ko'=>'레인보우 딜라이트 샷 세트', 'en'=>'Rainbow Delight shot set', 'price'=>'29,000', 'note'=>'6 shots', 'desc'=>'6색 레인보우 빛깔의 샷이 제공되는 파티 샷 세트! 매번 랜덤으로 제조되는 하나의 숨겨진 복불복 높은도수를 찾아보세요'),
		)),
	)),
	// ── HIGHBALL ──
	array('key'=>'highball', 'label'=>'HIGHBALL', 'groups'=>array(
		array('cat'=>'HIGHBALL', 'items'=>array(
			array('ko'=>'애플시나몬 하이볼', 'en'=>'Apple Cinnamon Highball', 'price'=>'13,000', 'alc'=>2, 'desc'=>'잔에 리밍된 시나몬슈가와 함께 즐기는 청량한 애플시나몬 하이볼'),
			array('ko'=>'생레몬 허니 하이볼', 'en'=>'Lemon Honey Highball', 'price'=>'14,000', 'alc'=>2, 'desc'=>'생레몬을 으깨어 잭다니엘 허니와 레몬 스파클링으로 마무리한 상큼 달콤 하이볼'),
			array('ko'=>'버터 진저 하이볼', 'en'=>'Butter Ginger ale Highball', 'price'=>'13,000', 'alc'=>1, 'desc'=>'버터 스카치 리큐르와 진저에일의 중독적인 만남'),
			array('ko'=>'위스키 하이볼', 'en'=>'Whisky Highball', 'price'=>'10,000', 'alc'=>3, 'desc'=>'가볍고 깔끔하게 즐길 수 있는 기본적인 위스키 하이볼'),
			array('ko'=>'산토리 하이볼', 'en'=>'Suntory Highball', 'price'=>'11,000', 'alc'=>3, 'desc'=>'하이볼의 원조, 산토리 가쿠빈으로 즐기는 위스키 하이볼'),
			array('ko'=>'우롱 하이볼', 'en'=>'Oolong Tea & Suntory Highball', 'price'=>'12,000', 'alc'=>2, 'desc'=>'우롱차와 함께 산토리 가쿠빈으로 즐기는 일본식 우롱하이볼'),
			array('ko'=>'조엽수림', 'en'=>'Laurel Forest(Oolong Tea & Green tea Liquer)', 'price'=>'12,000', 'alc'=>1, 'desc'=>'우롱차와 함께 고급 녹차리큐르를 즐기는 일본식 칵테일'),
			array('ko'=>'얼그레이 위스키 하이볼', 'en'=>'Earl grey Whisky Highball', 'price'=>'12,000', 'alc'=>3, 'desc'=>'레몬 얼그레이향을 함께 즐길 수있는  위스키 하이볼'),
			array('ko'=>'스크류바 하이볼', 'en'=>'Screw-bar(iced bar) Highball', 'price'=>'11,000', 'alc'=>2, 'desc'=>'스크류바가 통채로 들어간 위스키 하이볼'),
			array('ko'=>'생귤탱귤 하이볼', 'en'=>'Saeng-gyul Taeng-gyul(iced bar) Highball', 'price'=>'11,000', 'alc'=>2, 'desc'=>'생귤탱귤이 통채로 들어간 위스키하이볼'),
			array('ko'=>'화요25 토닉 하이볼', 'en'=>'Hwayo 25 Tonic Highball', 'price'=>'8,000', 'alc'=>2, 'desc'=>'25도의 화요와 토닉으로 즐기는 한국식 하이볼'),
			array('ko'=>'화요41 토닉 하이볼', 'en'=>'Hwayo 41 Tonic Highball', 'price'=>'12,000', 'alc'=>3, 'desc'=>'41도의 화요와 토닉으로 즐기는 한국식 하이볼'),
			array('ko'=>'화요 헛개 하이볼', 'en'=>'Oriental Raisin tea & Hwayo 25 Highball', 'price'=>'9,000', 'alc'=>2, 'desc'=>'25도의 화요와 헛개차를 함께 즐기는 해장 전문 하이볼'),
			array('ko'=>'잭 애플 하이볼', 'en'=>'Jack Daniel’s Apple Highball', 'price'=>'12,000', 'alc'=>3, 'desc'=>'잭다니엘 애플을 토닉과 함께 청량하게 즐기는 하이볼'),
			array('ko'=>'잭 허니 하이볼', 'en'=>'Jack Daniel’s Honey Highball', 'price'=>'12,000', 'alc'=>3, 'desc'=>'잭다니엘 허니를 토닉과 함께 달콤하게 즐기는 하이볼 ‘Classic & Original’'),
		)),
	)),
	// ── GIN &amp; TONIC ──
	array('key'=>'gin', 'label'=>'GIN &amp; TONIC', 'groups'=>array(
		array('cat'=>'GIN and TONIC', 'items'=>array(
			array('ko'=>'진토닉', 'en'=>'Gin and Tonic', 'price'=>'10,000', 'alc'=>3, 'desc'=>'풍부한 고든스 진의 향에 충실한 오리지널 진 토닉'),
			array('ko'=>'탱거레이 진토닉', 'en'=>'Tanqueray Gin and Tonic', 'price'=>'11,000', 'alc'=>3, 'desc'=>'탱커레이 진의 클래식한 향이 매력적인 진 토닉'),
			array('ko'=>'탱거레이 No.10 진토닉', 'en'=>'Tanqueray No.10 Gin and Tonic', 'price'=>'12,000', 'alc'=>3, 'desc'=>'시트러스 향을 강조한 탱커레이 넘버텐 진 토닉'),
			array('ko'=>'봄베이 진토닉', 'en'=>'Bombay Gin and Tonic', 'price'=>'12,000', 'alc'=>3, 'desc'=>'강렬한 봄베이 진의 향을 즐길 수 있는 진 토닉'),
			array('ko'=>'헨드릭스 진토닉', 'en'=>'Hendrick’s Gin and Tonic', 'price'=>'13,000', 'alc'=>3, 'desc'=>'진에 장미와 오이향을 입힌 헨드릭스 진으로 만든, 향긋한 진 토닉'),
			array('ko'=>'No.3 진토닉', 'en'=>'No.3 Gin and Tonic', 'price'=>'13,000', 'alc'=>3, 'desc'=>'영화 킹스맨에서 마티니를 만들어 먹던 No.3 진으로 만든 ‘조슈아사장님 원픽’ 진 토닉'),
			array('ko'=>'보타니스트 진토닉', 'en'=>'Botanist Gin and Tonic', 'price'=>'15,000', 'alc'=>3, 'desc'=>'\'식물학자\'라는 뜻이 담긴 보타니스트 진의 풍부한 풀향을 느낄 수 있는 진 토닉'),
			array('ko'=>'몽키47 진토닉', 'en'=>'Monkey 47 Gin and Tonic', 'price'=>'18,000', 'alc'=>3, 'desc'=>'47가지의 원료로 만든 47도의 고급 진 몽키47 베이스의 향긋한 진토닉'),
		)),
	)),
	// ── TROPICAL ──
	array('key'=>'tropical', 'label'=>'TROPICAL', 'groups'=>array(
		array('cat'=>'TROPICAL', 'items'=>array(
			array('ko'=>'데킬라썬라이즈', 'en'=>'Tequila Sunrise', 'price'=>'13,000', 'alc'=>3, 'desc'=>'해가 지는듯한 노을의 아름다운 모습을 닮은 매력적인 데킬라 칵테일'),
			array('ko'=>'말리부오렌지(파인애플, 밀크)', 'en'=>'Malibu Orange(Pineapple, Milk)', 'price'=>'12,000', 'alc'=>2, 'desc'=>'누구나 즐길 수 있는 코코넛과 오렌지가 절묘하게 어울리는 칵테일(파인애플, 밀크로 변경가능)'),
			array('ko'=>'피치크러쉬', 'en'=>'Peach Crush', 'price'=>'12,000', 'alc'=>1, 'desc'=>'달콤한 피치향을 크러시드 아이스와 함께 시원하고 가볍게 즐길 수 있는 칵테일'),
			array('ko'=>'섹스온더비치', 'en'=>'Sex on the beach', 'price'=>'13,000', 'alc'=>2, 'desc'=>'보드카, 오렌지, 크렌베리, 피치맛 실패하지않는 명성의 칵테일'),
			array('ko'=>'피나콜라다', 'en'=>'Piña Colada', 'price'=>'14,000', 'alc'=>2, 'desc'=>'\'파인애플이 무성한 언덕\'이라는 뜻의 코코넛 파인애플향이 가득한 칵테일'),
			array('ko'=>'준벅', 'en'=>'June Bug', 'price'=>'13,000', 'alc'=>2, 'desc'=>'6월의 벌레라는 뜻으로 메론, 열대과일맛의 새콤달콤한 초록이 싱그러운 칵테일'),
			array('ko'=>'롱 아일랜드 아이스티', 'en'=>'Long island Iced tea', 'price'=>'14,000', 'alc'=>4, 'desc'=>'총 5가지의 술의 들어가는 폭탄주의 정석. 하지만 도수를 잊게 만드는 매력적인 아이스티 맛 칵테일'),
			array('ko'=>'롱 비치 아이스티', 'en'=>'Long beach Iced tea', 'price'=>'14,000', 'alc'=>4, 'desc'=>'롱티에 레몬 크렌베리의 상큼함을 담은 풍부한 향의 칵테일'),
			array('ko'=>'도쿄 아이스티', 'en'=>'Tokyo Iced tea', 'price'=>'14,000', 'alc'=>4, 'desc'=>'롱티의 미도리 버전. 달콤한 메론맛에 가려진 강력한 도수의 맑은 연두색 칵테일'),
			array('ko'=>'아디오스 마더퍼커', 'en'=>'Adios motherfxxer', 'price'=>'14,000', 'alc'=>4, 'desc'=>'롱티의 블루레몬 버전. 맑은 푸른색의 상큼하고 달달함이 매력인 폭탄주 칵테일'),
			array('ko'=>'블루 하와이안', 'en'=>'Blue Hawaiian', 'price'=>'13,000', 'alc'=>2, 'desc'=>'하와이의 힐튼호텔에서 개발된 칵테일로, 푸른 바다의 하와이를 연상시키는 트로피컬 칵테일'),
			array('ko'=>'모히토 크러셔', 'en'=>'Mojito Crusher', 'price'=>'14,000', 'alc'=>3, 'desc'=>'럼과 라임주스, 향긋한 생제르망을 셰이크하여 크러시드 아이스와 진하게 즐기는 모히토'),
			array('ko'=>'카이피리냐', 'en'=>'Caipirinha', 'price'=>'14,000', 'alc'=>4, 'desc'=>'으깬 통 라임과 \'카챠샤\'라는 매력적인 브라질 전통주를 진하게 즐길 수 있는 칵테일'),
			array('ko'=>'좀비', 'en'=>'Zombie', 'price'=>'16,000', 'alc'=>4, 'desc'=>'티키잔에 제공되는 새콤달콤한 트로피컬 칵테일. 하지만 숨겨진 높은 도수의 럼들이 당신을 좀비로 만들어 버릴지도...?'),
		)),
	)),
	// ── CLASSIC ──
	array('key'=>'classic', 'label'=>'CLASSIC', 'groups'=>array(
		array('cat'=>'FIZZY', 'items'=>array(
			array('ko'=>'미도리 사워', 'en'=>'Midori Sour', 'price'=>'12,000', 'alc'=>1, 'desc'=>'메론향의 미도리를 새콤하고 청량감있게 즐길 수 있는 칵테일'),
			array('ko'=>'쿠바 리브레', 'en'=>'Cuba Libre', 'price'=>'11,000', 'alc'=>2, 'desc'=>'럼과 라임주스에 콜라를 채워 시원하고 청량감이 좋은 칵테일'),
			array('ko'=>'잭콕', 'en'=>'Jack & Coke', 'price'=>'11,000', 'alc'=>3, 'desc'=>'잭다니엘과 콜라의 배신없는 클래식한 조합'),
			array('ko'=>'민트 라임 모히또', 'en'=>'Mint Lime Mojito', 'price'=>'14,000', 'alc'=>1, 'desc'=>'애플민트와 라임의 새콤하고 시원한 향과 탄산이 달달하게 어우러져 갈증해소에 탁월한 칵테일'),
			array('ko'=>'블루 사파이어', 'en'=>'Blue Sapphire', 'price'=>'13,000', 'alc'=>2, 'desc'=>'영롱한 푸른빛깔의 매력적인 색을 담은 청량하고 새콤달콤한 탄산 트로피컬 칵테일'),
			array('ko'=>'아메리카노', 'en'=>'Americano', 'price'=>'13,000', 'alc'=>2, 'desc'=>'커피가 아닙니다. 쌉쌀한 캄파리와 스윗 베르뭇을 달지 않게 탄산으로 깔끔하게 즐길 수 있는 칵테일'),
			array('ko'=>'모스코 뮬', 'en'=>'Moscow Mule', 'price'=>'15,000', 'alc'=>2, 'desc'=>'보드카와 라임주스, 진저에일과 함께 구리잔에 시나몬을 태워 제공되는 매력적인 칵테일'),
		)),
		array('cat'=>'CLASSIC', 'items'=>array(
			array('ko'=>'블랙러시안', 'en'=>'Black Russian', 'price'=>'11,000', 'alc'=>4, 'desc'=>'보드카를 깔루아의 커피향과 함께 즐길 수 있는 칵테일'),
			array('ko'=>'화이트러시안', 'en'=>'White Russian', 'price'=>'12,000', 'alc'=>3, 'desc'=>'블랙러시안에 우유를 더하여 라떼처럼 즐길 수 있는 칵테일'),
			array('ko'=>'네그로니', 'en'=>'Negroni', 'price'=>'13,000', 'alc'=>4, 'desc'=>'쌉쌀한 캄파리와 진, 그리고 와인 리큐어인 베르뭇의 풍부한 향을 즐길 수 있는 칵테일'),
			array('ko'=>'파우스트', 'en'=>'Faust', 'price'=>'13,000', 'alc'=>5, 'desc'=>'카시스의 향이 매력적인 디지버지게 높은 도수의 ‘주현사장님 원픽’ 칵테일'),
			array('ko'=>'카타르시스', 'en'=>'Katharsis', 'price'=>'13,000', 'alc'=>4, 'desc'=>'라임주스와 달콤한 아몬드향의 디사론노의 밸런스가 완벽한 칵테일'),
			array('ko'=>'갓파더', 'en'=>'God Father', 'price'=>'14,000', 'alc'=>4, 'desc'=>'향긋한 위스키와 아몬드향의 디사론노를 태운 시나몬향과 함께 즐길 수 있는 칵테일'),
			array('ko'=>'러스티네일', 'en'=>'Rusty Nail', 'price'=>'14,000', 'alc'=>4, 'desc'=>'허브와 꿀향이 나는 드람뷰이와 위스키의 향을 즐길 수 있는 칵테일'),
			array('ko'=>'불바디에', 'en'=>'Boulevardier', 'price'=>'16,000', 'alc'=>4, 'desc'=>'버번위스키와 쌉쌀한 캄파리, 와인 리큐어인 베르뭇의 매력적인 콤비네이션을 즐길 수 있는 칵테일'),
			array('ko'=>'올드패션드', 'en'=>'Old-Fashioned', 'price'=>'16,000', 'alc'=>5, 'desc'=>'칵테일의 원형으로 불리는 칵테일로, 버번위스키 향의 진수를 느낄 수 있는 칵테일'),
		)),
		array('cat'=>'SHORT', 'items'=>array(
			array('ko'=>'바카디 칵테일', 'en'=>'Bacardi Cocktail', 'price'=>'12,000', 'alc'=>3, 'desc'=>'바카디럼에 라임과 석류시럽의 영롱하고 매력적인 맛을 가진 칵테일 도전! 극한의 도수버젼 선택시 +1,000 / Alc.●●●●●+@'),
			array('ko'=>'애프리콧 칵테일', 'en'=>'Apricot Cocktail', 'price'=>'12,000', 'alc'=>2, 'desc'=>'새콤한 살구향에 진, 레몬, 오렌지향이 매력적으로 조합된 칵테일'),
			array('ko'=>'김렛', 'en'=>'Gimlet', 'price'=>'12,000', 'alc'=>3, 'desc'=>'진을 라임, 설탕과 함께 충분히 셰이킹하여 상큼하게 즐길 수 있는 칵테일'),
			array('ko'=>'코스모폴리탄', 'en'=>'Cosmopolitan', 'price'=>'13,000', 'alc'=>4, 'desc'=>'섹스앤더시티에 등장하여 인기가 높아진, 보드카와 고급 오렌지리큐르, 크랜베리의 밸런스가 매력적인 느낄 수 있는 칵테일'),
			array('ko'=>'마가리타', 'en'=>'Margarita', 'price'=>'14,000', 'alc'=>3, 'desc'=>'데킬라 베이스에 오렌지 라임향이 더해진, 잔 주변의 소금을 함께 먹는 재미가 있는 칵테일 (Crushed Ice와 함께 제공됩니다.)'),
			array('ko'=>'뉴욕', 'en'=>'New York', 'price'=>'16,000', 'alc'=>4, 'desc'=>'버번위스키를 라임과 함께 셰이킹하여 새콤하고 향긋하게 즐길 수 있는 칵테일'),
			array('ko'=>'맨하탄', 'en'=>'Manhattan', 'price'=>'15,000', 'alc'=>4, 'desc'=>'칵테일의 여왕이라는 별칭을 가지고 있으며, 라이위스키와 스위트 베르무트향이 매력적인 칵테일'),
		)),
		array('cat'=>'MARTINI', 'items'=>array(
			array('ko'=>'드라이 마티니', 'en'=>'Dry Martini', 'price'=>'12,000', 'alc'=>4, 'desc'=>'진 본래의 향을 가장 잘 느낄 수 있는 마티니의 클래식'),
			array('ko'=>'애플 마티니', 'en'=>'Apple Martini', 'price'=>'13,000', 'alc'=>3, 'desc'=>'진과 달달한 애플퍼커의 사과향, 라임주스로 새콤하게 즐길 수 있는 마티니'),
			array('ko'=>'블루 마티니', 'en'=>'Blue Martini', 'price'=>'13,000', 'alc'=>4, 'desc'=>'강렬한 향의 봄베이 진과 오렌지 레몬의 시트러스한 향을 즐길 수 있는 매력적인 푸른색 마티니'),
			array('ko'=>'에스프레소마티니', 'en'=>'Espresso Martini', 'price'=>'14,000', 'alc'=>3, 'desc'=>'보드카와 깔루아, 에스프레소 샷이 들어가는 커피향의 정통 마티니'),
		)),
		array('cat'=>'ABSENTE', 'items'=>array(
			array('ko'=>'압생트 토닉', 'en'=>'Absinthe Tonic', 'price'=>'13,000', 'alc'=>3, 'desc'=>'고흐가 좋아했던 압생트를 각설탕에 적신 후 불을붙여 녹여내 토닉과 함께 즐기는 칵테일'),
			array('ko'=>'페어리 갓마더', 'en'=>'Fairy Godmother', 'price'=>'14,000', 'alc'=>2, 'desc'=>'매력적인 압생트를 향긋한 엘더플라워향 리큐르과 신선한 주스들로 친근하게 즐길 수 있는 칵테일'),
			array('ko'=>'사제락', 'en'=>'Sazerac', 'price'=>'16,000', 'alc'=>4, 'desc'=>'라이위스키와 압생트향의 절묘한 밸런스를 느낄 수 있는 압생트 매니아 저격 칵테일'),
		)),
	)),
	// ── MILK &amp; SHOT ──
	array('key'=>'milkshot', 'label'=>'MILK &amp; SHOT', 'groups'=>array(
		array('cat'=>'MILK', 'items'=>array(
			array('ko'=>'깔루아 밀크', 'en'=>'Kahlua Milk', 'price'=>'11,000', 'alc'=>1, 'desc'=>'칵린이용, 깔루아 커피향 인기만점 밀크 칵테일'),
			array('ko'=>'베일리스 밀크', 'en'=>'Baileys Milk', 'price'=>'11,000', 'alc'=>1, 'desc'=>'부드러운 크림향이 나는 고급스러운 밀크 칵테일'),
			array('ko'=>'잭허니 밀크', 'en'=>'Jack honey Milk', 'price'=>'12,000', 'alc'=>2, 'desc'=>'잭다니엘 허니와 함께 즐기는 밀크칵테일'),
			array('ko'=>'미도리 밀크', 'en'=>'Midori Milk', 'price'=>'12,000', 'alc'=>1, 'desc'=>'메로나맛이 나는 초딩입맛 저격 밀크 칵테일'),
			array('ko'=>'그래스호퍼', 'en'=>'Grasshopper', 'price'=>'13,000', 'alc'=>2, 'desc'=>'민트와 카카오향이 가득한 민초파 취향저격 칵테일'),
			array('ko'=>'잭허니 아이스크림', 'en'=>'Jack honey ice cream', 'price'=>'13,000', 'alc'=>3, 'desc'=>'잭다니엘 허니 1샷을 바닐라아이스크림에 끼얹어먹는 달콤하고 환상적인 만남(잭애플로 변경가능)'),
			array('ko'=>'오르가즘', 'en'=>'Orgasm', 'price'=>'13,000', 'alc'=>3, 'desc'=>'깔루아, 베일리스, 아마레또의 크림크림한 콜라보레이션이 매력적인 칵테일'),
		)),
		array('cat'=>'BOMB COCKTAIL', 'items'=>array(
			array('ko'=>'아그와 밤', 'en'=>'Agwa Bomb', 'price'=>'10,000', 'alc'=>2, 'desc'=>'약초향의 예거마이스터와 에너지드링크를 섞어, 아침까지 버티게 해주는 밤 칵테일'),
			array('ko'=>'예거 밤', 'en'=>'J/gid00093ger Bomb', 'price'=>'12,000', 'alc'=>2, 'desc'=>'약초향의 예거마이스터와 에너지드링크를 섞어, 아침까지 버티게 해주는 밤 칵테일'),
			array('ko'=>'하이네캔 허니밤', 'en'=>'Heineken Honey Bomb', 'price'=>'14,000', 'alc'=>3, 'desc'=>'하이네캔 맥주와 잭다니엘 허니의 환상적인 궁합이 매력적인 밤 칵테일'),
			array('ko'=>'아이리쉬 밤', 'en'=>'Irish Bomb', 'price'=>'15,000', 'alc'=>3, 'desc'=>'아일랜드 출신 흑맥주인 기네스와 베일리스밀크를 섞어 마시는 부드러운 향의 밤 칵테일'),
		)),
	)),
	// ── NON-ALCOHOL ──
	array('key'=>'nonalc', 'label'=>'NON-ALCOHOL', 'groups'=>array(
		array('cat'=>'NON-ALCOHOL', 'items'=>array(
			array('ko'=>'논알콜 정글쥬스', 'en'=>'Virgin Jungle Juice', 'price'=>'11,000', 'desc'=>'정글의 시그니쳐, 새콤달콤한 무알콜 정글주스'),
			array('ko'=>'논알콜 크림달래', 'en'=>'Virgin Cream Dalae', 'price'=>'14,000', 'desc'=>'새콤한 청포도스파클링에 아이스크림 한스쿱이 통채로 올라가는 크림달래의 논알콜버젼 칵테일'),
			array('ko'=>'논알콜 스크류바 하이볼', 'en'=>'Virgin Screw-bar(ice bar) Highball', 'price'=>'11,000', 'desc'=>'논알콜 버전의 스크류바 하이볼'),
			array('ko'=>'논알콜 생귤탱귤 하이볼', 'en'=>'Virgin Saeng-gyul Taeng-gyul(ice bar) Highball', 'price'=>'11,000', 'desc'=>'논알콜 버전의 생귤탱귤 하이볼'),
			array('ko'=>'뽕따 리프레셔', 'en'=>'BBong DDa Refresher', 'price'=>'9,000', 'desc'=>'소다밀크맛 논알콜 리프레셔(알콜음료로 주문가능, +1,000)'),
			array('ko'=>'셜리템플', 'en'=>'Shirley Temple', 'price'=>'9,000', 'desc'=>'석류시럽과 라임, 진저에일의 향이 매력적인 달콤한 무알콜 칵테일'),
			array('ko'=>'선라이즈', 'en'=>'Sunrise', 'price'=>'10,000', 'desc'=>'데킬라선라이즈의 무알콜버젼, 석양이 지는듯한 아름다움은 여전히!'),
			array('ko'=>'신데렐라', 'en'=>'Cinderella', 'price'=>'12,000', 'desc'=>'12시가 되기 전 집에 가야하는 당신을 위해 마티니잔에 우아하게 제공되는 논알콜 과일주스 칵테일'),
			array('ko'=>'논알콜 민트 라임 모히또', 'en'=>'Virgin Mint Lime Mojito', 'price'=>'12,000', 'desc'=>'논알콜로 즐기는 상큼한 탄산 민트 라임모히또'),
			array('ko'=>'논알콜 모히또 크러셔', 'en'=>'Virgin Mojito Crusher', 'price'=>'12,000', 'desc'=>'향긋하고 새콤한 모히토 음료를 크러시드 아이스와 함께 즐기는 논알콜 칵테일'),
			array('ko'=>'논알콜 피나콜라다', 'en'=>'Virgin Piña Colada', 'price'=>'13,000', 'desc'=>'논알콜로 즐기는 풍부한 파인애플향 칵테일'),
			array('ko'=>'논알콜 쿠바리브레', 'en'=>'Virgin Cuba Libre', 'price'=>'9,000', 'desc'=>'상큼한라임과 콜라의 탄산의 청량한 콜라보를 즐길수있는 논알콜 칵테일'),
			array('ko'=>'밀크 바닐라 스무디', 'en'=>'Milk Vanila smoothie', 'price'=>'11,000', 'desc'=>'우유와 바닐라시럽을 얼음과 함께 갈아 시원하게 즐기는 밀크스무디'),
			array('ko'=>'청포도 토닉에이드', 'en'=>'Green Grape Tonic Ade', 'price'=>'9,000', 'desc'=>'새콤하고 달달한 청포도향을 시원하게 즐길 수 있는 에이드'),
			array('ko'=>'레몬 토닉에이드', 'en'=>'Lemon Tonic Ade', 'price'=>'9,000', 'desc'=>'깔끔한 레몬의 향을 새콤하게 즐길 수 있는 에이드'),
			array('ko'=>'라임 토닉에이드', 'en'=>'Lime Tonic Ade', 'price'=>'9,000', 'desc'=>'신선한 라임향을 싱그럽게 즐길 수 있는 에이드 Lorem ipsum'),
		)),
	)),
	// ── BEER &amp; SNACK ──
	array('key'=>'beer', 'label'=>'BEER &amp; SNACK', 'groups'=>array(
		array('cat'=>'BOTTLE BEER', 'items'=>array(
			array('ko'=>'테라', 'en'=>'Tera', 'price'=>'10,000'),
			array('ko'=>'클라우드', 'en'=>'Kloud', 'price'=>'10,000'),
			array('ko'=>'하이네캔', 'en'=>'Heineken', 'price'=>'10,000'),
			array('ko'=>'코로나', 'en'=>'Corona Extra', 'price'=>'10,000'),
			array('ko'=>'호가든', 'en'=>'Hoegaarden', 'price'=>'10,000'),
			array('ko'=>'블랑', 'en'=>'1664 BLANC 1664', 'price'=>'12,000'),
			array('ko'=>'기네스', 'en'=>'Guinness', 'price'=>'12,000'),
		)),
		array('cat'=>'DRINKS', 'items'=>array(
			array('ko'=>'과일주스', 'en'=>'Fruit Juice', 'price'=>'M 5,000 / L 8,000', 'desc'=>'오렌지, 파인애플, 크랜베리'),
			array('ko'=>'얼그레이 밀크티', 'en'=>'Earl Grey milk tea', 'price'=>'7,000'),
			array('ko'=>'헛개차', 'en'=>'Oriental raisin tea', 'price'=>'3,000'),
			array('ko'=>'우롱차', 'en'=>'Oolong Tea', 'price'=>'4,000'),
			array('ko'=>'우유', 'en'=>'Milk', 'price'=>'3,000'),
			array('ko'=>'핫식스', 'en'=>'Hot 6', 'price'=>'3,000'),
			array('ko'=>'콜라', 'en'=>'Coke', 'price'=>'3,000'),
			array('ko'=>'제로콜라', 'en'=>'Zero Coke', 'price'=>'3,000'),
			array('ko'=>'진저에일', 'en'=>'Ginger Ale', 'price'=>'3,000'),
			array('ko'=>'토닉워터', 'en'=>'Tonic water', 'price'=>'3,000'),
			array('ko'=>'토닉워터 제로', 'en'=>'Tonic water Zero', 'price'=>'3,000'),
		)),
		array('cat'=>'TEA(Hot/Iced)', 'items'=>array(
			array('ko'=>'커피', 'en'=>'Coffee', 'price'=>'7,000'),
			array('ko'=>'오설록 녹차', 'en'=>'Green tea', 'price'=>'7,000'),
			array('ko'=>'자스민 차', 'en'=>'Jasmine tea', 'price'=>'7,000'),
			array('ko'=>'카모마일 차', 'en'=>'Chamomile tea', 'price'=>'7,000'),
		)),
		array('cat'=>'SNACKS', 'items'=>array(
			array('ko'=>'정글 플레이트', 'en'=>'Jungle Plate', 'price'=>'20,000', 'desc'=>'견과류, 육포, 치즈, 비스켓 등 핑거푸드를 풍성하게 즐길 수 있는 플레이트'),
			array('ko'=>'바닐라 아이스크림', 'en'=>'Vanilla ice cream', 'price'=>'5,000', 'desc'=>'에스프레소 샷 추가(아포가토) +3,000'),
			array('ko'=>'컵라면', 'en'=>'Cup noodles', 'price'=>'5,000', 'desc'=>'진라면 큰컵, 짜빠게티 큰컵'),
		)),
	)),
	// ── BOTTLE ──
	array('key'=>'bottle', 'label'=>'BOTTLE', 'groups'=>array(
		array('cat'=>'VODKA', 'items'=>array(
			array('ko'=>'앱솔루트 오리지널', 'en'=>'Absolute Original', 'price'=>'120,000', 'vol'=>'700ml'),
			array('ko'=>'앱솔루트 플레이버', 'en'=>'Absolute Flavor - Peach, Pears, Lime', 'price'=>'130,000', 'vol'=>'700ml'),
			array('ko'=>'그레이구스 오리지널', 'en'=>'GreyGoose Original', 'price'=>'180,000', 'vol'=>'750ml'),
		)),
		array('cat'=>'TEQUILA', 'items'=>array(
			array('ko'=>'호세쿠엘보 에스페셜', 'en'=>'Jose Cuervo Especial', 'price'=>'120,000', 'vol'=>'750ml'),
			array('ko'=>'1800 레포사도', 'en'=>'1800 Reposado', 'price'=>'180,000', 'vol'=>'750ml'),
			array('ko'=>'패트론 실버', 'en'=>'Patron Silver', 'price'=>'290,000', 'vol'=>'750ml'),
		)),
		array('cat'=>'LIQUER', 'items'=>array(
			array('ko'=>'아그와', 'en'=>'Agwa de Bolivia', 'price'=>'150,000', 'vol'=>'700ml'),
			array('ko'=>'생제르맹', 'en'=>'Saint-Germain', 'price'=>'180,000', 'vol'=>'750ml'),
			array('ko'=>'파이어볼', 'en'=>'Fireball', 'price'=>'130,000', 'vol'=>'700ml'),
			array('ko'=>'피치트리', 'en'=>'Peach Tree', 'price'=>'120,000', 'vol'=>'700ml'),
			array('ko'=>'말리부', 'en'=>'Malibu', 'price'=>'120,000', 'vol'=>'700ml'),
			array('ko'=>'예거 마이스터', 'en'=>'J/gid00093ger Meister', 'price'=>'120,000', 'vol'=>'700ml'),
		)),
		array('cat'=>'KOREAN SPIRITS', 'items'=>array(
			array('ko'=>'일품진로 25도', 'en'=>'Ilpoom Jinro 25% 375ml', 'price'=>'40,000', 'vol'=>'375ml'),
			array('ko'=>'화요 25도', 'en'=>'Hwayo 25% 375ml', 'price'=>'40,000', 'vol'=>'375ml'),
			array('ko'=>'화요 25도', 'en'=>'Hwayo 25% 500ml', 'price'=>'50,000', 'vol'=>'500ml'),
			array('ko'=>'화요 41도', 'en'=>'Hwayo 41% 375ml', 'price'=>'70,000', 'vol'=>'375ml'),
		)),
		array('cat'=>'AMERICAN', 'items'=>array(
			array('ko'=>'짐빔', 'en'=>'Jim Beam', 'price'=>'120,000', 'vol'=>'700ml'),
			array('ko'=>'잭다니엘', 'en'=>'Jack Daniel’s', 'price'=>'150,000', 'vol'=>'700ml'),
			array('ko'=>'잭다니엘 허니', 'en'=>'Jack Daniel’s Honey', 'price'=>'160,000', 'vol'=>'700ml'),
			array('ko'=>'잭다니엘 애플', 'en'=>'Jack Daniel’s Apple', 'price'=>'160,000', 'vol'=>'700ml'),
			array('ko'=>'메이커스 마크', 'en'=>'Maker\'s Mark', 'price'=>'180,000', 'vol'=>'750ml'),
			array('ko'=>'와일드터키 8y', 'en'=>'Wild Turkey', 'price'=>'180,000', 'vol'=>'700ml'),
			array('ko'=>'엘라이자 크레이그', 'en'=>'Elijah Craig Small batch', 'price'=>'180,000', 'vol'=>'700ml'),
			array('ko'=>'납크릭', 'en'=>'Knob creek', 'price'=>'200,000', 'vol'=>'750ml'),
		)),
		array('cat'=>'GIN', 'items'=>array(
			array('ko'=>'봄베이 사파이어', 'en'=>'Bombay Sapphire', 'price'=>'120,000', 'vol'=>'750ml'),
			array('ko'=>'탱커레이', 'en'=>'Tanqueray', 'price'=>'120,000', 'vol'=>'750ml'),
			array('ko'=>'탱커레이 No.10', 'en'=>'Tanqueray No.10', 'price'=>'140,000', 'vol'=>'700ml'),
			array('ko'=>'헨드릭스', 'en'=>'Hendrick’s', 'price'=>'160,000', 'vol'=>'700ml'),
			array('ko'=>'넘버3', 'en'=>'No.3', 'price'=>'180,000', 'vol'=>'700ml'),
			array('ko'=>'몽키47', 'en'=>'Monkey47', 'price'=>'180,000', 'vol'=>'500ml'),
			array('ko'=>'보타니스트', 'en'=>'Botanist', 'price'=>'210,000', 'vol'=>'700ml'),
		)),
		array('cat'=>'Whisky(Blended)', 'items'=>array(
			array('ko'=>'제임슨', 'en'=>'Jameson', 'price'=>'120,000', 'vol'=>'700ml'),
			array('ko'=>'네이키드 몰트', 'en'=>'Naked Malt', 'price'=>'140,000', 'vol'=>'700ml'),
			array('ko'=>'산토리 가쿠빈', 'en'=>'Suntory whisky Kakubin', 'price'=>'140,000', 'vol'=>'700ml'),
			array('ko'=>'몽키숄더', 'en'=>'Monkey Shoulder', 'price'=>'180,000', 'vol'=>'700ml'),
			array('ko'=>'조니워커 블랙', 'en'=>'Johnnie Walker Black', 'price'=>'180,000', 'vol'=>'700ml'),
			array('ko'=>'조니워커 더블 블랙', 'en'=>'Johnnie Walker Double Black', 'price'=>'190,000', 'vol'=>'700ml'),
			array('ko'=>'조니워커 블루', 'en'=>'Johnnie Walker Blue', 'price'=>'740,000', 'vol'=>'750ml'),
			array('ko'=>'발렌타인 12년', 'en'=>'Ballantine 12y', 'price'=>'140,000', 'vol'=>'500ml'),
			array('ko'=>'발렌타인 17년', 'en'=>'Ballantine 17y', 'price'=>'360,000', 'vol'=>'700ml'),
			array('ko'=>'히비키 하모니', 'en'=>'Hibiki Harmony', 'price'=>'420,000', 'vol'=>'700ml'),
			array('ko'=>'로얄살루트 21년', 'en'=>'Royal Salute 21y', 'price'=>'690,000', 'vol'=>'700ml'),
		)),
		array('cat'=>'Brandy(Cognac)', 'items'=>array(
			array('ko'=>'헤네시 V.S.O.P', 'en'=>'Hennessey V.S.O.P', 'price'=>'220,000', 'vol'=>'700ml'),
		)),
		array('cat'=>'Whisky(Single Malt)', 'items'=>array(
			array('ko'=>'발베니 12년', 'en'=>'Balvenie 12y', 'price'=>'320,000', 'vol'=>'700ml'),
			array('ko'=>'맥켈란 12년', 'en'=>'Macallan 12y', 'price'=>'320,000', 'vol'=>'700ml'),
			array('ko'=>'글렌모렌지 오리지날', 'en'=>'Glenmorangie Original', 'price'=>'210,000', 'vol'=>'700ml'),
			array('ko'=>'글렌드로낙 12년', 'en'=>'Glendronach 12y', 'price'=>'240,000', 'vol'=>'700ml'),
			array('ko'=>'아란 10년', 'en'=>'Aran 10y', 'price'=>'260,000', 'vol'=>'700ml'),
			array('ko'=>'글렌피딕 12년', 'en'=>'Glenfiddich 12y', 'price'=>'240,000', 'vol'=>'700ml'),
			array('ko'=>'글렌피딕 15년', 'en'=>'Glenfiddich 15y', 'price'=>'320,000', 'vol'=>'700ml'),
			array('ko'=>'아드벡 TEN', 'en'=>'Ardbeg TEN 10y', 'price'=>'280,000', 'vol'=>'700ml'),
			array('ko'=>'라프로익 10년', 'en'=>'Laphroaig 10y', 'price'=>'260,000', 'vol'=>'700ml'),
			array('ko'=>'글렌모렌지 시그넷', 'en'=>'Glenmorangie Signet', 'price'=>'790,000', 'vol'=>'700ml'),
			array('ko'=>'카발란 클래식', 'en'=>'Kavalan Classic', 'price'=>'430,000', 'vol'=>'700ml'),
			array('ko'=>'카발란 솔리스트 비노바리끄', 'en'=>'Kavalan Solist Vinho Barrique', 'price'=>'740,000', 'vol'=>'700ml'),
		)),
	)),
	// ── WINE ──
	array('key'=>'wine', 'label'=>'WINE', 'groups'=>array(
		array('cat'=>'Red Wine', 'items'=>array(
			array('ko'=>'투썩점퍼 와일드보어 메를로', 'en'=>'Tussock Jumper, \'Wild boar\' Merlot', 'price'=>'45,000', 'm1'=>array('sweetness',1), 'm2'=>array('body',3)),
			array('ko'=>'프론테라 까베네쇼비뇽', 'en'=>'Frontera Cabernet Sauvignon', 'price'=>'49,000', 'm1'=>array('sweetness',1), 'm2'=>array('body',4)),
			array('ko'=>'미션서드 까베르네시라', 'en'=>'Mission Sud Cabernet Syrah', 'price'=>'49,000', 'm1'=>array('sweetness',2), 'm2'=>array('body',3)),
			array('ko'=>'롱반 피노누아', 'en'=>'Long Barn Pinot Noir', 'price'=>'49,000', 'm1'=>array('sweetness',2), 'm2'=>array('body',2)),
			array('ko'=>'투썩점퍼 카우 말벡', 'en'=>'Tussock Jumper, \'Cow\' Malbec', 'price'=>'49,000', 'm1'=>array('sweetness',1), 'm2'=>array('body',4)),
			array('ko'=>'마스카 델 타코 수수마니엘로', 'en'=>'Masca Del Tacco Susumaniello', 'price'=>'69,000', 'm1'=>array('sweetness',2), 'm2'=>array('body',3)),
			array('ko'=>'칸티나 자카니니 몬테풀치아노 다부르쪼', 'en'=>'Cantina Zaccagnini, Montepulciano d\'Abruzzo', 'price'=>'95,000', 'm1'=>array('sweetness',1), 'm2'=>array('body',2)),
			array('ko'=>'아마란타 몬테풀치아노 다부르쪼', 'en'=>'Amaranta Monepulciano d\'Abruzzo', 'price'=>'110,000', 'm1'=>array('sweetness',1), 'm2'=>array('body',3)),
		)),
		array('cat'=>'White Wine', 'items'=>array(
			array('ko'=>'롱반 샤도네이', 'en'=>'Long Barn Chardonnay', 'price'=>'49,000', 'm1'=>array('sweetness',2), 'm2'=>array('acidity',3)),
			array('ko'=>'투썩점퍼 디어 리슬링', 'en'=>'Tussock Jumper, \'Deer\' Riesling', 'price'=>'49,000', 'm1'=>array('sweetness',3), 'm2'=>array('acidity',3)),
			array('ko'=>'빌라 안티노리 비앙코', 'en'=>'Villa Antinori Bianco', 'price'=>'60,000', 'm1'=>array('sweetness',2), 'm2'=>array('acidity',4)),
			array('ko'=>'스톤 베이 쇼비뇽 블랑', 'en'=>'Stone Bay Sauvignon Blanc', 'price'=>'65,000', 'm1'=>array('sweetness',1), 'm2'=>array('acidity',4)),
			array('ko'=>'샤또 데스클랑, 위스퍼링 엔젤', 'en'=>'Chateau d’Esclans, Whispering Angel', 'price'=>'75,000', 'm1'=>array('sweetness',1), 'm2'=>array('acidity',3)),
			array('ko'=>'그라모나 제싸미', 'en'=>'Gramona Gessami', 'price'=>'85,000', 'm1'=>array('sweetness',2), 'm2'=>array('acidity',3)),
		)),
		array('cat'=>'Champagne', 'items'=>array(
			array('ko'=>'모엣샹동 임페리얼', 'en'=>'Moet & Chandon Imperial', 'price'=>'180,000'),
			array('ko'=>'뵈브 클리코 브뤼', 'en'=>'Veuve Clicquot Brut', 'price'=>'200,000'),
			array('ko'=>'페리에 주에 그랑 브뤼', 'en'=>'Perrier Jouet Grand Brut', 'price'=>'230,000'),
			array('ko'=>'돔 페리뇽', 'en'=>'Dom Perignon', 'price'=>'680,000'),
		)),
		array('cat'=>'Port Wine', 'items'=>array(
			array('ko'=>'콥케 파인 루비 포트', 'en'=>'Kopke Fine Ruby Porto', 'price'=>'60,000', 'm1'=>array('sweetness',5), 'm2'=>array('body',2)),
			array('ko'=>'콥케 파인 화이트 포트', 'en'=>'Kopke Fine White Porto', 'price'=>'60,000', 'm1'=>array('sweetness',4), 'm2'=>array('body',1)),
		)),
		array('cat'=>'Sparkling Wine', 'items'=>array(
			array('ko'=>'칸티 모스카토 다스티', 'en'=>'Canti, Moscato d\'Asti', 'price'=>'49,000'),
			array('ko'=>'투썩점퍼 폭스 프로세코', 'en'=>'Tussock Jumper, ‘Fox’ Prosecco', 'price'=>'49,000'),
			array('ko'=>'또스띠, 핑크 모스카토', 'en'=>'Tosti, Pink Moscato', 'price'=>'55,000'),
			array('ko'=>'샹동 가든 스프리츠', 'en'=>'Chandon Garden Spritz', 'price'=>'85,000'),
		)),
	)),
);
