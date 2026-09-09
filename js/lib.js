/* BAR JUNGLE - lib.js */
(function () {
	'use strict';

	var hero = document.getElementById('hero');
	var header = document.getElementById('header');
	var toggle = document.querySelector('.h_toggle');
	var sections = document.querySelectorAll('.sec');
	var heFar = document.querySelector('.he_far');
	var heAnimals = document.querySelector('.he_animals');
	var heTitle = document.querySelector('.he_title');
	var heBush = document.querySelector('.he_bush');
	var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var wrap = document.getElementById('wrap');
	var shade = document.querySelector('.jg_shade');
	var veils = document.querySelectorAll('[data-veil]');
	var tones = document.querySelectorAll('[data-tone]');
	var depthNav = document.getElementById('depth');
	var depthItems = document.querySelectorAll('.dl_item');

	/* 히어로 오픈 : 풀숲이 열리며 동물 등장 */
	function openHero() {
		if (!hero) { return; }
		window.setTimeout(function () { hero.classList.add('on'); }, reduce ? 0 : 260);
	}
	if (document.readyState === 'complete') { openHero(); }
	else { window.addEventListener('load', openHero); }

	/* 섹션 스크롤 등장 */
	if ('IntersectionObserver' in window) {
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) { entry.target.classList.add('on'); }
			});
		}, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });
		Array.prototype.forEach.call(sections, function (sec) { io.observe(sec); });
	} else {
		Array.prototype.forEach.call(sections, function (sec) { sec.classList.add('on'); });
	}

	/* 헤더 고정 상태 + 히어로 패럴랙스 */
	var ticking = false;
	function onScroll() {
		var sy = window.pageYOffset || document.documentElement.scrollTop;
		if (header) { header.classList.toggle('fix', sy > 60); }
		if (!reduce && hero && sy < window.innerHeight * 1.2) {
			if (heFar) { heFar.style.transform = 'translateY(' + (sy * 0.1) + 'px)'; }
			if (heBush) { heBush.style.transform = 'translateY(' + (sy * 0.16) + 'px)'; }
			if (heAnimals) { heAnimals.style.transform = 'translateY(' + (sy * 0.24) + 'px)'; }
			if (heTitle) {
				heTitle.style.transform = 'translateX(-50%) translateY(' + (sy * 0.36) + 'px)';
				heTitle.style.opacity = Math.max(0, 1 - sy / (window.innerHeight * 0.62));
			}
		}
		updateJungle(sy);
		ticking = false;
	}

	/* 정글 헤쳐나가기 : 풀숲이 갈라지는 속도에 상한을 둠
	   - 천천히 스크롤하면 손으로 헤치듯 스크롤을 1:1로 따라옴
	   - 스냅으로 화면이 확 넘어가도 아래 시간에 걸쳐 천천히 갈라짐
	   VEIL_DUR 을 키우면 더 느려짐 (ms) */
	var VEIL_DUR = 1200;
	var veilP = [];
	var veilLast = 0;

	/* --p 를 섹션에 쓰면 섹션 전체(수백 개 노드)의 상속 변수가 매 프레임 무효화되어
	   스크롤이 버벅인다. 실제로 움직이는 좌우 풀숲에만 쓴다. */
	var veilSides = [];

	function veilTarget(el) {
		var t = 1 - (el.getBoundingClientRect().top / window.innerHeight);
		return t < 0 ? 0 : t > 1 ? 1 : t;
	}
	function veilWrite(i, v) {
		var sides = veilSides[i], j;
		for (j = 0; j < sides.length; j++) { sides[j].style.setProperty('--p', v.toFixed(4)); }
	}
	/* 첫 프레임에 현재 스크롤 위치에 맞는 값을 반드시 한 번 써 준다.
	   (안 쓰면 --p 가 비어 있어 CSS 기본값 1 = 열린 상태로 시작해 버림) */
	for (var vi = 0; vi < veils.length; vi++) {
		veilSides.push(veils[vi].querySelectorAll('.svv_side'));
		var t0 = reduce ? 1 : veilTarget(veils[vi]);
		veilP.push(t0);
		veilWrite(vi, t0);
	}

	function veilLoop(ts) {
		var dt = veilLast ? Math.min(ts - veilLast, 64) : 16;
		veilLast = ts;
		var step = dt / VEIL_DUR;
		for (var i = 0; i < veils.length; i++) {
			var target = veilTarget(veils[i]);
			var cur = veilP[i];
			var diff = target - cur;
			var next = Math.abs(diff) <= step ? target : cur + (diff > 0 ? step : -step);
			if (next !== cur) {
				veilP[i] = next;
				veilWrite(i, next);
				/* 움직이는 동안에만 합성 레이어로 올린다 (상시 승격은 GPU 메모리 낭비) */
				if (!veils[i].classList.contains('moving')) { veils[i].classList.add('moving'); }
			} else if (veils[i].classList.contains('moving')) {
				veils[i].classList.remove('moving');
			}
		}
		window.requestAnimationFrame(veilLoop);
	}
	if (!reduce) { window.requestAnimationFrame(veilLoop); }

	function updateJungle(sy) {
		var vh = window.innerHeight;
		var i;
		/* 아래로 갈수록 짙어지는 숲 그늘 */
		/* #wrap 에 커스텀 속성을 쓰면 문서 전체가 무효화되므로, 자식이 없는 전용 레이어에 직접 쓴다 */
		var max = document.documentElement.scrollHeight - vh;
		if (shade) { shade.style.opacity = max > 0 ? (sy / max * 0.62).toFixed(3) : 0; }
		/* 지금 몇 번째 층인지 */
		var active = -1, tone = 'dark';
		for (i = 0; i < tones.length; i++) {
			var r = tones[i].getBoundingClientRect();
			if (r.top <= vh * 0.5 && r.bottom > vh * 0.5) { active = i; tone = tones[i].getAttribute('data-tone'); }
		}
		if (depthNav) { depthNav.classList.toggle('light', tone === 'light'); }
		for (i = 0; i < depthItems.length; i++) {
			depthItems[i].classList.toggle('on', i === active);
		}
	}
	window.addEventListener('scroll', function () {
		if (!ticking) { window.requestAnimationFrame(onScroll); ticking = true; }
	}, { passive: true });
	onScroll();

	/* 모바일 메뉴 */
	if (toggle) {
		toggle.addEventListener('click', function () {
			header.classList.toggle('open');
			document.body.style.overflow = header.classList.contains('open') ? 'hidden' : '';
		});
	}
	Array.prototype.forEach.call(document.querySelectorAll('.hgl_item a'), function (a) {
		a.addEventListener('click', function () {
			header.classList.remove('open');
			document.body.style.overflow = '';
		});
	});

	/* 동물 클릭 : 살짝 놀라는 리액션 */
	Array.prototype.forEach.call(document.querySelectorAll('.hea_item'), function (item) {
		item.addEventListener('click', function () {
			if (item.classList.contains('pop')) { return; }
			item.classList.add('pop');
			window.setTimeout(function () { item.classList.remove('pop'); }, 340);
		});
	});

})();
